# Generated by Django 5.1.5 on 2025-01-28 14:50

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Brand',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('brand_name', models.CharField(blank=True, max_length=200, null=True)),
                ('activatedstatus', models.IntegerField(default=1)),
                ('brand_img', models.ImageField(blank=True, null=True, upload_to='brand_images/')),
                ('description', models.TextField(blank=True, null=True)),
            ],
        ),
    ]
