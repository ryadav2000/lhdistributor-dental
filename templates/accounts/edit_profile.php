{% extends 'base.php' %}

{% load static %}

{% block content %}


<div class="main-user-dashboard">
    <div class="container">
        <div class="dashboard-container">
            <!-- Sidebar Navigation -->

            {% include 'includes/user_sidebar.php' %}

            {% include 'includes/alerts.html' %}

            <!-- Main Content Area -->
            <div class="main-content">

                <!-- Edit Profile Section -->
                <div id="profile" class="content-section">
                    <div class="card">
                        <h3>Edit Your Profile</h3>
                        <form method="POST" action="{% url 'edit_profile' %}" enctype="multipart/form-data">
                            {% csrf_token %}
                            <div class="group-input">
                                <div class="box">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" placeholder="John" value="{{ form.first_name.value }}">
                                </div>
                                <div class="box">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value="{{ form.last_name.value }}" placeholder="Last Name">
                                </div>
                            </div>

                            <div class="group-input">
                                <div class="box">
                                    <label>Phone No.</label>
                                    <input type="text" name="phone_number" placeholder="64813258984" value="{{ form.phone_number.value }}">
                                </div>
                                <div class="box">
                                    <label>Email I'd</label>
                                    <input type="text" name="email" value="{{ form.email.value }}" placeholder="info@gmail.com">
                                </div>
                            </div>

                            <div class="box">
                                <label>Address Line </label>
                                <input type="text" name="address_line" value="{{ form.address_line.value }}" placeholder="Address..">
                            </div>

                            <div class="group-input">
                                <div class="box">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ form.city.value }}" placeholder="city">
                                </div>
                                <div class="box">
                                    <label>State</label>
                                        <select name="state">
                                            {% for state in form.state.field.queryset %}
                                                <option value="{{ state.id }}" {% if state.id|stringformat:"s" == form.state.value|stringformat:"s" %}selected{% endif %}>
                                                    {{ state.name }}
                                                </option>
                                            {% endfor %}
                                        </select>
                                </div>
                                <div class="box">
                                    <label>Postal Code</label>
                                        <input type="text" name="postal_code" value="{{ form.postal_code.value }}" placeholder="123456">
                                </div>
                                <div class="box">
                                    <label>Country</label>
                                    <input type="text" name="country" value="{{ form.country.value }}" placeholder="country">
                                </div>
                            </div>

                            <div class="group-input">
                                <div class="box">
                                    <label>Fax Number</label>
                                    <input type="text" name="fax_number" value="{{ form.fax_number.value }}" placeholder="Fax number">
                                </div>
                                <div class="box">
                                    <label for="profile">Change Profile pic</label>
                                    <input type="file" name="profile_picture" id="profile">
                                </div>
                                <div class="box">
                                        {% if user.profile_picture %}
                                            <img src="{{ user.profile_picture.url }}" width="100" alt="Profile Picture">
                                        {% endif %}
                                </div>
                            </div>

                            <div class="box">
                                <input type="submit" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>



{% endblock %}