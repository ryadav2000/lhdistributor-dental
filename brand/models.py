import os
from django.db import models
from django.conf import settings

# Create your models here.

class Brand(models.Model):
    brand_name        = models.CharField(max_length=200, null=True, blank=True)
    slug              = models.SlugField(max_length=250, unique=True)
    activatedstatus   = models.IntegerField(default=1)
    brand_img         = models.ImageField(upload_to='brand_images/', null=True, blank=True)

    def save(self, *args, **kwargs):
        # Check if the instance already exists in the database
        if self.pk:
            try: 
                old_instance = Brand.objects.get(pk=self.pk)
                if old_instance.brand_img and old_instance.brand_img != self.brand_img:
                    old_image_path = os.path.join(settings.MEDIA_ROOT, old_instance.brand_img.name)
                    if os.path.isfile(old_image_path):
                        os.remove(old_image_path)  # Delete the old image
            except Brand.DoesNotExist:
                pass # If the instance is new, no need to delete anything

        super().save(*args, **kwargs)


    def delete(self, *args, **kwargs):
        # Delete the image file from storage
        if self.brand_img:
            image_path = os.path.join(settings.MEDIA_ROOT, self.brand_img.name)
            if os.path.isfile(image_path):
                os.remove(image_path)
            super().delete(*args, **kwargs)

    def __str__(self):
        return self.brand_name if self.brand_name else "Unnammed Brand"