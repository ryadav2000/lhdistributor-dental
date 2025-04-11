from django.urls import path
from .views import all_product_data, filter_by_subcategory, product_detail, search, online_special_products

urlpatterns = [
    path('', all_product_data, name='all_product'),
    # path('category/<slug:category_slug>/', filter_by_category, name='filter_by_category'),
    path('subcategory/<slug:subcategory_slug>/', filter_by_subcategory, name="filter_by_subcategory"),
    path('<slug:category_slug>/<slug:subcategory_slug>/<slug:product_slug>/', product_detail, name="product_detail"),
    path('search/', search, name='search'),

    # Online Special
    path('online-special/', online_special_products, name='online-special'),
]