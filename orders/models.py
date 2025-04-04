from django.db import models
from accounts.models import Account
from django.contrib.auth import get_user_model
import uuid
from decimal import Decimal

# Create your models here.
class Tax(models.Model):
    city = models.CharField(max_length=255)
    zipcode = models.CharField(max_length=20)
    tax = models.DecimalField(max_digits=5, decimal_places=2)

    class Meta:
        ordering = ['city']

    def __str__(self):
        return f"{self.city} ({self.zipcode}) - {self.tax}%"
        

class Order(models.Model):
    user = models.ForeignKey(Account, on_delete=models.SET_NULL, null=True, blank=True)
    order_id = models.CharField(max_length=20, unique=True, editable=False, default=None)

    # Shipping & Billing Details
    first_name = models.CharField(max_length=100)
    last_name = models.CharField(max_length=100)
    company_name = models.CharField(max_length=100, default="USA")
    phone = models.CharField(max_length=15)
    email = models.EmailField()
    address_line = models.CharField(max_length=255)
    city = models.CharField(max_length=100)
    state = models.CharField(max_length=100)
    country = models.CharField(max_length=100)
    postal_code = models.CharField(max_length=10)
    order_note = models.TextField(blank=True, null=True)

    # Order Summary (Pass tax info from checkout view)
    total_price = models.DecimalField(max_digits=10, decimal_places=2, default=0.00)
    tax_amount = models.DecimalField(max_digits=10, decimal_places=2, default=0.00)
    shipping_tax = models.DecimalField(max_digits=10, decimal_places=2, default=Decimal('0.00'))
    final_price = models.DecimalField(max_digits=10, decimal_places=2, default=0.00)
    is_ordered = models.BooleanField(default=False)
    status = models.CharField(max_length=20, choices=[
        ('New', 'New'),
        ('Pending', 'Pending'),
        ('Confirmed', 'Confirmed'),
        ('Shipped', 'Shipped'),
        ('Delivered', 'Delivered'),
        ('Cancelled', 'Cancelled')
    ], default='New')
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def save(self, *args, **kwargs):
        """Generate unique order_id if not already set before saving."""
        if not self.order_id:
            self.order_id = str(uuid.uuid4().hex[:10]).upper()
        super().save(*args, **kwargs)

    def __str__(self):
        return f"Order {self.order_id} by {self.first_name} {self.last_name}"
    
    def full_name(self):
        return f'{self.first_name} {self.last_name}'

class OrderItem(models.Model):
    order = models.ForeignKey(Order, on_delete=models.CASCADE, related_name="items")
    product_name = models.CharField(max_length=255)
    quantity = models.PositiveIntegerField(default=1)
    price = models.DecimalField(max_digits=10, decimal_places=2)
    subtotal = models.DecimalField(max_digits=10, decimal_places=2)

    def __str__(self):
        return f"{self.product_name} - {self.order.order_id}"
    

class Payment(models.Model):
    user = models.ForeignKey(Account, on_delete=models.SET_NULL, null=True, blank=True)
    order = models.OneToOneField(Order, on_delete=models.CASCADE, related_name="payment", null=True, blank=True)
    
    payment_id = models.CharField(max_length=50, unique=True, blank=True, null=True)
    payment_method = models.CharField(max_length=50, choices=[
        ('By Cheque', 'By Cheque'),
        ('Credit Card', 'Credit Card'),
    ])
    
    amount_paid = models.DecimalField(max_digits=10, decimal_places=2, default=0.00)
    status = models.CharField(max_length=20, choices=[
        ('Pending', 'Pending'),
        ('Completed', 'Completed'),
        ('Failed', 'Failed')
    ], default='Pending')
    
    created_at = models.DateTimeField(auto_now_add=True)
    completed_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return f"Payment {self.payment_id} - {self.status}"
    
