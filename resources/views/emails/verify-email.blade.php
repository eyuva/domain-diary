@component('mail::message')
# Verify your account

Thanks for registering. Confirm your email address to continue using our services.

@component('mail::button', ['url' => $url])
    Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
