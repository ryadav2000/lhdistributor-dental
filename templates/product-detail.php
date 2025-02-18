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
                        <h2>Product Detail</h2>
                        <span> <a href="./">Home</a> - product Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Product -->
<section class="section-product padding-t-100">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 md-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="row mb-minus-24">
                    <div class="col-md-5 col-12 mb-24">
                        <div class="vehicle-detail-banner banner-content clearfix">
                            <div class="banner-slider">
                                <div class="slider slider-for">
                                    <div class="slider-banner-image">
                                        <div class="zoom-image-hover">
                                            <img src="{% static 'img/product/1.jpg' %}" alt="product-tab-1"
                                                class="product-image">
                                        </div>
                                    </div>
                                    <div class="slider-banner-image">
                                        <div class="zoom-image-hover">
                                            <img src="{% static 'img/product/2.jpg' %}" alt="product-tab-2"
                                                class="product-image">
                                        </div>
                                    </div>
                                    <div class="slider-banner-image">
                                        <div class="zoom-image-hover">
                                            <img src="{% static 'img/product/3.jpg' %}" alt="product-tab-3"
                                                class="product-image">
                                        </div>
                                    </div>
                                    <div class="slider-banner-image">
                                        <div class="zoom-image-hover">
                                            <img src="{% static 'img/product/4.jpg' %}" alt="product-tab-1"
                                                class="product-image">
                                        </div>
                                    </div>
                                    <div class="slider-banner-image">
                                        <div class="zoom-image-hover">
                                            <img src="{% static 'img/product/5.jpg' %}" alt="product-tab-2"
                                                class="product-image">
                                        </div>
                                    </div>

                                </div>
                                <div class="slider slider-nav thumb-image">
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{% static 'img/product/1.jpg' %}" alt="product-tab-1">
                                        </div>
                                    </div>
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{% static 'img/product/2.jpg' %}" alt="product-tab-2">
                                        </div>
                                    </div>
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{% static 'img/product/3.jpg' %}" alt="product-tab-3">
                                        </div>
                                    </div>
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{% static 'img/product/4.jpg' %}" alt="product-tab-1">
                                        </div>
                                    </div>
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{% static 'img/product/5.jpg' %}" alt="product-tab-2">
                                        </div>
                                    </div>
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{% static 'img/product/6.jpg' %}" alt="product-tab-3">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-12 mb-24">
                        <div class="cr-size-and-weight-contain">
                            <h2 class="heading">Seeds Of Change Oraganic Quinoa, Brown</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In, iure minus error
                                doloribus saepe natus?</p>
                        </div>
                        <div class="cr-size-and-weight">
                            <div class="cr-review-star">
                                <div class="cr-star">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                </div>
                                <p>( 75 Review )</p>
                            </div>


                            <div class="cr-size-weight">
                                <h5><span>Packaging</span> :</h5>
                                <div class="cr-kg">
                                    <ul>
                                        <li>1kg</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="cr-size-weight">
                                <h5><span>Category Name</span> :</h5>
                                <div class="cr-kg cr-list">
                                    <ul>
                                        <li class="active-color">SLI-10S Straight insert with metal grip</li>
                                        <li>SLI-10S Straight insert</li>

                                    </ul>
                                </div>
                            </div>

                            <div class="style-desciption">

                                <ul>
                                    <li class="active-dec">

                                        <div class="item-code">
                                            <strong>Item # :</strong> Ac-908001
                                        </div>
                                        <div class="description">
                                            <h5><span>Description</span> :</h5>

                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi error
                                                veritatis distinctio nam dolore illo tempore, accusamus fugiat
                                                quidem quod dignissimos eligendi. Blanditiis dolorum quibusdam unde
                                                provident adipisci quam quod.</p>

                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi error
                                                veritatis distinctio nam dolore illo tempore, accusamus fugiat
                                                quidem quod dignissimos eligendi. Blanditiis dolorum quibusdam unde
                                                provident adipisci quam quod.</p>

                                        </div>
                                        <div class="cr-product-price">
                                            <span class="new-price">$120.25</span>
                                            <span class="old-price">$123.25</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item-code">
                                            <strong>Item # :</strong> Ac-908001
                                        </div>
                                        <div class="description">
                                            <h5><span>Description</span> :</h5>

                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi error
                                                veritatis distinctio nam dolore illo tempore, accusamus fugiat
                                                quidem quod dignissimos eligendi. Blanditiis dolorum quibusdam unde
                                                provident adipisci quam quod.</p>

                                        </div>

                                        <div class="cr-product-price">
                                            <span class="new-price">$120.25</span>
                                            <span class="old-price">$123.25</span>
                                        </div>
                                    </li>
                                </ul>


                            </div>
                            <div class="cr-add-card">
                                <div class="cr-qty-main">
                                    <button type="button" id="add" class="plus">+</button>
                                    <input type="text" placeholder="." value="1" minlength="1" maxlength="20"
                                        class="quantity">
                                    <button type="button" id="sub" class="minus">-</button>
                                </div>
                                <div class="cr-add-button">
                                    <button type="button" class="cr-button cr-shopping-bag">Add to cart</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="cr-paking-delivery">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="additional-tab" data-bs-toggle="tab"
                                data-bs-target="#additional" type="button" role="tab" aria-controls="additional"
                                aria-selected="false">Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                type="button" role="tab" aria-controls="review"
                                aria-selected="false">Review</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <div class="cr-tab-content">
                                <div class="cr-description">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error in vero
                                        sapiente odio, error dolore vero temporibus consequatur, nobis veniam odit
                                        dignissimos consectetur quae in perferendis
                                        doloribusdebitis corporis, eaque dicta, repellat amet, illum adipisci vel
                                        perferendis dolor! Quis vel consequuntur repellat distinctio rem. Corrupti
                                        ratione alias odio, error dolore temporibus consequatur, nobis veniam odit
                                        laborum dignissimos consectetur quae vero in perferendis provident quis.</p>
                                </div>
                                <h4 class="heading">Packaging & Delivery</h4>
                                <div class="cr-description">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error in vero
                                        perferendis dolor! Quis vel consequuntur repellat distinctio rem. Corrupti
                                        ratione alias odio, error dolore temporibus consequatur, nobis veniam odit
                                        laborum dignissimos consectetur quae vero in perferendis provident quis.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                            <div class="cr-tab-content">
                                <div class="cr-description">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error in vero
                                        sapiente
                                        doloribus debitis corporis, eaque dicta, repellat amet, illum adipisci vel
                                        perferendis dolor! Quis vel consequuntur repellat distinctio rem. Corrupti
                                        ratione alias odio, error dolore temporibus consequatur, nobis veniam odit
                                        laborum dignissimos consectetur quae vero in perferendis provident quis.</p>
                                </div>
                                <div class="list">
                                    <ul>
                                        <li><label>Brand <span>:</span></label>ESTA BETTERU CO</li>
                                        <li><label>Flavour <span>:</span></label>Super Saver Pack</li>
                                        <li><label>Diet Type <span>:</span></label>Vegetarian</li>
                                        <li><label>Weight <span>:</span></label>200 Grams</li>
                                        <li><label>Speciality <span>:</span></label>Gluten Free, Sugar Free</li>
                                        <li><label>Info <span>:</span></label>Egg Free, Allergen-Free</li>
                                        <li><label>Items <span>:</span></label>1</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="cr-tab-content-from">
                                <div class="post">
                                    <div class="content">
                                        <img src="{% static 'img/review/1.jpg' %}" alt="review">
                                        <div class="details">
                                            <span class="date">Jan 08, 2024</span>
                                            <span class="name">Oreo Noman</span>
                                        </div>
                                        <div class="cr-t-review-rating">
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error in vero
                                        sapiente doloribus debitis corporis, eaque dicta, repellat amet, illum
                                        adipisci vel
                                        perferendis dolor! quae vero in perferendis provident quis.</p>
                                    <div class="content mt-30">
                                        <img src="{% static 'img/review/2.jpg' %}" alt="review">
                                        <div class="details">
                                            <span class="date">Mar 22, 2024</span>
                                            <span class="name">Lina Wilson</span>
                                        </div>
                                        <div class="cr-t-review-rating">
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-line"></i>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error in vero
                                        sapiente doloribus debitis corporis, eaque dicta, repellat amet, illum
                                        adipisci vel
                                        perferendis dolor! quae vero in perferendis provident quis.</p>
                                </div>

                                <h4 class="heading">Add a Review</h4>
                                <form action="javascript:void(0)">
                                    <div class="cr-ratting-star">
                                        <span>Your rating :</span>
                                        <div class="cr-t-review-rating">
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-line"></i>
                                            <i class="ri-star-s-line"></i>
                                            <i class="ri-star-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="cr-ratting-input">
                                        <input name="your-name" placeholder="Name" type="text">
                                    </div>
                                    <div class="cr-ratting-input">
                                        <input name="your-email" placeholder="Email*" type="email" required="">
                                    </div>
                                    <div class="cr-ratting-input form-submit">
                                        <textarea name="your-commemt" placeholder="Enter Your Comment"></textarea>
                                        <button class="cr-button" type="submit" value="Submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular products -->
