import os
from django.db import models
from category.models import Category, SubCategory
from brand.models import Brand
from django.db.models import JSONField
from django.conf import settings
from django.urls import reverse

class Product(models.Model):
    product_name = models.CharField(max_length=500, verbose_name="Product Name", null=True)
    slug  = models.SlugField(max_length=550, null=True, blank=True)
    category = models.ForeignKey(Category, on_delete=models.SET_NULL, null=True, blank=True, verbose_name="Category")
    subcategory = models.ForeignKey(SubCategory, on_delete=models.SET_NULL, null=True, blank=True, verbose_name="Subcategory")
    brand = models.ForeignKey(Brand, on_delete=models.SET_NULL, null=True, blank=True, verbose_name="Brand")
    description = models.TextField(null=True, blank=True, verbose_name="Description")
    photo_url = models.ImageField(upload_to='product_images/', null=True, blank=True, verbose_name="Product Image")
    product_details = JSONField(null=True, blank=True, verbose_name="Product Details")
    new_arrival = models.BooleanField(default=False, verbose_name="New Arrival")
    our_product = models.BooleanField(default=False, verbose_name="Our Product")
    activatedstatus = models.BooleanField(default=True, verbose_name="Activated Status")

    def __str__(self):
        return f"{self.product_name} ({self.brand})" if self.product_name else "Unnamed Product"

    def save(self, *args, **kwargs):
        # Check if the instance already exists in the database
        if self.pk:
            try:
                old_instance = Product.objects.get(pk=self.pk) # Fetch the old instance
                if old_instance.photo_url and old_instance.photo_url != self.photo_url:
                    old_image_path = os.path.join(settings.MEDIA_ROOT, old_instance.photo_url.name)
                    if os.path.isfile(old_image_path):
                        os.remove(old_image_path) # Delete old image
            except Product.DoesNotExist:
                pass # If the instance is new, no need to delete anything

        # Automatically set description to the value of product_name
        if self.product_name and not self.description:
            self.description = self.product_name

        super().save(*args, **kwargs) # Save the new image and data
        

    def delete(self, *args, **kwargs):
        # Delete the image file from storage
        if self.photo_url:
            image_path = os.path.join(settings.MEDIA_ROOT, self.photo_url.name)
            if os.path.isfile(image_path):
                os.remove(image_path)
            super().delete(*args, **kwargs)

    def get_url(self):
        return reverse('product_detail', args=[self.category.slug, self.subcategory.slug, self.slug])

    class Meta:
        verbose_name = "Product"
        verbose_name_plural = "Products"