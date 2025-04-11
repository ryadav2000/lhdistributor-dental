from django.shortcuts import render, get_object_or_404
from .models import Brand
from product.models import Product
from collections import defaultdict

#Paginator Modules
from django.core.paginator import EmptyPage, PageNotAnInteger, Paginator

def brand_list(request):
    brands = Brand.objects.order_by('brand_name')
    # print("Fetched Brands:", brands)  # Debugging

    grouped_brands = defaultdict(list)

    for brand in brands:
        # print("Brand Name:", brand.brand_name)  # Debugging
        first_letter = brand.brand_name[0].upper()
        grouped_brands[first_letter].append(brand)

    return render(request, 'brand.php', {'grouped_brands': dict(grouped_brands)})


def brand_product(request, brand_slug):
    brand = get_object_or_404(Brand, slug=brand_slug, activatedstatus=1)
    products = Product.objects.filter(brand=brand, activatedstatus=True).prefetch_related('items')

    for product in products:
        product.price = product.items.first().item_price if product.items.exists() else None

    products = products.order_by('product_name')

    paginator = Paginator(products, 12)
    page = request.GET.get('page')
    paged_product = paginator.get_page(page)

    return render(request, 'brand-product.php', {'brand': brand, 'products': paged_product})
