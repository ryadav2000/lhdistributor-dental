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
        {% if 'search' in request.path %}
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Search Results</h2>
                    </div>
                </div>
            </div>
        </div>
        {% endif %}
        <div class="row">
            {% if 'search' not in request.path %}
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
            {% endif %}

        {% if 'search' in request.path %}
            <div class="col-lg-12 col-12 md-30" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
        {% else %}
            <div class="col-lg-9 col-12 md-30" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
        {% endif %}
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
                        </div>
                    </div>
                </div>
                <div class="row col-100 mb-minus-24">
                    {% for product in products %}

                {% if 'search' in request.path %}
                    <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                {% else %}
                    <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                {% endif %}
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
                                <h6 class="mt-2 mb-2">{{ product.product_name }}</h6>
                                <a href="{{ product.get_url }}" class="mt-3 b_details">Details</a>
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
                {% if products.has_other_pages %}
                    <ul class="pagination">
                        {% if products.has_previous %}
                        <li class="page-item">
                            <a href="?page={{ products.previous_page_number }}">
                            <span class="page-link">Previous</span>
                            </a>
                        </li>
                        {% else %}
                        <li class="page-item disabled">
                            <a href="#">
                            <span class="page-link">Previous</span>
                            </a>
                        </li>
                        {% endif %}

                        {% for i in products.paginator.page_range %}
                            {% if products.number == i %}
                                <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ i }}</span>
                                </li>
                            {% else %}
                                <li class="page-item" aria-current="page">
                                    <a href="?page={{ i }}">
                                        <span class="page-link">{{ i }}</span>
                                    </a>
                                </li>
                            {% endif %}
                        {% endfor %}
                        
                        {% if products.has_next %}
                        <li class="page-item">
                            <a class="page-link" href="?page={{ products.next_page_number }}">Next</a>
                        </li>
                        {% else %}
                        <li class="page-item">
                            <a class="page-link disable" href="#">Next</a>
                        </li>
                        {% endif %}
                    </ul>
                {% endif %}
                </nav>
                {% endif %}
            </div>
        </div>
    </div>
</section>




{% endblock %}


</body>

</html>