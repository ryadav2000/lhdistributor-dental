from django.shortcuts import render, redirect
from django.contrib.auth.decorators import login_required
from .forms import RegistrationForm, Account
from django.contrib import messages, auth
from django.contrib.auth import authenticate, login as auth_login

#Verification email
from django.contrib.sites.shortcuts import get_current_site
from django.template.loader import render_to_string
from django.utils.http import urlsafe_base64_encode, urlsafe_base64_decode
from django.utils.encoding import force_bytes
from django.contrib.auth.tokens import default_token_generator
from django.core.mail import EmailMessage

# Activate view
from django.utils.encoding import force_str



# Create your views here.
def register(request):
    if request.method == 'POST':
        # Convert request.POST to mutable before modifying
        post_data = request.POST.copy()
        
        # Generate username from email
        email = post_data.get('email', '')
        if email:
            post_data['username'] = email.split("@")[0]  # Set username

        form = RegistrationForm(post_data)  # Pass updated data to form

        if form.is_valid():

            user = Account.objects.create_user(
                company_name=form.cleaned_data['company_name'],
                first_name=form.cleaned_data['first_name'],
                last_name=form.cleaned_data['last_name'],
                username=form.cleaned_data['username'],  # Now username is present!
                email=form.cleaned_data['email'],
                address_line=form.cleaned_data['address_line'],
                city=form.cleaned_data['city'],
                state=form.cleaned_data['state'],
                postal_code=form.cleaned_data['postal_code'],
                country=form.cleaned_data['country'],
                password=form.cleaned_data['password'],
                phone_number=form.cleaned_data.get('phone_number', ""),
                fax_number=form.cleaned_data.get('fax_number', "")
            )

            # Generete activation token
            user.is_active = False # Deactivate user until email confirmation
            user.save()


            # ***Send Activation Email***
            current_site = get_current_site(request)
            mail_subject = 'Activate Your Account'
            message = render_to_string('accounts/account_verification_email.html', {
                'user': user,
                'domain': current_site.domain,
                'uid': urlsafe_base64_encode(force_bytes(user.pk)),  # Securely encode user ID
                'token': default_token_generator.make_token(user),  # Generate activation token
            })

            from_email = 'Lh Distribution. <no-reply@lhdistributors.com>'
            to_email = user.email
            send_email = EmailMessage(mail_subject, message, from_email, to=[to_email])
            send_email.content_subtype = "html"
            send_email.send()  

            messages.success(request, "Your account has been created! Check your email to activate it.")
            return redirect('/accounts/login/?commond=verification&email='+email)

        else:
            for field, errors in form.errors.items():
                if field == '__all__':  # Handle non-field errors separately
                    for error in errors:
                        messages.error(request, f"{error}")  # Show error without a field name
                else:
                    for error in errors:
                        messages.error(request, f"{field.capitalize()}: {error}")
                        

        return render(request, 'accounts/register.php', {'form': form})
    else:
        form = RegistrationForm()

    context = {
        'form': form
    }
    return render(request, 'accounts/register.php', context)


def login_view(request):  # Changed function name to login_view
    if request.method == 'POST':
        email = request.POST.get("email")
        password = request.POST.get("password")

        user = authenticate(request, username=email, password=password)

        if user is not None:
            auth_login(request, user)  # Use Django's login function
            messages.success(request, "Login successful!")
            return redirect("home")  
        else:
            messages.error(request, "Invalid login credentials")
            return redirect("login")

    return render(request, 'accounts/login.php')

@login_required(login_url='login')
def logout(request):
    auth.logout(request)
    messages.success(request, "You are logged out.")
    return redirect("home")

def activate(request, uidb64, token):
    try:
        uid = force_str(urlsafe_base64_decode(uidb64)) # Decode User Id
        user = Account._default_manager.get(pk=uid)
    except (TypeError, ValueError, OverflowError, Account.DoesNotExist):
        user = None

    if user is not None and default_token_generator.check_token(user, token):
        user.is_active = True # Activate User
        user.save()
        messages.success(request, "Your account has been activated successfully! You can now log in.")
        return redirect('login')
    
    else:
        messages.error(request, "Invalid or expired activation link!")
        return redirect('register')
    

@login_required(login_url='login')
def dashboard(request):
    return render(request, 'accounts/dashboard.php')
    

