from django.contrib import admin
from .models import Tax, Order, OrderItem, Payment

# Register your models here.
class OrderItemInline(admin.TabularInline):
    model = OrderItem
    extra = 0
    readonly_fields = ('product_name', 'quantity', 'price', 'subtotal')


class OrderAdmin(admin.ModelAdmin):
    list_display = ('order_id', 'full_name', 'email', 'phone', 'status', 'final_price', 'created_at')
    list_filter = ('status', 'created_at', 'city', 'state')
    search_fields = ('order_id', 'email', 'first_name', 'last_name')
    inlines = [OrderItemInline]
    readonly_fields = ('order_id', 'created_at', 'updated_at')

class PaymentAdmin(admin.ModelAdmin):
    list_display = ('payment_id', 'order', 'payment_method', 'status', 'amount_paid', 'created_at')
    list_filter = ('payment_method', 'status', 'created_at')
    search_fields = ('payment_id', 'order__order_id', 'user__email')


class TaxAdmin(admin.ModelAdmin):
    list_display = ('city', 'zipcode', 'tax')
    ordering = ['city']


admin.site.register(Tax, TaxAdmin)
admin.site.register(Order, OrderAdmin)
admin.site.register(OrderItem)
admin.site.register(Payment, PaymentAdmin)