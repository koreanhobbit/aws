@component('mail::message')
# Hello {{ ucfirst($cm->name) }}!!


Thanks for reaching up {{ config('app.name') }}, we will reply you as soon as possible.


Regards,<br>
{{ config('app.name') }}
@endcomponent
