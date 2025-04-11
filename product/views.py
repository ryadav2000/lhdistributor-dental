from django.shortcuts import render, get_object_or_404
from .models import Product
from productitem.models import ProductItem
from category.models import Category, SubCategory
from django.db.models import Q, Min


#Paginator Modules
from django.core.paginator import EmptyPage, PageNotAnInteger, Paginator

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

    products = products.order_by('product_name')

    paginator = Paginator(products, 12)
    page = request.GET.get('page')
    paged_products = paginator.get_page(page)

    context = {
        'products': paged_products,
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

    products = products.order_by('product_name')

    for product in products:
        product.price = product.items.first().item_price if product.items.exists() else None 

    
    paginator = Paginator(products, 12)
    page = request.GET.get('page')
    paged_products = paginator.get_page(page)

    context = {
        'products': paged_products,
        'subcategory': subcategory,
        'selected_category': category,  # Pass the parent category
        'subcategories': subcategories,  # Pass all subcategories of the parent category
        'product_count': product_count
    }

    return render(request, 'product.php', context)


def product_detail(request, category_slug, subcategory_slug, product_slug):

    # Fetch the product based on the slug
    product = get_object_or_404(Product, category__slug=category_slug, subcategory__slug=subcategory_slug, slug=product_slug)

    # Fetch all active product variations (ProductItem) for this product
    product_variations = ProductItem.objects.filter(product=product, activatedstatus=True)
    default_code = product_variations.first().manufacturer_code  # or set any specific logic

    # Fetch related products (same subcategory but exclude the current product)
    related_products = Product.objects.filter(
        subcategory=product.subcategory,
        activatedstatus=True
    ).exclude(id=product.id).prefetch_related('items', 'subcategory', 'brand') \
    .annotate(min_price=Min('items__item_price'))[:6]  # Annotate with the minimum price of related items

    # If less than 5 related products are found, get random products to fill the gap
    if len(related_products) < 5:
        needed = 5 - len(related_products)
        extra_products = Product.objects.filter(
            ~Q(id__in=[p.id for p in related_products]),  # Exclude already fetched related products
            activatedstatus=True
        ).annotate(min_price=Min('items__item_price')).order_by('?')[:needed]  # Annotate and get random products

        # Combine the related and random products
        related_products = list(related_products) + list(extra_products)

    context = {
        'product': product,
        'product_variations': product_variations,
        'default_code': default_code,
        'related_products': related_products
    }

    # print(related_products)

    return render(request, 'product-detail.php', context)


def search(request):
    keyword = request.GET.get('keyword', '').strip()  # Get keyword safely

    products = Product.objects.filter(activatedstatus=True).select_related("brand", "category", "subcategory").prefetch_related("items")

    if keyword:
        products = products.filter(
            Q(description__icontains=keyword) |
            Q(product_name__icontains=keyword) |
            Q(category__cat_name__icontains=keyword) |   # Search in Category name
            Q(subcategory__subcat_name__icontains=keyword) |  # Search in Subcategory name
            Q(brand__brand_name__icontains=keyword)  # Search in Brand name
        )

    product_count = products.count()

    products = products.order_by('product_name')

    for product in products:
        product.price = product.items.first().item_price if product.items.exists() else None  


    paginator = Paginator(products, 12)
    page = request.GET.get('page')
    paged_products = paginator.get_page(page)

    context = {
        'products': paged_products,
        'product_count': product_count,
        'keyword': keyword,
    }

    return render(request, 'product.php', context)


def online_special_products(request):
    products = Product.objects.filter(online_special=True, activatedstatus=True).prefetch_related('items')


    # Attach price from the first ProductItem (if exists)
    for product in products:
        product.price = product.items.first().item_price if product.items.exists() else None
        product.stock = product.items.first().stock if product.items.exists() else None

    
    paginator = Paginator(products, 12)
    page = request.GET.get('page')
    paged_products = paginator.get_page(page)


    return render(request, 'online-special.php', {'products': paged_products})


