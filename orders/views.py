from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.decorators import login_required
from carts.models import Cart, CartItem
from orders.models import Tax
from accounts.models import State
from .forms import OrderForm
from .models import Order, OrderItem, Payment, Tax
import uuid
from django.contrib import messages
from decimal import Decimal

# Create your views here.
# Checkout Functionality
@login_required(login_url='login')
def checkout(request):
    user = request.user

    # Fetch user's cart
    cart = Cart.objects.filter(user=user).first()
    cart_items = CartItem.objects.filter(cart=cart)


    if not cart_items.exists():
        return redirect('cart') # Redirect to cart page if empty
    

    # Fetch user billing details
    billing_details = {
        "company_name": user.company_name,
        "first_name": user.first_name,
        "last_name": user.last_name,
        "email": user.email,
        "phone": user.phone_number,
        "address": user.address_line,
        "city": user.city,
        "state": user.state.id if user.state else None,
        "zipcode": user.postal_code,
        "country": user.country
    }

    cart_total_price = sum(item.item_price * item.quantity for item in cart_items)

    # **Calculate Tax based on City or Postal Code**
    tax_amount = 0  # Default tax is 0
    tax_obj = Tax.objects.filter(zipcode=user.postal_code).first()

    if not tax_obj:
        tax_obj = Tax.objects.filter(city=user.city).first()

    if tax_obj:
        tax_percentage = tax_obj.tax / 100
        tax_amount = cart_total_price * tax_percentage

    # Shipping Tax Logic
    shipping_tax = Decimal('16.99') if cart_total_price < 300 else Decimal('0.00')


    # **Final Price After Tax**
    final_price = cart_total_price + tax_amount + shipping_tax

    # Fetch states dynamically
    states = State.objects.all()

    context = {
        "billing_details": billing_details,
        "cart_items": cart_items,
        "cart_total_price": cart_total_price,
        "tax_amount": tax_amount,
        "shipping_tax": shipping_tax,
        "final_price": final_price,
        "states": states,
    }
    return render(request, "checkout.php", context)


@login_required(login_url='login')
def place_order(request):
    user = request.user

    # Fetch user's cart
    cart = Cart.objects.filter(user=user).first()
    cart_items = CartItem.objects.filter(cart=cart)

    if not cart_items.exists():
        messages.error(request, "Your cart is empty")
        return redirect('cart')

    # Calculate total price and tax
    total_price = sum(item.subtotal() for item in cart_items)
    tax_amount = 0
    order = None

    if request.method == 'POST':
        form = OrderForm(request.POST)
        if form.is_valid():
            cleaned_data = form.cleaned_data
            shipping_zipcode = cleaned_data.get('postal_code')
            shipping_city = cleaned_data.get('city')

            # Fetch tax details based on shipping data
            tax_obj = Tax.objects.filter(zipcode=shipping_zipcode).first() or Tax.objects.filter(city=shipping_city).first()
            if tax_obj:
                tax_percentage = tax_obj.tax / 100
                tax_amount = total_price * tax_percentage

            # Shipping Tax
            shipping_tax = Decimal('16.99') if total_price < 300 else Decimal('0.00')

            final_price = total_price + tax_amount + shipping_tax
            # Create and save the Order
            order = form.save(commit=False)
            order.user = user
            order.order_id = str(uuid.uuid4().hex[:10]).upper()
            order.total_price = total_price
            order.tax_amount = tax_amount
            order.shipping_tax = shipping_tax
            order.final_price = final_price
            # Convert state id to actual State instance
            state_id = cleaned_data.get('state')
            order.state = State.objects.get(id=state_id)
            order.is_ordered = False
            order.save()  # Save the order to update the database

            # Create Order items
            for item in cart_items:
                OrderItem.objects.create(
                    order=order,
                    product_name=item.product_name,  # Ensure this field exists
                    quantity=item.quantity,
                    price=item.item_price,
                    subtotal=item.subtotal()
                )

            # Create a Payment instance (to be processed later)
            Payment.objects.create(
                user=user,
                order=order,
                payment_id=str(uuid.uuid4().hex[:10]).upper(),
                payment_method="Pending",
                amount_paid=final_price,
                status="Pending"
            )

            # Fetch the order again to confirm updates
            order_data = get_object_or_404(Order, user=user, is_ordered=False, order_id=order.order_id)

            return render(request, 'place_order.php', {
                "cart_items": cart_items,
                "order": order_data,
                "total_price": order_data.total_price,
                "tax_amount": order_data.tax_amount,
                "shipping_tax": order_data.shipping_tax,
                "final_price": order_data.final_price,
            })

    return redirect('checkout')  # If not POST, go back to checkout
