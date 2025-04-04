from django import forms
from .models import Order

class OrderForm(forms.ModelForm):
    class Meta:
        model = Order
        fields = [
            "first_name", "last_name", "company_name", "phone", "email",
            "address_line", "city", "state", "postal_code", "country",
            "order_note"
        ]