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
                        <h2>Reset Password</h2>
                        <span> <a href="./">Home</a> - Reset Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Reset Password -->
<section class="section-login padding-tb-100">
    <div class="container">
        <div class="row d-none">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Reset Password</h2>
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
                <div class="cr-login" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="form-logo">
                        <img src="{% static 'img/logo/logo.png' %}" alt="logo">
                    </div>
                        {% include 'includes/alerts.html' %}
                    <form method="POST" action="{% url 'reset_password' %}" class="cr-content-form">
                        {% csrf_token %}
                        <div class="form-group">
                            <label>Password*</label>
                            <input type="password" name="password" placeholder="Enter Your Password" class="cr-form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password*</label>
                            <input type="password" name="confirm_password" placeholder="Enter Your Confirm Password" class="cr-form-control">
                        </div>
                        <br>
                        <div class="login-buttons">
                            <button type="submit" class="cr-button">Reset Password</button>
                            <a href="{% url 'login' %}" class="link">
                                Login?
                            </a>
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