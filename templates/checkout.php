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
                        <h2>Checkout</h2>
                        <span> <a href="./">Home</a> - Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Checkout section -->
<section class="cr-checkout-section padding-tb-100">
    <div class="container">
        <div class="row">
            <!-- Billing Address -->
            <div class="cr-checkout-rightside col-lg-8 col-md-12 m-t-991">
                <!-- checkout content Start -->
                <div class="cr-checkout-content">
                    <div class="cr-checkout-inner">
                    {% include 'includes/alerts.html' %}
                        <div class="cr-checkout-wrap">
                            <div class="cr-checkout-block cr-check-bill">
                                <h3 class="cr-checkout-title">Billing Details</h3>
                                <div class="cr-bl-block-content">
                                  
                                    <div class="cr-check-bill-form mb-minus-24">
                                        <form action="{% url 'place_order' %}" method="POST">
                                            {% csrf_token %}
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>First Name*</label>
                                                <input type="text" name="first_name"
                                                    placeholder="Enter your first name" id="bill_firstname" value="{{ billing_details.first_name  }}" required>
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Last Name*</label>
                                                <input type="text" name="last_name"
                                                    placeholder="Enter your last name" id="bill_lastname" value="{{ billing_details.last_name }}" required>
                                            </span>
                                            <span class="cr-bill-wrap">
                                                <label>Company Name*</label>
                                                <input type="text" name="company_name"
                                                    placeholder="Enter your company name" id="bill_companyname" value="{{ billing_details.company_name }}" required>
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Email*</label>
                                                <input type="email" name="email"
                                                    placeholder="Enter your email" id="bill_email" value="{{ billing_details.email }}" required>
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Phone*</label>
                                                <input type="text" name="phone"
                                                    placeholder="Enter your phone no" id="bill_phone" value="{{ billing_details.phone }}" required>
                                            </span>
                                            <span class="cr-bill-wrap">
                                                <label>Address</label>
                                                <input type="text" name="address_line" id="bill_address" value="{{ billing_details.address }}" placeholder="Address Line 1">
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Town / City *</label>
                                                <input type="text" name="city" id="bill_city" value="{{ billing_details.city }}" placeholder="Enter city">
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                            <label>State</label>
                                            <select name="state" id="bill_state" required>
                                            <option value="">Select State</option>
                                            {% for state in states %}
                                            <option value="{{ state.id }}" {% if billing_details.state == state.id %}selected{% endif %}>
                                                {{ state.name }}
                                            </option>
                                            {% endfor %}
                                            </select>
                                            </span>
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>Zip Code</label>
                                                <input type="text" name="postal_code" id="bill_zipcode" value="{{ billing_details.zipcode }}" placeholder="Post Code / Zip Code">
                                            </div>  
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>Country</label>
                                                <input type="text" name="country" id="bill_country" value="{{ billing_details.country }}" placeholder="Country">
                                            </div>

                                            <span class="cr-bill-wrap checkbox-input">
                                                <label> <input type="checkbox" id="same_as_billing_address"/> The same as shipping address</label>
                                            </span>                                                      
                                            
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>First Name*</label>
                                                <input type="text" name="first_name"
                                                    placeholder="Enter your first name" id="ship_firstname" required>
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Last Name*</label>
                                                <input type="text" name="last_name"
                                                    placeholder="Enter your last name" id="ship_lastname" required>
                                            </span>
                                            <span class="cr-bill-wrap">
                                                <label>Company Name*</label>
                                                <input type="text" name="company_name"
                                                    placeholder="Enter your company name" id="ship_companyname" required>
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Email*</label>
                                                <input type="email" name="email"
                                                    placeholder="Enter your email" id="ship_email" required>
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Phone*</label>
                                                <input type="text" name="phone"
                                                    placeholder="Enter your phone no" id="ship_phone" required>
                                            </span>
                                            <span class="cr-bill-wrap">
                                                <label>Address</label>
                                                <input type="text" name="address_line" id="ship_address" placeholder="Address Line 1">
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                                <label>Town / City *</label>
                                                <input type="text" name="city" id="ship_city" placeholder="Enter city">
                                            </span>
                                            <span class="cr-bill-wrap cr-bill-half">
                                            <label>State</label>
                                            <select name="state" id="bill_state" required>
                                            <option value="">Select State</option>
                                            {% for state in states %}
                                            <option value="{{ state.id }}" {% if billing_details.state == state.id %}selected{% endif %}>
                                                {{ state.name }}
                                            </option>
                                            {% endfor %}
                                            </select>
                                            </span>
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>Zip Code</label>
                                                <input type="text" name="postal_code" id="ship_zipcode" placeholder="Post Code / Zip Code">
                                            </div>  
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>Country</label>
                                                <input type="text" name="country" id="ship_country" placeholder="Country">
                                            </div>

                                            <span class="cr-bill-wrap">
                                                <label>Order Note</label>
                                                <textarea cols="5" rows="7" name="order_note" placeholder="Order Note"></textarea>
                                            </span>

                        <div class="cr-check-order-btn" style="width: 100%;">
                            <button type="submit" class="cr-button mt-30 mb-30">Place Order</button>
                        </div>
                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--cart content End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="cr-checkout-leftside col-lg-4 col-md-12">
                <div class="cr-sidebar-wrap">
                    <!-- Sidebar Summary Block -->
                    <div class="cr-sidebar-block">
                        
                        <div class="cr-sb-block-content">
                            
                            <div class="cr-checkout-pro">
                                {% for item in cart_items %}
                                <div class="col-sm-12 mb-6">
                                    <div class="cr-product-inner">
                                        <div class="cr-pro-image-outer">
                                            <div class="cr-pro-image">
                                                <a href="product.php" class="image">
                                                    <img class="main-image" src="{{ item.product_image.url }}"
                                                        alt="Product">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="cr-pro-content cr-product-details">
                                            <h5 class="cr-pro-title"><a href="product.php">{{ item.product_name }}</a></h5>
                                                    <p class="cr-"><span>Item Code : </span>{{ item.manufacturer_code }}</p>
                                            <!-- <div class="cr-pro-rating">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                            </div> -->
                                            <p class="cr-"><span>Quantity : </span>{{ item.quantity }}</p>
                                            <p class="cr-pricey"><span class="new-price">${{ item.subtotal }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                {% endfor %}
                            </div>
                        </div>
                        <div class="cr-sb-title">
                            <h3 class="cr-sidebar-title text-center mt-5">Summary</h3>
                        </div>
                        <div class="cr-checkout-summary">
                                <div>
                                    <span class="text-left">Sub-Total</span>
                                    <span class="text-right">${{ cart_total_price }}</span>
                                </div>
                                <div>
                                    <span class="text-left">Estimated Tax</span>
                                    <span class="text-right">${{ tax_amount|floatformat:2 }}</span>
                                </div>
                                <div>
                                    <span class="text-left">Shipping Tax</span>
                                    <span class="text-right">${{ shipping_tax|floatformat:2 }}</span>
                                </div>
                                <div class="cr-checkout-summary-total">
                                    <span class="text-left">Total Amount</span>
                                    <span class="text-right">${{ final_price |floatformat:2 }}</span>
                                </div>
                            </div>
                    </div>
                    <!-- Sidebar Summary Block -->
                </div>
            
                <div class="cr-sidebar-wrap cr-checkout-pay-wrap">
                    <!-- Sidebar Payment Block -->
                    <div class="cr-sidebar-block">
                        <div class="cr-sb-title">
                            <h3 class="cr-sidebar-title">Payment Method</h3>
                        </div>
                        <div class="cr-sb-block-content">
                            <div class="cr-checkout-pay">
                                <div class="cr-check-pay-img mb-4">
                                    <img src="{% static 'img/banner/payment.png' %}" alt="payment">
                                </div>
                                <!-- <form action="#" class="payment-options">
                                    <span class="cr-pay-option">
                                        <span>
                                            <input type="radio" id="pay1" name="radio-group" checked>
                                            <label for="pay1">Cash On Delivery</label>
                                        </span>
                                    </span>
                                    <span class="cr-pay-option">
                                        <span>
                                            <input type="radio" id="pay2" name="radio-group">
                                            <label for="pay2">UPI</label>
                                        </span>
                                    </span>
                                    <span class="cr-pay-option">
                                        <span>
                                            <input type="radio" id="pay3" name="radio-group">
                                            <label for="pay3">Bank Transfer</label>
                                        </span>
                                    </span>
                                </form> -->
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Payment Block -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Checkout section End -->

{% endblock %}