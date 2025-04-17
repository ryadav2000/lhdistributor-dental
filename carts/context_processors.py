from .models import Cart, CartItem


def cart_item_count(request):
    count = 0
    try:
        if request.user.is_authenticated:
            cart = Cart.objects.filter(user=request.user).first()
        else:
            session_id = request.session.session_key
            if not session_id:
                request.session.create()
                session_id = request.session.session_key
            cart = Cart.objects.filter(session_id=session_id).first()

        if cart:
            count = CartItem.objects.filter(cart=cart).count()
        
    except:
        pass

    return {'cart_item_count': count}
