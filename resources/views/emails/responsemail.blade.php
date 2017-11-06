@component('mail::message')
# Hello

Thanks for contacting us Top Web Studio.

{{ ucfirst($response->response) }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
