{% extends 'base.php' %}

{% load static %}


{% block content %}


<div class="user-product-view">
    <div class="container">
        <div class="order-detail-container">
            <h3>Order #{{ order.order_id }}</h3>
            <div class="d-flex gap-4">
                <p>Placed on: {{ order.created_at }}</p>
                <p>Status: <strong>{{ order.status }}</strong></p>
            </div>

            <h4>Items:</h4>

            <ul>
                {% for item in items %}
                <li style="margin-bottom: 10px;">
                    {% if item.product_image_url %}
                    <img src="{{ item.product_image_url }}" alt="{{ item.product_name }}" style="width: 100px; height: auto;">
                    {% endif %}
                   <p class="item-info">
                   {{ item.product_name }} × {{ item.quantity }} <span>${{ item.price }}</span>
                   </p> 
                </li>
                {% endfor %}
            </ul>

            <div class="user-total">
                <p>Subtotal: <span>${{ order.total_price }}</span> </p>
                <p>Estimated Tax: <span>${{ order.tax_amount }}</span> </p>
                <p>Shipping: <span>${{ order.shipping_tax }}</span> </p>
                <p><strong>Total: <span>${{ order.final_price }}</span> </strong></p>
            </div>

        </div>
    </div>
</div>


{% endblock %}