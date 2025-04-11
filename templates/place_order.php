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
                        <h2>Order Review</h2>
                        <span> <a href="./">Home</a> - Order Review</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Checkout section -->
<section class="cr-checkout-section padding-tb-100 own-checkout-section">
    <div class="container">
        <div class="row">
            <!-- Billing Address -->
            <div class="cr-checkout-rightside col-lg-8 col-md-12 m-t-991">
                <!-- checkout content Start -->
                <div class="cr-checkout-content">
                    <div class="cr-checkout-inner">

                        <div class="cr-checkout-wrap">
                            <div class="cr-checkout-block cr-check-bill">
                                <h3 class="cr-checkout-title">Order Details</h3>
                                <div class="cr-bl-block-content">

                                    <div class="cr-check-bill-form mb-minus-24">
                                        <span class="cr-bill-wrap">
                                            <label>Name:</label>
                                            <p>{{ order.full_name  }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>Company Name:</label>
                                            <p>{{ order.company_name }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>Email:</label>
                                            <p>{{ order.email }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>Phone:</label>
                                            <p>{{ order.phone }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>Address:</label>
                                            <p>{{ order.address_line }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>City:</label>
                                            <p>{{ order.city }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>State:</label>
                                            <p> {{ order.state }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>Zip Code:</label>
                                            <p>{{ order.postal_code }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>Country:</label>
                                            <p>{{ order.country }}</p>
                                        </span>
                                        <span class="cr-bill-wrap">
                                            <label>Order Note:</label>
                                            <p>{{ order.order_note }}</p>
                                        </span>
                                    </div>

                                    <div class="order-items">

                                        <ul>
                                            {% for cart_item in cart_items %}
                                            <li class="item">
                                                <div class="item-img">
                                                    <img src="{{ cart_item.product_image.url }}" />
                                                </div>
                                                <div class="item-content">
                                                    <span class="item-heading">{{ cart_item.product_name }}</span>
                                                    <p><strong>Item Code: </strong>{{ cart_item.manufacturer_code }}</p>
                                                    <p><strong>Quantity: </strong>{{ cart_item.quantity }}</p>
                                                    <p><strong>Price: </strong> ${{ cart_item.item_price }}</p>
                                                </div>
                                            </li>
                                            {% endfor %}
                                        </ul>

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
                        <div class="cr-sb-title">
                            <h3 class="cr-sidebar-title text-center ">Summary</h3>
                        </div>
                        <div class="cr-checkout-summary">
                            <div>
                                <span class="text-left">Sub-Total</span>
                                <span class="text-right">${{ total_price }}</span>
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
                                <form action="{% url 'make_payment' %}" method="POST" class="payment-options">
                                    {% csrf_token %}

                                    <span class="cr-pay-option">
                                        <input type="radio" id="pay1" name="payment_method" value="by_cheque">
                                        <label for="pay1">By Cheque</label>
                                    </span>

                                    <span class="cr-pay-option">
                                        <input type="radio" id="pay2" name="payment_method" value="by_credit_card">
                                        <label for="pay2">Credit Card</label>
                                    </span>

                                    <input type="submit" class="cr-button mt-30 mb-30" value="Submit">
                                </form>
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