from django.contrib import admin
from .models import Brand

# Register your models here.

class BrandAdmin(admin.ModelAdmin):
    list_display           = ('brand_name', 'activatedstatus')
    prepopulated_fields    = {'slug': ('brand_name',)}
    search_fields          = ('brand_name',)
    list_filter            = ('brand_name',)


admin.site.register(Brand, BrandAdmin)