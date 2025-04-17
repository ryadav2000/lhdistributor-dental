{% extends 'base.php' %}

{% load static %}


{% block content %}


<div class="main-user-dashboard">

        <div class="container">
            <div class="dashboard-container">
                <!-- Sidebar Navigation -->

                {% include 'includes/user_sidebar.php' %}

                <!-- Main Content Area -->
                <div class="main-content">

                    <!-- My Orders Section -->
                    <div id="orders" class="content-section">
                        <h3>My Orders</h3>

                        <div class="orders-table-container">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for order in orders %}
                                    <tr>
                                        <td><a class="order_info" href="{% url 'order_detail' order.id %}">{{ order.order_id }}</a></td>
                                        <td>{{ order.created_at }}</td>
                                        <td>{{ order.total_items }} Items</td>
                                        <td>${{ order.final_price }}</td>
                                        <td><span class="status {{order.status}}">{{ order.status }}</span></td>
                                        <td><a href="{% url 'order_detail' order.id %}" class="view-btn">View</a></td>
                                    </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>


    {% endblock %}