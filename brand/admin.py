from django.contrib import admin
from .models import Brand
import admin_thumbnails

# Register your models here.

@admin_thumbnails.thumbnail('brand_img')
class BrandAdmin(admin.ModelAdmin):
    list_display           = ('brand_img_thumbnail', 'brand_name', 'activatedstatus')
    prepopulated_fields    = {'slug': ('brand_name',)}
    search_fields          = ('brand_name',)
    list_filter            = ('brand_name',)


admin.site.register(Brand, BrandAdmin)