<x-mail::message>
# 💥 Free Rust Server Trial Expired
We regret to inform you that your free trial Rust server has expired. All associated data, including plugins, server files, and other package contents, has been deleted. We hope you enjoyed your time with us and look forward to seeing you again when you get your Rust server with us.

<code class="order">ORDERID# {{ $order->id }}</code>  


## Why choose our Rust servers?
- Optimal performance for smooth gameplay.
- Get started with minimal to no effort.
- Flexible plans that grow with your needs.
- Click below to order now and join the action!
- Enough resources to last a wipe (monthly server)

<a href="{{ route('package') }}" class="link" target="_blank">Get your server now</a>

If you have any questions or need assistance, feel free to reply to this email. We're always here to help! 

Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>