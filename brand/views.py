from django.shortcuts import render
from .models import Brand
from collections import defaultdict

def brand_list(request):
    brands = Brand.objects.order_by('brand_name')
    # print("Fetched Brands:", brands)  # Debugging

    grouped_brands = defaultdict(list)

    for brand in brands:
        # print("Brand Name:", brand.brand_name)  # Debugging
        first_letter = brand.brand_name[0].upper()
        grouped_brands[first_letter].append(brand)

    return render(request, 'brand.php', {'grouped_brands': dict(grouped_brands)})
