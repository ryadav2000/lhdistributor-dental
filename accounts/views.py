from django.shortcuts import render, redirect
from django.contrib.auth.decorators import login_required
from .forms import RegistrationForm
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

# OTP Functionality
import random
from .models import Account, PasswordResetOTP
from django.utils.timezone import now
from datetime import timedelta

# Testing
from django.http import HttpResponse


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
            return redirect("dashboard")  
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




# OTP
def request_opt(request):
    if request.method == 'POST':
        email = request.POST.get("email")
        try:
            user = Account.objects.get(email=email)
            otp = str(random.randint(100000, 999999 )) # Generate 6-digit otp

            # Save otp in database
            PasswordResetOTP.objects.create(user=user, otp=otp)

            # Send OTP via Email using EmailMessage
            current_site = get_current_site(request)
            mail_subject = "Your Passwod  Reset Otp"
            message = render_to_string('accounts/password_reset_otp_email.html', {
                'user': user,
                "domain": current_site.domain,
                "otp": otp
            })
            from_email = "Lh Distribution <no-reply@lhdistributors.com>"
            to_email = user.email
            email_message = EmailMessage(mail_subject, message, from_email, to=[to_email])
            email_message.content_subtype = "html"
            email_message.send()

            request.session["reset_email"] = email  # Store email in session
            messages.success(request, "An OTP has been sent to your email.")
            return redirect("verify_otp")
        
        except Account.DoesNotExist:
            messages.error(request, "No acount found with this email.")
            return redirect('request_otp')
    else:
        return render(request, 'accounts/request_otp.php')


def verify_otp(request):
    if request.method == "POST":
        email = request.session.get("reset_email")
        otp_entered = request.POST.get("otp")

        if not email:
            messages.error(request, "Session expired! Please request a new OTP.")
            return redirect('request_otp')
        
        if not otp_entered:
            messages.error(request, "Please enter the OTP.")
            return redirect('verify_otp')

        # Fetch OTP attempts from session
        attempts = request.session.get("otp_attempts", 0)
        first_attempt_time = request.session.get("otp_attempt_time")

        # Reset OTP attempts after 10 minutes
        if first_attempt_time:
            try:
                first_attempt_time = now() - timedelta(minutes=10)
                if now() >= first_attempt_time:
                    request.session["otp_attempts"] = 0  # Reset attempt counter
                    request.session["otp_attempt_time"] = None  # Clear timestamp
                    request.session.modified = True  # Force session update
            except Exception:
                pass  # Avoid crashes if there's an issue with time parsing

        # Block user if 5 failed attempts within 10 minutes
        if attempts >= 5:
            messages.error(request, "Too many failed attempts. Please try again after 10 minutes.")
            return redirect('request_otp')

        try:
            user = Account.objects.get(email=email)
            otp_record = PasswordResetOTP.objects.filter(user=user).latest('created_at')

            if otp_record.otp == otp_entered and otp_record.is_valid():
                otp_record.mark_used()  # Mark OTP as used
                request.session["verified_email"] = email  # Store verified email
                
                # Reset attempts on success
                request.session.pop("otp_attempts", None)  # Remove the key
                request.session.pop("otp_attempt_time", None)  # Remove timestamp
                request.session.modified = True  # Ensure session update

                messages.success(request, "OTP verified successfully! Please reset your password.")
                return redirect("reset_password")

            # If OTP is incorrect, increase the attempt count
            request.session["otp_attempts"] = attempts + 1
            request.session.modified = True  # Ensure session update

            # Store the timestamp of the first failed attempt
            if not first_attempt_time:
                request.session["otp_attempt_time"] = now().isoformat()  # Save as string for session
                request.session.modified = True  # Ensure session update

            messages.error(request, "Invalid or expired OTP. Please try again.")
            return redirect("verify_otp")

        except (Account.DoesNotExist, PasswordResetOTP.DoesNotExist):
            messages.error(request, "Invalid request. Try again.")
            return redirect("request_otp")
    
    return render(request, "accounts/verify_otp.php")


def reset_password(request):
    if request.method == 'POST':
        email = request.session.get('verified_email')
        password = request.POST.get("password")
        confirm_password  = request.POST.get("confirm_password")

        if not email:
            messages.error(request, "Session expired! Please request a new OTP.")
            return redirect('request_otp')
        
        if not password or not confirm_password:
            messages.error(request, "Both password fields are required.")
            return redirect('reset_password')
        
        if password != confirm_password:
            messages.error(request, "Passwords do not match. Please try again.")
            return redirect('reset_password')
        
        try:
            user = Account.objects.get(email=email)
            user.set_password(password)
            user.save()

            # Clear session variables
            request.session.pop('verified_email', None)
            request.session.pop('reset_email', None)

            messages.success(request, "Password reset successful! You can now log in.")
            return redirect('login')

        except Account.DoesNotExist:
            messages.error(request, "User does not exist. Try again.")
            return redirect('request_otp')



    else:
        return render(request, 'accounts/reset_password.php')
    

