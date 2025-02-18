from django.contrib import admin
from .models import ProductItem

class ProductItemAdmin(admin.ModelAdmin):
    list_display = ('product', 'item_description', 'item_price', 'manufacturer_code', 'item_pack', 'activatedstatus')
    search_fields = ('product__product_name', 'item_description', 'manufacturer_code')
    list_filter = ('activatedstatus',)

admin.site.register(ProductItem, ProductItemAdmin)