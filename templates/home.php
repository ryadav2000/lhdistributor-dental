{% extends 'base.php' %}

{% load static %}


{% block content %}   

{% include 'includes/alerts.html' %}
    <section class="section-heros padding-b-50 next">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{% static 'img/banner/slide1.jpg' %}" class="d-block w-100" alt="Slide 2">
                </div>

                <div class="carousel-item">
                    <img src="{% static 'img/banner/slide2.jpg' %}" class="d-block w-100" alt="Slide 1">
                </div>

                <div class="carousel-item">
                    <img src="{% static 'img/banner/slide3.jpg' %}" class="d-block w-100" alt="Slide 1">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>



    <!-- Product banner -->
    <section class="section-product-banner padding-b-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-banner-slider swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image cr1">
                                    <img src="{% static 'img/product-banner/1.png' %}" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>SALIVA EJECTORS</h5>
                                        <h6>Not Specified</h6>
                                        <p><span class="text">SALIVA EJECTORS</span><span class="percent">$4.99</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="#" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image cr2">
                                    <img src="{% static 'img/product-banner/2.png' %}" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Accessories</h5>
                                        <h6>Plasdent</h6>
                                        <p> <span class="text">Plasdent Large Round Bur Block - Blue, Magnetic, 28 Burs
                                                Capacity</span><span class="percent">$6.26</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="#" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image cr3">
                                    <img src="{% static 'img/product-banner/3.png' %}" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Inverted Cone Carbide Burs</h5>
                                        <h6>SS WHITE</h6>
                                        <p> <span class="text">Inverted Cone (FG#38)</span><span
                                                class="percent">$21.15</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="#" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image cr4">
                                    <img src="{% static 'img/product-banner/4.png' %}" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Accessories</h5>
                                        <h6>Plasdent</h6>
                                        <p> <span class="text">Mixing Spatulas</span><span class="percent">$5.99</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="#" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image cr5">
                                    <img src="{% static 'img/product-banner/5.png' %}" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Cotton Products and Dispensers</h5>
                                        <h6>Microcopy</h6>
                                        <p> <span class="text">NeoDrys</span><span class="percent">$12.59</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="#" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image cr6">
                                    <img src="{% static 'img/product-banner/6.png' %}" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Cotton Roll Substitutes</h5>
                                        <h6>Not Specified</h6>
                                        <p> <span class="text">Small (Child) Yellow Neodry </span><span
                                                class="percent">$13.25</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="#" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Popular product -->
    <section class="section-popular-product-shape padding-b-50">
        <div class="container" data-aos="fade-up" data-aos-duration="2000">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>Popular Products</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Explore our extensive range of popular products that cater to your every need and
                                preference. From trending items to customer favorites, we've got you covered.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-content row mb-minus-24" id="MixItUpDA2FB7">
                <div class="col-xl-3 col-lg-4 col-12 mb-24">
                    <div class="row mb-minus-24 sticky">

                        <div class="col-lg-12 col-sm-6 col-6 cr-product-box banner-480 mb-24">
                            <div class="cr-ice-cubes">
                                <img src="{% static 'img/product/product-banner.jpg' %}" alt="product banner">
                                <!-- <div class="cr-ice-cubes-contain">
                                    <h4 class="title">AMALGAM RECYCLING </h4>
                                    <h5 class="sub-title">WasteWise</h5>
                                    <span>AMALGON</span>
                                    <span> $152.5</span>
                                   
                                    <a href="#" class="cr-button">Shop Now</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-12 mb-24">
                    <div class="row mb-minus-24">
                    {% for product in random_products %}
                        <div class="mix vegetable col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                      {% if product.photo_url %}
                                        <img src="{{ product.photo_url.url }}" alt="product-1">
                                      {% else %}
                                        <img src="" alt="product-1">
                                      {% endif %}
                                      
                                      {% if product.stock == 0 %}
                                        <div class="sold">
                                            <p>Out of stock</p>
                                        </div>
                                      {% endif %}

                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                            role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <!-- <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a> -->
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="{{ product.get_url }}">{{ product.subcategory }}</a>
                                        <div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>
                                    </div>

                                    <a href="{{ product.get_url }}" class="title">{{ product.brand }}</a>
                                    <a href="{{ product.get_url }}">
                                    <h6 class="mt-2 mb-2">{{ product.product_name }} </h6>
                                    <a href="{{ product.get_url }}" class="mt-3 b_details">Details</a>
                                    </a>
                                    <p class="cr-price"><span class="new-price">${{ product.price }}</span> </p>
                                </div>
                            </div>
                        </div>
                    {% endfor %}
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Services -->
    <section class="section-services padding-b-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-services-border" data-aos="fade-up" data-aos-duration="2000">
                        <div class="cr-service-slider swiper-container">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-customer-service-2-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>Order Online Service</h4>
                                            <p>Streamlined online ordering convenience at your fingertips.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-truck-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>Shipping</h4>
                                            <p>Free Shipping applies to order of $300 or more, up to 20lbs contiguous
                                                US.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-money-dollar-box-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>Payment Secure</h4>
                                            <p>Secure payment options for your peace of mind.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-red-packet-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>Return 30 Days</h4>
                                            <p>Enjoy a generous 30-day return window for hassle-free exchanges or
                                                refunds.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{% endblock %}



