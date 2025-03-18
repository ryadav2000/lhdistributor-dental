from django.db import models
from django.contrib.auth.models import AbstractBaseUser, BaseUserManager


class MyAccountManager(BaseUserManager):
    def create_user(self, company_name, first_name, last_name, username, email, address_line, city, state, postal_code, country, password=None, phone_number=None, fax_number=None):
        if not email:
            raise ValueError('User must have an email address')
        if not username:
            raise ValueError('User must have a username')

        user = self.model(
            company_name=company_name,
            first_name=first_name,
            last_name=last_name,
            username=username,
            email=self.normalize_email(email),
            address_line=address_line,
            city=city,
            state=state,
            postal_code=postal_code,
            country=country,
            phone_number=phone_number,
            fax_number=fax_number,
        )
        user.set_password(password)
        user.is_active = False  # Ensure user is inactive upon creation
        user.save(using=self._db)
        return user

    def create_superuser(self, company_name, first_name, last_name, username, email, password, address_line, city, state, postal_code, country):
        user = self.create_user(
            company_name=company_name,
            first_name=first_name,
            last_name=last_name,
            
            username=username,
            email=email,
            password=password,
            address_line=address_line,
            city=city,
            state=state,
            postal_code=postal_code,
            country=country,
            phone_number=None,  # Remove fixed number
            fax_number=None,
        )
        user.is_admin = True
        user.is_staff = True
        user.is_superadmin = True
        user.save(using=self._db)
        return user


class Account(AbstractBaseUser):
    # Company Details
    company_name = models.CharField(max_length=100)
    address_line = models.CharField(max_length=255)
    city = models.CharField(max_length=100)
    state = models.CharField(max_length=100)
    postal_code = models.CharField(max_length=6)
    country = models.CharField(max_length=100)

    # Personal Details
    first_name = models.CharField(max_length=50)
    last_name = models.CharField(max_length=50)

    # Contact Details
    phone_number = models.CharField(max_length=20, unique=False, blank=True, null=True)  # Removed uniqueness
    fax_number = models.CharField(max_length=20, blank=True, null=True)

    # Login Details
    username = models.CharField(max_length=50, unique=True)
    email = models.EmailField(max_length=100, unique=True)

    # Required Fields
    date_joined = models.DateTimeField(auto_now_add=True)
    last_login = models.DateTimeField(auto_now=True)  # Use auto_now=True to track last login properly
    is_admin = models.BooleanField(default=False)
    is_staff = models.BooleanField(default=False)
    is_active = models.BooleanField(default=True)  # Make new users active by default
    is_superadmin = models.BooleanField(default=False)

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = ['username', 'first_name', 'last_name', 'company_name', 'address_line', 'city', 'state', 'postal_code', 'country']

    objects = MyAccountManager()

    def __str__(self):
        return self.email

    def has_perm(self, perm, obj=None):
        return self.is_admin

    def has_module_perms(self, app_label):
        return True
