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
                        <h2>Shop by Brand</h2>
                        <span> <a href="./">Home</a> - Shop by Brand</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopbrand py-5">
    <div class="container">
        {% for letter, brands in grouped_brands.items %}
        <h3 class="brand-letter">{{ letter }}</h3> <!-- Alphabet Header -->
        <div class="row">
            {% for brand in brands %}
            <div class="col-md-3 col-sm-6 text-center mb-4">
                <a href=""> <!-- Dynamic brand link -->
                    <div class="card border-0">
                        {% if brand.brand_img %}
                        <a href="{% url 'brand_product' brand.slug %}">
                            <img src="{{ brand.brand_img.url }}" alt="{{ brand.brand_name }}">
                        </a>
                        {% else %}
                        <a href="{% url 'brand_product' brand.slug %}">
                            <img src="/static/default-brand.png" alt="Default Brand Image">
                        </a>
                        {% endif %}
                        <div class="card-body">
                            <a href="{% url 'brand_product' brand.slug %}">
                                <h5 class="card-title">{{ brand.brand_name }}</h5>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
            {% endfor %}
        </div>
        {% endfor %}

        {% if not grouped_brands %}
        <p class="text-center">No brands available.</p>
        {% endif %}
    </div>
</section>





{% endblock %}


</body>

</html>