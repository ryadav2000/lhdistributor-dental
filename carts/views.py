from django.shortcuts import render, get_object_or_404, redirect
from .models import Cart, CartItem
from django.http import JsonResponse
from productitem.models import ProductItem
from django.contrib import messages
from django.db import DatabaseError
from django.contrib.sessions.models import Session

# Create your views here.

from django.shortcuts import get_object_or_404, redirect
from django.contrib import messages

def add_to_cart(request, product_id): 
    if request.method == "POST":
        product_item_id = request.POST.get("product_item_id")  
        quantity = int(request.POST.get("quantity", 1))


        # Ensure session exists
        if not request.session.session_key:
            request.session.create()
        
        session_id = request.session.session_key

        product_variations = ProductItem.objects.filter(product_id=product_id)

        if not product_item_id and product_variations.count() > 1:
            product_item_id = product_variations.first().id  

        if not product_item_id:
            messages.error(request, "Please select a product variation before adding to cart.")
            return redirect("cart")

        try:
            cart, created = Cart.objects.get_or_create(session_id=session_id, defaults={"user": None})

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
    """Fetch cart items for logged-in and guest users."""
    try:
        if request.user.is_authenticated:
            # Fetch or create a cart for the logged-in user
            cart, created = Cart.objects.get_or_create(user=request.user)


            # Check if guest cart exists and needs to be merged
            session_id = request.session.session_key
            guest_cart = Cart.objects.filter(session_id=session_id).first()

            if guest_cart:
                for item in CartItem.objects.filter(cart=guest_cart):
                    existing_item = CartItem.objects.filter(
                        cart=cart, 
                        product_item=item.product_item,
                        manufacturer_code=item.manufacturer_code,
                        item_description=item.item_description
                    ).first()

                    if existing_item:
                        existing_item.quantity += item.quantity
                        existing_item.save()
                        item.delete()
                    else:
                        item.cart = cart
                        item.save()

                guest_cart.delete()  # Remove the guest cart after merging

        else:
            # Fetch session-based cart
            session_id = request.session.session_key
            if not session_id:
                request.session.create()
                session_id = request.session.session_key

            cart = Cart.objects.filter(session_id=session_id).first()

        # Fetch cart items
        cart_items = CartItem.objects.filter(cart=cart) if cart else []


        # Check if cart is empty
        if not cart_items:
            messages.warning(request, 'Your cart is empty.')
            return redirect('home') 

    except DatabaseError:
        messages.error(request, "An unexpected error occurred. Please try again later.")
        cart_items = []

    return render(request, 'cart.php', {'cart_items': cart_items})


def transfer_cart_items_to_user(request, user):
    """Transfers guest cart items to the logged-in user."""
    session_id = request.session.get('guest_session_id')
    
    if not session_id:
        return
    
    # Fetch guest cart
    guest_cart = Cart.objects.filter(session_id=session_id).first()
    if not guest_cart:
        return
    
    # Fetch all user cart
    user_carts = Cart.objects.filter(user=user)

    if user_carts.exists():
        # Merge guest cart into the first existing user cart
        user_cart = user_carts.first()
    else:
        user_cart = Cart.objects.create(user=user)


    # Transfer cart items
    for cart_item in CartItem.objects.filter(cart=guest_cart):

        # Check if the exact same product exists in the user's cart
        existing_item = CartItem.objects.filter(
            cart = user_cart,
            product_item = cart_item.product_item,
            manufacturer_code = cart_item.manufacturer_code,
            item_description = cart_item.item_description
        ).first()


        if existing_item:
            existing_item.quantity += cart_item.quantity,
            existing_item.save()
            cart_item.delete()
        else:
            cart_item.cart = user_cart
            cart_item.save()


    # Remove duplicate cart (keep only one)
    Cart.objects.filter(user=user).exclude(id=user_cart.id).delete()


    # Unlink guest session from the old cart
    guest_cart.user = None
    guest_cart.session_id = None
    guest_cart.save()



    

