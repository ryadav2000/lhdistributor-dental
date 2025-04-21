{% extends 'base.php' %}

{% block content %}




<!-- Breadcrumb -->
<section class="section-breadcrumb">
    <div class="cr-breadcrumb-image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-breadcrumb-title">
                        <h2>Online Special Products</h2>
                        <span> <a href="./">Home</a> -online special products</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Shop -->
<section class="section-shop padding-tb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Online Special Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12 col-12 md-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
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
                                <h6 class="mt-2">{{ product.product_name }}</h6>
                                <a href="{{ product.get_url }}" class="mt-3 b_details">Details</a>
                                {% with first_item=product.items.first %}
                                    {% if first_item %}
                                        <p class="cr-price"><span class="new-price">${{ first_item.item_price }}</span></p>
                                    {% endif %}
                                {% endwith %}
                            </div>
                        </div>
                    </div>
                    {% empty %}
                    <p class="text-center">No online special products available at the moment.</p>
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