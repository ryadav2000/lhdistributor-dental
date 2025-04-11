from django.urls import path
from . import views

urlpatterns = [
    # Checkout
    path('checkout/', views.checkout, name='checkout'),
    path('place-order/', views.place_order, name='place_order'),
    path('payment/', views.make_payment, name='make_payment'),
    path('payment/credit-card/', views.credit_card_payment, name='credit_card_payment'),
]