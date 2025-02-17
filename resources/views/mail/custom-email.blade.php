<x-mail::message>
{!! $body !!}  

Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>