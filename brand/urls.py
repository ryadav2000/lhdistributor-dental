from django.urls import path
from .views import brand_list
from .views import brand_product


urlpatterns = [
    path('', brand_list, name='brand_list'),
    path('brandproduct/<slug:brand_slug>/', brand_product, name='brand_product'),
]