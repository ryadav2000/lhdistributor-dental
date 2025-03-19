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
                        <h2>Verify Otp</h2>
                        <span> <a href="./">Home</a> - Verify Otp</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Login -->
<section class="section-login padding-tb-100">
    <div class="container">
        <div class="row d-none">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Verify Otp</h2>
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
                    <form method="POST" action="{% url 'verify_otp' %}" class="cr-content-form">
                        {% csrf_token %}
                        <div class="form-group">
                            <input type="text" name="otp" placeholder="Enter OTP" class="cr-form-control" required>
                        </div>
                        <br>
                        <div class="login-buttons">
                            <button type="submit" class="cr-button">Verify OTP</button>
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