from django.shortcuts import render
from product.models import Product
import random


def home(request):

    # Fetch all active products
    all_products = list(Product.objects.filter(activatedstatus=True).prefetch_related('items', 'subcategory', 'brand'))


     # Select 6 random products
    random_products = random.sample(all_products, min(len(all_products), 8))

    # Assign price to each product
    for product in random_products:
        product.price = product.items.first().item_price if product.items.exists() else None
        product.stock = product.items.first().stock if product.items.exists() else None

    
    context = {
        'random_products': random_products
    }
    return render(request, 'home.php', context)

def about_us(request):
    return render(request, 'about-us.php')


def contact_us(request):
    return render(request, 'contact-us.php')



# Extra pages
def return_policy(request):
    return render(request, 'returns-policy.php')



def privicy_policy(request):
    return render(request, 'privacy-policy.php')

def terms_and_condition(request):
    return render(request, 'terms-and-conditions.php')