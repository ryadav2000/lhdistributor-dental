# Generated by Django 5.1.5 on 2025-01-31 16:12

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('brand', '0003_alter_brand_slug'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='brand',
            name='description',
        ),
    ]
