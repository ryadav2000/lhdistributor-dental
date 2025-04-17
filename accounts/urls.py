from django.urls import path
from . import views


urlpatterns = [
    path('register/', views.register, name='register'),
    path('login/', views.login_view, name='login'),
    path('logout/', views.logout, name='logout'),
    path('activate/<uidb64>/<token>/', views.activate, name='activate'),
    
    #OTP
    path('password-reset/', views.request_opt, name='request_otp'),
    path('verify-otp/', views.verify_otp, name='verify_otp'),
    path('reset-password/', views.reset_password, name='reset_password'),

    # Dashboard Urls
    path('dashboard/', views.dashboard, name='dashboard'),
    path('order_info/', views.order_info, name='order_info'),
    path('order_detail/<int:order_id>/', views.order_detail, name='order_detail'),
    path('edit_profile/', views.edit_profile, name='edit_profile'),
    path('change_password/', views.change_password, name='change_password'),
]