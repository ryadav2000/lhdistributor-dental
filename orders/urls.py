from django.urls import path
from . import views

urlpatterns = [
    # Checkout
    path('checkout/', views.checkout, name='checkout'),
    path("place-order/", views.place_order, name="place_order"),
]