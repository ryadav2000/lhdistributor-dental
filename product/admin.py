from django.contrib import admin
from .models import Product
from django import forms
import json

# Custom form for Product
class ProductAdminForm(forms.ModelForm):
    # Dynamic fields (key-value pairs)
    additional_fields = forms.CharField(
        widget=forms.Textarea(attrs={
            'placeholder': 'Add additional key-value pairs in JSON format. Example:\n{\n  "Size": "Fits 5/8" drain",\n  "Type": "Solids collector with removable screen"\n}',
            'style': 'width: 100%; height: 100px; font-family: monospace;'
        }),
        required=False,
        label="Additional Fields (JSON)",
        help_text='<strong style="font-size: 14px;">Enter additional key-value pairs in JSON format. Follow this format to add additional data. Example: {"Size": "Fits 5/8\\" drain", "Type": "Solids collector with removable screen"}.</strong>'
    )

    class Meta:
        model = Product
        fields = '__all__'
        widgets = {
            'product_details': forms.HiddenInput(),  # Hide the product_details field
        }
        help_texts = {
            'product_name': 'Enter the name of the product.',
            'subcategory': 'Select the subcategory for the product.',
            'description': 'Enter a detailed description of the product.',
            'photo_url': 'Upload an image of the product.',  # Updated field name
            'new_arrival': 'Check this box if the product is a new arrival.',
            'our_product': 'Check this box if the product is one of our own.',
            'activatedstatus': 'Check this box to activate the product.',
        }

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        # Populate the predefined fields with data from product_details (if it exists)
        if self.instance and self.instance.product_details:
            product_details = self.instance.product_details
            # Populate additional_fields with the remaining key-value pairs
            additional_fields = {k: v for k, v in product_details.items() if k not in ["Manufacturer Code", "Brand", "Component(s)", "Packaging"]}
            self.fields['additional_fields'].initial = json.dumps(additional_fields, indent=2)

    def save(self, commit=True):
        # Parse and merge additional fields (if provided)
        additional_fields = self.cleaned_data.get("additional_fields", "")
        product_details = self.instance.product_details or {}  # Initialize if None

        if additional_fields:
            try:
                additional_fields = json.loads(additional_fields)
                if isinstance(additional_fields, dict):
                    product_details.update(additional_fields)  # Merge additional fields
            except json.JSONDecodeError:
                raise forms.ValidationError("Invalid JSON format in Additional Fields.")

        # Save the combined JSON object to the product_details field
        self.instance.product_details = product_details
        return super().save(commit=commit)


# Online Special Add To Online Special
@admin.action(description='Mark selected products as Online Special')
def make_online_special(modeladmin, request, queryset):
    queryset.update(online_special=True)


# Online Special Remove from Online Special
@admin.action(description='Remove selected product from Online special')
def remove_online_special(modeladmin, requeest, queryset):
    queryset.update(remove_online_special)


# Customize the Product admin interface
class ProductAdmin(admin.ModelAdmin):
    form = ProductAdminForm
    prepopulated_fields      = {'slug': ('product_name',)}
    list_display = ('product_name', 'category', 'subcategory', 'brand', 'activatedstatus', 'online_special')
    search_fields = ('product_name',)
    list_filter = ('product_name',)
    list_editable = ('online_special',)
    actions = [make_online_special, remove_online_special]

    fieldsets = (
        (None, {
            'fields': (
                'product_name', 'slug', 'category', 'subcategory', 'brand', 'description', 'photo_url',  # Updated field name
                'additional_fields',  # Dynamic fields
                'new_arrival', 'our_product', 'activatedstatus'
            ),
        }),
    )


admin.site.register(Product, ProductAdmin)