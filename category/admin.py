from django.contrib import admin
from .models import Category, SubCategory

# Register your models here.

class CategoryAdmin(admin.ModelAdmin):
    prepopulated_fields      = {'slug': ('cat_name',)}
    list_display             = ('cat_name', 'slug', 'activatedstatus')
    search_fields            = ('cat_name',)
    list_filter              = ('cat_name',)
    list_per_page            = 20
    


class SubCategoryAdmin(admin.ModelAdmin):
    prepopulated_fields      = {'slug': ('subcat_name',)}
    list_display             = ('subcat_name', 'slug', 'Category', 'activatedstatus')
    search_fields            = ('subcat_name',)
    list_filter              = ('subcat_name',)
    list_per_page            = 50


admin.site.register(Category, CategoryAdmin)
admin.site.register(SubCategory, SubCategoryAdmin)