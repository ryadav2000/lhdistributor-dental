{% extends 'base.php' %}

{% load static %}

{% block content %}

<section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>About Us</h2>
                            <span> <a href="index.html">Home</a> - About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-about padding-tb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cr-about aos-init aos-animate" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <h4 class="heading">About Us</h4>
                        <div class="cr-about-content">
                            <p>L & H Distributors is a family owned operated business based out of Chatham, IL. We are the fastest growing dental supply company due to our unbeatable pricing, service, and quick turn around time.</p>
                            <p>We strive to bring you the best access to the products you need for the absolute lowest prices . You can be assured that all of our products are genuine in nature allowing you to save money while serving your patients with the utmost confidence.</p>
                            <p>Please let us know if you would like pricing on a product that is not shown on the website as we continue to add to our inventory every day.</p>
                            <div class="elementor-counter">
                                <div class="row">
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">1.2</span>
                                            <span class="elementor-suffix">k</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Vendors</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">410</span>
                                            <span class="elementor-suffix">k</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Customers</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">34</span>
                                            <span class="elementor-suffix">k</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Products</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cr-about-image aos-init aos-animate" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                        <img src="{% static 'img/aboutus/about-us.jpg' %}" alt="side-view">
                    </div>
                </div>
            </div>
        </div>
    </section>


{% endblock %}