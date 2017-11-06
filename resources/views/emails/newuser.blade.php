@component('mail::message')
# Congratulation {{ ucfirst($profile->name) }}

Here are your account credentials:

1. Username : {{ $profile->email }}
2. Password : {{ $pass }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
