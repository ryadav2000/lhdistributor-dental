# Generated by Django 5.1.5 on 2025-02-17 16:35

import django.db.models.deletion
from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        ('product', '0001_initial'),
    ]

    operations = [
        migrations.CreateModel(
            name='ProductItem',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('item_description', models.TextField(blank=True, null=True)),
                ('item_price', models.DecimalField(blank=True, decimal_places=2, max_digits=10, null=True)),
                ('manufacturer_code', models.CharField(blank=True, max_length=300, null=True)),
                ('item_pack', models.CharField(blank=True, max_length=255, null=True)),
                ('activatedstatus', models.BooleanField(default=True)),
                ('product', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='items', to='product.product')),
            ],
        ),
    ]
