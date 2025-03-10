from django.shortcuts import render, get_object_or_404, redirect
from .models import Cart, CartItem
from django.http import JsonResponse
from productitem.models import ProductItem
from django.contrib import messages
from django.db import DatabaseError


# Create your views here.

from django.shortcuts import get_object_or_404, redirect
from django.contrib import messages

def add_to_cart(request, product_id):
    if request.method == "POST":
        product_item_id = request.POST.get("product_item_id")  
        quantity = int(request.POST.get("quantity", 1))

        print(f"Received Data: product_id={product_id}, product_item_id={product_item_id}, quantity={quantity}")  # Debugging

        session_id = request.session.session_key
        if not session_id:
            request.session.create()
            session_id = request.session.session_key

        product_variations = ProductItem.objects.filter(product_id=product_id)

        # ✅ Auto-select first variation if none is selected
        if not product_item_id and product_variations.count() > 1:
            product_item_id = product_variations.first().id  

        if not product_item_id:
            messages.error(request, "Please select a product variation before adding to cart.")
            return redirect("cart")

        try:
            cart, created = Cart.objects.get_or_create(session_id=session_id)
            product_item = get_object_or_404(ProductItem, id=product_item_id, product_id=product_id)

            cart_item, item_created = CartItem.objects.get_or_create(
                cart=cart,
                product_item=product_item,
                manufacturer_code=product_item.manufacturer_code,
                item_description=product_item.item_description,
                defaults={
                    "product_name": product_item.product.product_name,
                    "product_image": product_item.product.photo_url,
                    "quantity": quantity,
                    "item_price": product_item.item_price,
                }
            )

            if not item_created:
                cart_item.quantity += quantity  
                cart_item.save()
                messages.success(request, f"Updated quantity for {product_item.manufacturer_code}.")
            else:
                messages.success(request, f"Added {product_item.manufacturer_code} to the cart!")

        except Exception as e:
            messages.error(request, f"Error adding product to cart: {str(e)}")

    return redirect("cart")

# def add_to_cart(request, product_id):
#     if request.method == "POST":
#         print("Received product_item_id:", request.POST.getlist("product_item_id"))  # Debugging Output in Console
#         product_item_id = request.POST.get("product_item_id")  # Get the selected variation
#         quantity = int(request.POST.get("quantity", 1))

#         if not product_item_id:
#             messages.error(request, "No product variation selected!")
#             return redirect("cart")

#         return redirect("cart")

def increase_cart_quantity(request, cart_item_id):
    """Increase quantity of cart item"""
    try:
        cart_item = get_object_or_404(CartItem, id=cart_item_id)
        cart_item.quantity += 1
        cart_item.save()
        messages.success(request, "Item quantity increased.")
    except Exception as e:
        messages.error(request, f"Error increasing quantity: {str(e)}")

    return redirect("cart")


def decrease_cart_quantity(request, cart_item_id):
    """Decrease cart item quantity (remove if quantity reaches 0)"""
    try:
        cart_item = get_object_or_404(CartItem, id=cart_item_id)

        if cart_item.quantity > 1:
            cart_item.quantity -= 1
            cart_item.save()
            messages.success(request, "Item quantity decreased.")
        else:
            cart_item.delete()
            messages.success(request, "Item removed from cart.")

    except Exception as e:
        messages.error(request, f"Error decreasing quantity: {str(e)}")

    return redirect("cart")


def delete_cart_item(request, cart_item_id):
    try:
        cart_item = get_object_or_404(CartItem, id=cart_item_id)
        cart_item.delete()
        messages.success(request, "Item removed from cart.")

    except Exception as e:
        messages.error(request, f"Error removing item: {str(e)}")
        
    return redirect("cart")



def cart(request):
    """Fetch cart items and display them."""

    try:
        session_id = request.session.session_key

        # Ensure session exists
        if not session_id:
            request.session.create()
            session_id = request.session.session_key


        #Get the user's cart 
        cart = Cart.objects.filter(session_id=session_id).first()


        # Get all cart item for the cart
        cart_items = CartItem.objects.filter(cart=cart) if cart else []

    except DatabaseError as e:
        messages.error(request, "An unexpected error occured. Please try again later.")
        cart_items = [] # Ensure cart is always returned        


    return render(request, 'cart.php', {'cart_items': cart_items})