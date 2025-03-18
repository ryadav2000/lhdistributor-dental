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
                        <h2>Register</h2>
                        <span> <a href="./">Home</a> - Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Register -->
<section class="section-register padding-tb-100">
    <div class="container">
        <div class="row d-none">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Register</h2>
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
                <div class="cr-register" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="form-logo">
                        <img src="{% static 'img/logo/logo.png' %}" alt="logo">
                    </div>
                        {% include 'includes/alerts.html' %}

                    <form method="POST" action="{% url 'register' %}" class="cr-content-form">
                        {% csrf_token %}
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>First Name*</label>
                                        {{ form.first_name }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Last Name*</label>
                                        {{ form.last_name }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Company Name*</label>
                                        {{ form.company_name }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number*</label>
                                        {{ form.phone_number }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Address*</label>
                                    {{ form.address_line }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>City*</label>
                                    {{ form.city }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Post Code</label>
                                        {{ form.postal_code }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Region State*</label>
                                    {{ form.state }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Country*</label>
                                    {{ form.country }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Fax Number*</label>
                                        {{ form.fax_number }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email*</label>
                                        {{ form.email }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Create Password*</label>
                                        {{ form.password }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Re-Password*</label>
                                        {{ form.confirm_password }}
                                </div>
                            </div>
                            <div class="cr-register-buttons">
                                <button type="submit" class="cr-button">Signup</button>
                                <a href="{% url  'login' %}" class="link">
                                    Have an account?
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>




{% endblock %}

</body>

</html>