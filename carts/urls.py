from django.urls import path
from . import views

urlpatterns = [
    path('', views.cart, name='cart'),
    path('add/<int:product_id>/', views.add_to_cart, name='add_to_cart'),
    path('delete/<int:cart_item_id>/', views.delete_cart_item, name='delete_cart_item'),
    path('increase/<int:cart_item_id>/', views.increase_cart_quantity, name="increase_cart_quantity"),
    path("decrease/<int:cart_item_id>/", views.decrease_cart_quantity, name="decrease_cart_quantity"),
]