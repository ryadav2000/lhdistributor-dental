from django import forms
from .models import Account

class RegistrationForm(forms.ModelForm):
    password = forms.CharField(widget=forms.PasswordInput(attrs={
        'class': 'cr-form-control',
        'placeholder': 'Enter Password'
    }))
    confirm_password = forms.CharField(widget=forms.PasswordInput(attrs={
        'class': 'cr-form-control',
        'placeholder': 'Confirm Password'
    }))

    class Meta:
        model = Account
        fields = [
            'company_name', 'first_name', 'last_name', 'username', 'email', 'address_line', 'city', 'state', 'postal_code', 'country', 'phone_number', 'fax_number'
        ]

    def __init__(self, *args, **kwargs):
        super(RegistrationForm, self).__init__(*args, **kwargs)

        self.fields['first_name'].widget.attrs['placeholder'] = 'Enter Your First Name'
        self.fields['last_name'].widget.attrs['placeholder'] = 'Enter Your Last Name'
        self.fields['company_name'].widget.attrs['placeholder'] = 'Enter Your Company Name'
        self.fields['phone_number'].widget.attrs['placeholder'] = 'Enter Your Phone Number'
        self.fields['address_line'].widget.attrs['placeholder'] = 'Enter Your Address'
        self.fields['city'].widget.attrs['placeholder'] = 'Enter Your City Name'
        self.fields['state'].widget.attrs['placeholder'] = 'Enter Your State Name'
        self.fields['country'].widget.attrs['placeholder'] = 'Enter Your Country Name'
        self.fields['email'].widget.attrs['placeholder'] = 'Enter Your Email'
        self.fields['fax_number'].widget.attrs['placeholder'] = 'Enter Your Fax Number'
        self.fields['postal_code'].widget.attrs['placeholder'] = 'Enter Your Postal Code'

        for field in self.fields:
            self.fields[field].widget.attrs['class'] = 'cr-form-control'

    def clean_email(self):
        """Ensure the email is unique. """
        email = self.cleaned_data.get('email')
        if Account.objects.filter(email=email).exists():
            raise forms.ValidationError("This email is already in use.")
        return email
    
    def clean_phone_number(self):
        """Ensure phone number is unique"""
        phone_number = self.cleaned_data.get('phone_number')
        if Account.objects.filter(phone_number=phone_number).exists():
            raise forms.ValidationError("This number is already in use.")
        return phone_number
    
    def clean(self):
        """Ensure password and confirm_password match."""
        cleaned_data = super().clean()
        password = cleaned_data.get("password")
        confirm_password = cleaned_data.get("confirm_password")


        if password and confirm_password and password != confirm_password:
            raise forms.ValidationError("Password do not match!")
        
        return cleaned_data
    
    def save(self, commit=True):
        """Hash password before saving user."""
        user = super().save(commit=False)
        user.set_password(self.cleaned_data['password'])
        if commit:
            user.save()
        return user
        

