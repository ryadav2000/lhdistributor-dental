{% extends 'base.php' %}

{% load static %}

{% block content %}

<div class="card-form">
<h3 class="text-center" style="border-bottom: 1px solid #ccc;">Enter Credit Card Details</h3>
<form method="post" action="{% url 'credit_card_payment' %}" class="card-details-form">

    {% csrf_token %}
    <label>Card Number:</label>
    <input type="text" name="card_number" required placeholder="XXXX-XXXX-XXXX-XXXX"><br>
    
    <label>CVV:</label>
    <input type="text" name="cvv" required placeholder="XXX"><br>
    <label>Expiry (YYYY-MM):</label>
    <input type="text" name="expiry" placeholder="YYYY-MM" required><br>
    <button type="submit">Pay Now</button>

</form>

</div>
{% endblock %}


</body>

</html>