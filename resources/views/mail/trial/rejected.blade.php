<x-mail::message>
# ❌ Out Of Trial Servers!
We regret to inform you that we are currently out of free trial servers and, therefore, cannot approve your free server request. Please try again in 2 days.  

If you want to know when trail servers will be available, <a href="https://discord.gg/5XFteSutRK" class="link" target="_blank">join our Discord server</a> for updates.

## Why choose our Rust servers?
- Optimal performance for smooth gameplay.
- Get started with minimal to no effort.
- Flexible plans that grow with your needs.
- Click below to order now and join the action!
- Enough resources to last a wipe (monthly server)

<a href="{{ route('package') }}" class="link" target="_blank">Get your server now</a>

If you have any questions or need assistance, feel free to reply to this email or join our discord community. We're always here to help! 
 
See you on the battlefield!  

Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
<img src="{{ route('email.open', $trial->token) }}" width="1px" height="1px">
</x-mail::message>
