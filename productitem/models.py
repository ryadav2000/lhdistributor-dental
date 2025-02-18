from django.db import models
from product.models import Product

class ProductItem(models.Model):
    product = models.ForeignKey(Product, on_delete=models.CASCADE, related_name="items")
    item_description = models.TextField(null=True, blank=True)
    item_price = models.DecimalField(max_digits=10, decimal_places=2, null=True, blank=True)
    manufacturer_code = models.CharField(max_length=300, null=True, blank=True)  # Directly stored in ProductItem
    item_pack = models.CharField(max_length=255, null=True, blank=True)
    activatedstatus = models.BooleanField(default=True)

    def __str__(self):
        return f"{self.product.product_name} - {self.item_description or 'Variant'}"