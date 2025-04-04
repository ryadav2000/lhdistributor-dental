from django.db import models
from django.contrib.sessions.models import Session
from productitem.models import ProductItem  # Import from the correct app
from accounts.models import Account

class Cart(models.Model):
    user = models.ForeignKey(Account, on_delete=models.CASCADE, null=True, blank=True)
    session_id = models.CharField(max_length=255, unique=True, null=True, blank=True)  # Store session key for guest users
    created_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return f"Cart ({self.session_id})"

class CartItem(models.Model):
    cart = models.ForeignKey(Cart, on_delete=models.CASCADE, related_name="items")
    user = models.ForeignKey(Account, on_delete=models.CASCADE, null=True, blank=True)
    product_item = models.ForeignKey(ProductItem, on_delete=models.CASCADE)  # Correct FK to ProductItem
    product_name = models.CharField(max_length=500)  # Store product name
    product_image = models.ImageField(upload_to='cart_product_images/', null=True, blank=True)  # Store product image
    quantity = models.PositiveIntegerField(default=1)
    item_price = models.DecimalField(max_digits=10, decimal_places=2)  # Store price at the time of adding
    manufacturer_code = models.CharField(max_length=300, default="UNKNOWN")  # Store manufacturing code for distinction
    item_description = models.TextField(default="No description available")  # Store description for distinction
    added_at = models.DateTimeField(auto_now_add=True)

    def subtotal(self):
        return self.item_price * self.quantity

    def __str__(self):
        return f"{self.product_item.product.product_name} - {self.manufacturer_code} (x{self.quantity})"

    def save(self, *args, **kwargs):
        """Auto-fill product details when adding a new cart item."""
        if self.product_item:
            self.product_name = self.product_item.product.product_name
            self.product_image = self.product_item.product.photo_url
            self.item_price = self.product_item.item_price
        super().save(*args, **kwargs)
