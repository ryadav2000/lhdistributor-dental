from django.db import models
from django.urls import reverse

# Create your models here.

class Category(models.Model):
    cat_name          = models.CharField(max_length=200, null=True, blank=True)
    slug              = models.SlugField(max_length=250, unique=True)
    activatedstatus   = models.IntegerField(default=1)

    class Meta:
        verbose_name        = 'category'
        verbose_name_plural = 'categories'

    def get_url(self):
        return reverse('filter_by_category', args=[self.slug])

    
    def __str__(self):
        return self.cat_name if self.cat_name else "Unnamed Catgory"
    

class SubCategory(models.Model):
    subcat_name         = models.CharField(max_length=200, null=True, blank=True)
    slug                = models.SlugField(max_length=250, unique=True)
    Category            = models.ForeignKey(Category, on_delete=models.CASCADE, null=True, blank=True)
    activatedstatus     = models.IntegerField(default=1)

    class Meta:
        verbose_name          = 'subcategory'
        verbose_name_plural   = 'subcategories'


    def get_url(self):
        return reverse('filter_by_subcategory', args=[self.slug])

    def __str__(self):
        return self.subcat_name if self.subcat_name else "Unnamed SubCategory"