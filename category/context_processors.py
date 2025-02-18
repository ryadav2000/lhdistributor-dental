from .models import Category, SubCategory

def category_subcategory_context(request):
    categories = Category.objects.filter(activatedstatus=1)

    # Fetch subcategories related to categories
    category_with_subcategories = {
        category: SubCategory.objects.filter(Category=category, activatedstatus=1)
        for category in categories
    }

    return {
        'categories': categories,
        'category_with_subcategories': category_with_subcategories
    }
