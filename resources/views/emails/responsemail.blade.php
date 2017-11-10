@component('mail::message')
# Hello {{ ucfirst($rp->name) }}

Thanks for contacting us Top Web Studio.

{{ ucfirst($rp->response) }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
