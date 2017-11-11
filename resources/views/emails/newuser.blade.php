@component('mail::message')
# Congratulation {{ ucfirst($profile->name) }}

Here are your account credentials:

1. Username : {{ $profile->email }}
2. Password : {{ $pass }}

Please login, fill your profile attributes and change password!

@component('mail::button', ['url' => $url])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
