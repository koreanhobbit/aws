@component('mail::message')
# Hello {{ ucfirst($rp->name) }}

Thanks for contacting us {{ config('app.name') }}.

{{ ucfirst($rp->response) }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
