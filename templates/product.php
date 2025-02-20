{% extends 'base.php' %}

{% load static %}


{% block content %}


<!-- Breadcrumb -->
<section class="section-breadcrumb">
    <div class="cr-breadcrumb-image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-breadcrumb-title">
                        <h2>Products</h2>
                        <span> <a href="./">Home</a> - products</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-shop padding-tb-100">
    <div class="container">
        <div class="row d-none">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Categories</h2>
                    </div>
                    <div class="cr-banner-sub-title">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore lacus vel facilisis. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-12 md-30" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <div class="cr-shop-sideview">
                    {% if selected_category %}
                    <div class="cr-shop-categories">
                        <h4 class="cr-shop-sub-title">{{ selected_category.cat_name }} Subcategories</h4>
                        <div class="cr-checkbox">
                            <ul>
                                {% for subcategory in subcategories %}
                                <li>
                                    <a href="{% url 'filter_by_subcategory' subcategory.slug %}" {% if subcategory.id == subcategory.id %} class="active" {% endif %}>
                                        {{ subcategory.subcat_name }}
                                    </a>
                                </li>
                                {% endfor %}
                            </ul>
                        </div>
                    </div>
                    {% endif %}
                </div>
            </div>

            <div class="col-lg-9 col-12 md-30" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                <div class="row">
                    <div class="col-12">
                        <div class="cr-shop-bredekamp">
                            <div class="cr-toggle">
                                <a href="javascript:void(0)" class="gridCol active-grid">
                                    <i class="ri-grid-line"></i>
                                </a>
                                <a href="javascript:void(0)" class="gridRow">
                                    <i class="ri-list-check-2"></i>
                                </a>
                            </div>
                            <div class="center-content">
                                <span>We found {{ product_count }} items for you!</span>
                            </div>
                            <div class="cr-select">
                                <label>Sort By :</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Featured</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                    <option value="5">Five</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-100 mb-minus-24">
                    {% for product in products %}

                    <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    {% if product.photo_url %}
                                    <img src="{{ product.photo_url.url }}" alt="product-1">
                                    {% else %}
                                    <img src="" alt="product-1">
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
                                <a class="cr-shopping-bag" href="javascript:void(0)">
                                    <i class="ri-shopping-bag-line"></i>
                                </a>
                            </div>
                            <div class="cr-product-details">
                                <div class="cr-brand">
                                    <a href="{{ product.get_url }}">{{ product.category }}</a>
                                    <div class="cr-star">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-line"></i>
                                        <p>(4.5)</p>
                                    </div>
                                </div>
                                <a href="{{ product.get_url }}" class="title">{{ product.brand }}</a>
                                <h6>{{ product.product_name }}</h6>
                                <p class="cr-price"><span class="new-price">${{ product.price }}</span></p>
                            </div>
                        </div>
                    </div>
                    {% empty %}
                    <p class="text-center">No products available.</p>
                    {% endfor %}
                </div>
                {% if products %}
                <nav aria-label="..." class="cr-pagination">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
                {% endif %}
            </div>
        </div>
    </div>
</section>




{% endblock %}


</body>

</html>