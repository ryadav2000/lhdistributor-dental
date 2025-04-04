from django.contrib import admin
from .models import Cart, CartItem

# Register your models here.

class CartAdmin(admin.ModelAdmin):
    list_display = ('session_id', 'created_at')


class CartItemAdmin(admin.ModelAdmin):
    list_display = ('product_item', 'product_name', 'quantity', 'item_price')

admin.site.register(Cart, CartAdmin)
admin.site.register(CartItem, CartItemAdmin)