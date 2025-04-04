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
                        <h2>Cart</h2>
                        <span> <a href="./">Home</a> / Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cart -->
<section class="section-cart padding-t-100 padding-b-100">
    <div class="container">
        <div class="row d-none">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Cart</h2>
                    </div>
                    <div class="cr-banner-sub-title">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore lacus vel facilisis. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="cr-cart-content" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="row">
                        <form action="#">
                            <div class="cr-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>price</th>
                                            <th>Item code</th>
                                            <th class="text-center">Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {% for cart_item in cart_items %}
                                    <tbody>
                                        <tr>
                                            <td class="cr-cart-name">
                                                <a href="{{ cart_item.product_item.product.get_url }}">
                                                    <img src="{{ cart_item.product_item.product.photo_url.url }}" alt="{{ cart_item.product_name }}"
                                                        class="cr-cart-img">
                                                    {{ cart_item.item_description }}
                                                </a>
                                            </td>
                                            <td class="cr-cart-price">
                                                <span class="amount">${{ cart_item.item_price }}</span>
                                            </td>
                                            <td class="cr-cart-price">
                                                <span class="amount">{{ cart_item.manufacturer_code }}</span>
                                            </td>
                                            <td class="cr-cart-qty">
                                                <div class="cart-qty-plus-minus">
                                                    <a href="{% url 'increase_cart_quantity' cart_item.id %}" class="plus">+</a>
                                                    <input type="text" readonly value="{{ cart_item.quantity }}" minlength="1"
                                                        maxlength="20" class="quantity">
                                                    <a href="{% url 'decrease_cart_quantity' cart_item.id %}" class="minus">-</a>
                                                </div>
                                            </td>
                                            <td class="cr-cart-subtotal">${{ cart_item.subtotal }}</td>
                                            <td class="cr-cart-remove">
                                                <a href="{% url 'delete_cart_item' cart_item.id %}" onclick="return confirm('Are you sure you want to remove this item?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    {% empty %}
                                    <tr>
                                        <td colspan="5">Your cart is empty.</td>
                                    </tr>
                                    {% endfor %}
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-cart-update-bottom">
                                        <a href="product.php" class="cr-links">Continue Shopping</a>
                                        <a href="{% url 'checkout' %}" class="cr-button">
                                            Check Out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



{% endblock %}

</body>

</html>