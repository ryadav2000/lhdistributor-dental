{% load static %}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>L&H Distributors LLC - Dental Supply and Equipment in Washington, IL</title>
    <meta name="description" content="">
    <meta name="keywords" content="">



    <?php $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
    <meta name="author" content="<?php echo isset($url) ? $url : '' ?>" />
    <meta name="robots" content="index, follow" />
    <meta name="rating" content="safe for kids" />
    <meta name="googlebot" content=" index, follow" />
    <meta name="allow-search" content="yes" />
    <meta name="revisit-after" content="daily" />
    <meta name="language" content="en-US" />
    <meta name="distribution" content="global" />
    <link rel="canonical" href="<?php echo isset($url) ? $url : '' ?>" />


    <!-- App favicon -->
    <link rel="shortcut icon" href="{% static 'img/logo/favicon.png' %}">

    <!-- Icon CSS -->
    <link rel="stylesheet" href="{% static 'css/vendor/materialdesignicons.min.css' %}">
    <link rel="stylesheet" href="{% static 'css/vendor/remixicon.css' %}">

    <!-- Vendor -->
    <link rel="stylesheet" href="{% static 'css/vendor/animate.css'  %}">
    <link rel="stylesheet" href="{% static 'css/vendor/bootstrap.min.css' %}">
    <link rel="stylesheet" href="{% static 'css/vendor/aos.min.css' %}">
    <link rel="stylesheet" href="{% static 'css/vendor/range-slider.css' %}">
    <link rel="stylesheet" href="{% static 'css/vendor/swiper-bundle.min.css' %}">
    <link rel="stylesheet" href="{% static 'css/vendor/jquery.slick.css' %}">
    <link rel="stylesheet" href="{% static 'css/vendor/slick-theme.css' %}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{% static 'css/style.css' %}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body class="body-bg-6">


    <!-- Header -->
    {% include 'includes/header.php' %}

    {% block content %}
    <!-- Load the content -->
    {% endblock %}


    <!-- Footer -->
    {% include 'includes/footer.php' %}


    </body>

</html>