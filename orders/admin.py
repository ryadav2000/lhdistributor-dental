from django.contrib import admin
from .models import Tax, Order, OrderItem, Payment

# Register your models here.
class TaxAdmin(admin.ModelAdmin):
    list_display = ('city', 'zipcode', 'tax')
    ordering = ['city']


admin.site.register(Tax, TaxAdmin)
admin.site.register(Order)
admin.site.register(OrderItem)
admin.site.register(Payment)