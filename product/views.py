from django.shortcuts import render, get_object_or_404
from .models import Product
from category.models import Category, SubCategory

# Create your views here.
def all_product_data(request):
    categories = Category.objects.filter(activatedstatus=1)
    selected_category = None
    subcategories = None
    products = Product.objects.filter(activatedstatus=True).prefetch_related('items')

    category_id = request.GET.get('category')
    subcategory_id = request.GET.get('subcategory')

    if category_id:
        selected_category = get_object_or_404(Category, id=category_id)
        subcategories = SubCategory.objects.filter(Category=selected_category, activatedstatus=1)

    if subcategory_id:
        subcategory = get_object_or_404(SubCategory, id=subcategory_id)
        products = products.filter(subcategory=subcategory)

    product_count = products.count()

    for product in products:
        product.price = product.items.first().item_price if product.items.exists() else None

    context = {
        'products': products,
        'product_count': product_count,
        'categories': categories,
        'selected_category': selected_category,
        'subcategories': subcategories,
    }

    return render(request, 'product.php', context)


def filter_by_subcategory(request, subcategory_slug):
    subcategory = get_object_or_404(SubCategory, slug=subcategory_slug)
    category = subcategory.Category  # Get the parent category

    products = Product.objects.filter(subcategory=subcategory, activatedstatus=True).prefetch_related('items')
    product_count = products.count()

    # Fetch all subcategories related to the parent category
    subcategories = SubCategory.objects.filter(Category=category, activatedstatus=True)

    for product in products:
        product.price = product.items.first().item_price if product.items.exists() else None 

    context = {
        'products': products,
        'subcategory': subcategory,
        'selected_category': category,  # Pass the parent category
        'subcategories': subcategories,  # Pass all subcategories of the parent category
        'product_count': product_count
    }

    return render(request, 'product.php', context)


def product_detail(request, category_slug, subcategory_slug, product_slug):
    return render(request, 'product-detail.php')


