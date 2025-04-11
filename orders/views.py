from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.decorators import login_required
from carts.models import Cart, CartItem
from django.template.loader import render_to_string
from accounts.models import State
from .forms import OrderForm
from .models import Order, OrderItem, Payment, Tax
import uuid
from django.contrib import messages
from decimal import Decimal
from django.utils import timezone
from productitem.models import ProductItem
from django.core.mail import EmailMessage

import requests
import json
from django.conf import settings

import re


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
    # tax_amount = 0  # Default tax is 0
    # tax_obj = Tax.objects.filter(zipcode=user.postal_code).first()

    # if not tax_obj:
    #     tax_obj = Tax.objects.filter(city=user.city).first()

    # if tax_obj:
    #     tax_percentage = tax_obj.tax / 100
    #     tax_amount = cart_total_price * tax_percentage

    # Taking the shiping state (from POST, fallback None)
    shipping_state_id = request.POST.get('state')
    shipping_state = None
    if shipping_state_id:
        try:
            shipping_state = State.objects.get(id=shipping_state_id)
        except State.DoesNotExist:
            pass

    # Tax logic based on shipping state
    tax_percentage = Decimal('0.0625') # Default 6.25%
    if shipping_state and shipping_state.name.lower() == 'illinois':
        tax_percentage = Decimal('0.0850') # 8.50% for illinois

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
    tax_amount = Decimal('0.00')
    order = None

    if request.method == 'POST':
        form = OrderForm(request.POST)
        if form.is_valid():

            # Old Logic according to zipcode
            
            # cleaned_data = form.cleaned_data
            # shipping_zipcode = cleaned_data.get('postal_code')
            # shipping_city = cleaned_data.get('city')

            # # Fetch tax details based on shipping data
            # tax_obj = Tax.objects.filter(zipcode=shipping_zipcode).first() or Tax.objects.filter(city=shipping_city).first()
            # if tax_obj:
            #     tax_percentage = tax_obj.tax / 100
            #     tax_amount = total_price * tax_percentage

            # New Logic according to state
            cleaned_data = form.cleaned_data
            state_id = cleaned_data.get('state')

            # Get the state instance
            shipping_state = None
            if state_id:
                try:
                    shipping_state = State.objects.get(id=state_id)
                except State.DoesNotExist:
                    shipping_state = None


            # Tax based on state
            tax_percentage = Decimal('0.0625') # Default 6.25%
            if shipping_state and shipping_state.name.lower() == 'illinois':
                tax_percentage = Decimal('0.0850') # 8.50% for illinois

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


@login_required(login_url='login')
def make_payment(request):
    user = request.user

    # Only POST allowed
    if request.method != 'POST':
        return redirect('checkout')
    
    payment_method = request.POST.get('payment_method')
    if not payment_method:
        messages.error(request, 'Please select a payment method.')
        return redirect('checkout')
    

    # Fetch the latest active order
    order = Order.objects.filter(user=user, is_ordered=False).order_by('-created_at').first()
    if not order:
        messages.error(request, 'No active order found.')
        return redirect('checkout')
    
    # Get the related payment object (already created in place_order)
    payment = Payment.objects.filter(order=order).first()
    if not payment:
        messages.error(request, 'Payment object not found for this order.')
        return redirect('checkout')
    

    # Update payment details based on method 
    if payment_method == 'by_cheque':
        payment.payment_method = 'By Cheque'
        payment.status = 'Cheque'
        payment.completed_at = timezone.now()
        payment.save()

        order.is_ordered = True
        order.save()

        # Reduce stock for each product in the order
        order_items = OrderItem.objects.filter(order=order)
        for item in order_items:
            try:
                product = ProductItem.objects.filter(product__product_name=item.product_name).first()
                if product:
                    product.stock -= item.quantity
                    product.save()
            except ProductItem.DoesNotExist:
                continue # If product doesn't exist, just skip

        # Send new style confirmation email
        mail_subject = 'Thank you for your order!'
        message = render_to_string('orders/order_recieved_email.html', {
            'user': request.user,
            'order': order,
        })
        to_email = request.user.email
        send_email = EmailMessage(mail_subject, message, to=[to_email])
        send_email.content_subtype = 'html'
        send_email.send()

        messages.success(request, "Order placed successfully. Please send the cheque.")
        return render(request, 'payment/payment_success_cheque.html', {'order': order})
    
    elif payment_method == 'by_credit_card':
        payment.payment_method = 'Credit Card'
        payment.status = 'Pending'
        payment.save()

        request.session['current_order_id'] = order.id

        return render(request, 'payment/credit_card_form.html', {'order': order})
    
    else:
        messages.error(request, 'Invalid payment method selected.')
        return redirect('checkout')
    

