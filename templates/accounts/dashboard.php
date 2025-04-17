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

            <div class="user-dashboard">
                <!-- Add this inside your <div class="user-dashboard"> -->
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="https://ui-avatars.com/api/?name=User+Name&background=6c5ce7&color=fff"
                                alt="Profile Picture">
                            <a href="{% url 'edit_profile' %}" class="edit-avatar-btn">
                                <i class="fas fa-camera"></i>
                            </a>
                        </div>
                        <h2>Welcome Back, <span>{{ user.full_name }}</span></h2>
                        <p>Joined: {{ user.date_joined }}</p>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ order_count }}</div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">${{ total_amount }}</div>
                            <div class="stat-label">Total Spent</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">0</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>

                    <div class="profile-details">
                        <div class="detail-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <div class="detail-label">Email</div>
                                <div class="detail-value">{{ user.email }}</div>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <div class="detail-label">Phone</div>
                                <div class="detail-value">+1 {{ user.phone_number }}</div>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <div class="detail-label">Address</div>
                                <div class="detail-value">{{ user.address_line }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <a href="{% url 'edit_profile' %}" class="edit-profile-btn">
                            <i class="fas fa-user-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
</div>



{% endblock %}