<section class="section-popular-products padding-tb-100" data-aos="fade-up" data-aos-duration="2000"
    data-aos-delay="400">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-30">
                    <div class="cr-banner">
                        <h2>Popular Products</h2>
                    </div>
                    <div class="cr-banner-sub-title">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et viverra maecenas accumsan lacus vel facilisis. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="cr-popular-product">
                    <div class="slick-slide">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{% static 'img/product/1.jpg' %}" alt="product-1">
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
                                    <a href="product-detail.php">Snacks</a>
                                    <div class="cr-star">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-line"></i>
                                        <p>(4.5)</p>
                                    </div>
                                </div>
                                <a href="product-detail.php" class="title">Best snakes with hazel nut
                                    mix pack 200gm</a>
                                    <h6>Crosstex Horseshoe </h6>
                                <p class="cr-price"><span class="new-price">$120.25</span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="slick-slide">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{% static 'img/product/2.jpg' %}" alt="product-1">
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
                                    <a href="product-detail.php">Snacks</a>
                                    <div class="cr-star">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <p>(5.0)</p>
                                    </div>
                                </div>
                                <a href="product-detail.php" class="title">Sweet snakes crunchy nut
                                    mix 250gm
                                    pack</a>
                                <h6>Crosstex Horseshoe </h6>
                                <p class="cr-price"><span class="new-price">$100.00</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="slick-slide">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{% static 'img/product/3.jpg' %}" alt="product-1">
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
                                    <a href="product-detail.php">Snacks</a>
                                    <div class="cr-star">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-line"></i>
                                        <p>(4.5)</p>
                                    </div>
                                </div>
                                <a href="product-detail.php" class="title">Best snakes with hazel nut
                                    mix pack 200gm</a>
                                <h6>Crosstex Horseshoe </h6>
                                <p class="cr-price"><span class="new-price">$120.25</span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="slick-slide">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{% static 'img/product/4.jpg' %}" alt="product-1">
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
                                    <a href="product-detail.php">Snacks</a>
                                    <div class="cr-star">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <p>(5.0)</p>
                                    </div>
                                </div>
                                <a href="product-detail.php" class="title">Sweet snakes crunchy nut
                                    mix 250gm
                                    pack</a>
                                <h6>Crosstex Horseshoe </h6>
                                <p class="cr-price"><span class="new-price">$100.00</span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="slick-slide">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{% static 'img/product/5.jpg' %}" alt="product-1">
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
                                    <a href="product-detail.php">Snacks</a>
                                    <div class="cr-star">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <p>(5.0)</p>
                                    </div>
                                </div>
                                <a href="product-detail.php" class="title">Sweet snakes crunchy nut
                                    mix 250gm
                                    pack</a>
                                <h6>Crosstex Horseshoe </h6>
                                <p class="cr-price"><span class="new-price">$100.00</span> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{% endblock %}



</body>

</html>