@login_required
def credit_card_payment(request):
    if request.method != 'POST':
        return redirect('checkout')

    user = request.user
    order_id = request.session.get('current_order_id')
    order = get_object_or_404(Order, id=order_id, user=user, is_ordered=False)

    # Clean card details
    card_number = re.sub(r'\D', '', request.POST.get('card_number', ''))
    cvv = request.POST.get('cvv')
    expiry = request.POST.get('expiry')  # Format: YYYY-MM

    try:
        exp_year, exp_month = expiry.split('-')
    except ValueError:
        messages.error(request, "Invalid expiry date format. Please use YYYY-MM.")
        return redirect('checkout')

    # Authorize.Net payload
    url = "https://apitest.authorize.net/xml/v1/request.api"  # Sandbox
    payload = {
        "createTransactionRequest": {
            "merchantAuthentication": {
                "name": settings.AUTHORIZE_LOGIN_ID,
                "transactionKey": settings.AUTHORIZE_TRANSACTION_KEY
            },
            "transactionRequest": {
                "transactionType": "authCaptureTransaction",
                "amount": str(order.final_price),
                "payment": {
                    "creditCard": {
                        "cardNumber": card_number,
                        "expirationDate": f"{exp_year}-{exp_month}",
                        "cardCode": cvv
                    }
                },
                "billTo": {
                    "firstName": user.first_name or "Customer",
                    "lastName": user.last_name or "User",
                    "email": user.email
                }
            }
        }
    }

    headers = {
        "Content-Type": "application/json",
    }

    try:
        response = requests.post(url, data=json.dumps(payload), headers=headers)
        result = json.loads(response.content.decode('utf-8-sig'))

        # print("Authorize.Net Response:")
        # print(json.dumps(result, indent=4))

        # Check overall API response
        if result.get('messages', {}).get('resultCode') != 'Ok':
            error_message = result.get('messages', {}).get('message', [{}])[0].get('text', 'Unknown error occurred.')
            messages.error(request, f"Authorize.Net error: {error_message}")
            return redirect('checkout')

        trans_response = result.get('transactionResponse', {})
        if trans_response.get('responseCode') == '1':
            transaction_id = trans_response.get('transId')

           # Determine sandbox or production
            is_sandbox = settings.AUTHORIZE_NET_ENVIRONMENT == 'sandbox'

            # Validate transaction_id
            if not transaction_id or transaction_id == '0':
                if is_sandbox:
                    transaction_id = "TEST_TRANS_ID"
                else:
                    messages.error(request, "Payment failed: Invalid transaction ID returned.")
                    # Optional: save payment status as failed
                    Payment.objects.create(
                        order=order,
                        payment_method='Credit Card',
                        payment_id="N/A",
                        amount_paid=order.final_price,
                        status='Failed',
                        completed_at=timezone.now()
                    )
                    return redirect('checkout')

            # Check and create/update payment
            payment = getattr(order, 'payment', None)
            if payment:
                payment.payment_id = transaction_id
                payment.amount_paid = order.final_price
                payment.status = 'Completed'
                payment.completed_at = timezone.now()
                payment.save()
            else:
                Payment.objects.create(
                    order=order,
                    payment_method='Credit Card',
                    payment_id=transaction_id,
                    amount_paid=order.final_price,
                    status='Completed',
                    completed_at=timezone.now()
                )

            # Finalize order
            if not order.is_ordered:
                order.is_ordered = True
                order.save()

                # Update stock
                order_items = OrderItem.objects.filter(order=order)
                for item in order_items:
                    product_item = ProductItem.objects.filter(product__product_name=item.product_name).first()
                    if product_item:
                        product_item.stock -= item.quantity
                        product_item.save()

            # Send confirmation email
            try:
                subject = 'Thank you for your order!'
                message = render_to_string('orders/order_recieved_email.html', {
                    'user': user,
                    'order': order,
                })
                email = EmailMessage(subject, message, to=[user.email])
                email.content_subtype = 'html'
                email.send(fail_silently=False)
            except Exception as email_error:
                messages.warning(request, "Order placed, but confirmation email could not be sent.")

            messages.success(request, "Payment successful! Order placed.")
            return render(request, 'payment/payment_success_card.html', {'order': order})
        else:
            error_msg = trans_response.get('errors', [{}])[0].get('errorText', "Payment was declined.")
            messages.error(request, f"Payment failed: {error_msg}")

    except requests.exceptions.RequestException as req_err:
        messages.error(request, f"Network error: {str(req_err)}")
    except json.JSONDecodeError:
        messages.error(request, "Failed to parse the payment gateway response.")
    except Exception as e:
        messages.error(request, f"Unexpected error: {str(e)}")

    return redirect('checkout')



# http://127.0.0.1:8000/orders/payment/    cheque

