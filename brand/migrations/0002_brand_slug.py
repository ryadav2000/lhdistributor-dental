# Generated by Django 5.1.5 on 2025-01-28 18:12

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('brand', '0001_initial'),
    ]

    operations = [
        migrations.AddField(
            model_name='brand',
            name='slug',
            field=models.SlugField(default='default-slug', max_length=250, unique=True),
        ),
    ]
