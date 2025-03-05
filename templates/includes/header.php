{% load static %}

<!-- Header -->
<header>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-header">
                    <a href="{% url 'home' %}" class="cr-logo">
                        <img src="{% static 'img/logo/logo.png' %}" alt="logo" class="logo">
                        <img src="{% static 'img/logo/dark-logo.png' %}" alt="logo" class="dark-logo">
                    </a>
                    <form action="{% url 'search' %}" class="cr-search" method="GET">
                        <input class="search-input" type="text" name="keyword" placeholder="Search For items...">

                        <button type="submit" class="search-btn">
                            <i class="ri-search-line"></i>
                        </button>
                    </form>
                    <div class="cr-right-bar">

                        <!-- <a href="wishlist.php" class="cr-right-bar-item">
                <i class="ri-heart-3-line"></i>
                <span>Wishlist</span>
            </a> -->
                        <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle">
                            <i class="ri-shopping-cart-line"></i>
                            <span>Cart</span>
                        </a>

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                    <span class="user-login"> <i class="ri-user-3-line"></i></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="register.php">Register</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="checkout.php">Checkout</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="login.php">Login</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cr-fix" id="cr-main-menu-desk">
        <div class="container">
            <div class="cr-menu-list">

                <div id="mega-menu">
                    <div class="btn-mega"><span class="close-line"></span>ALL CATEGORIES</div>
                    <ul class="menu">
                        {% for category, subcategories in category_with_subcategories.items %}
                        <li>
                            <a href="{% if subcategories %}{% url 'filter_by_subcategory' subcategories.0.slug %}{% else %}#{% endif %}" title="" class="dropdown">
                                <span class="menu-title">{{ category.cat_name }}</span>
                            </a>
                            <div class="drop-menu">
                                <div class="one-third">
                                    <div class="cat-title">{{ category.cat_name }}</div>
                                    <ul>
                                        {% for subcategory in subcategories %}
                                        <li><a href="{% url 'filter_by_subcategory' subcategory.slug %}">{{ subcategory.subcat_name }}</a></li>
                                        {% endfor %}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        {% endfor %}
                    </ul>
                </div>


                <nav class="navbar navbar-expand-lg">
                    <a href="javascript:void(0)" class="navbar-toggler shadow-none">
                        <i class="ri-menu-3-line"></i>
                    </a>
                    <div class="cr-header-buttons">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:void(0)">
                                    <i class="ri-user-3-line"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">Register</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Checkout</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Login</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <a href="#" class="cr-right-bar-item">
                            <i class="ri-heart-line"></i>
                        </a>
                        <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle">
                            <i class="ri-shopping-cart-line"></i>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="./">
                                    Home
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="product.php">
                                    Online Specials
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Re Order From History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{% url 'brand_list' %}">
                                    Shop By Brand
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="cr-calling">

                    <a href="tel:5308596003">+1 (530) 859-6003</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Header End -->