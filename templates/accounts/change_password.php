{% extends 'base.php' %}

{% load static %}

{% block content %}


<div class="main-user-dashboard">
        {% include 'includes/alerts.html' %}
        <div class="container">
            <div class="dashboard-container">
                <!-- Sidebar Navigation -->

                {% include 'includes/user_sidebar.php' %}

                <!-- Main Content Area -->
                <div class="main-content">
                    <!-- Change Password Section -->
                    <div id="password" class="content-section">
                        <div class="card">
                            <h3>Change Password</h3>
                            <form action="{% url 'change_password' %}" method="POST">
                                {% csrf_token %}
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="confirm_password" class="form-control">
                                </div>
                                <input type="submit" value="Update Password">
                                <!-- <button type="submit" class="btn btn-primary">Update Password</button> -->
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>






{% endblock %}