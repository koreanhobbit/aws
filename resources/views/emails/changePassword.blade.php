@component('mail::message')
# Hello {{ ucfirst($tp->name) }}

You recently change your password, here are you new credentials:

1. Username : {{ $tp->email }}
2. Password : {{ $new_pass }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
