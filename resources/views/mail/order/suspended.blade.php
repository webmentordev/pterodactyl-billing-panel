<x-mail::message>
# Server Suspension Notice
This email is to inform you that your server has been suspended but not deleted. You have a 3-day grace period to renew your server. If the renewal is not completed within this timeframe, the server and all its associated data—including configurations, databases, and files stored via FTP—will be permanently deleted.


<code class="order">ORDERID# {{ $order->id }}</code>

To renew or unsuspend your server, 
- Go to the [Dashboard]({{ route('dashboard') }}). 
- Find your Order ID mentioned above. 
- Click **Renew** to be redirected to the checkout page.
- Complete the order, and your server will be renewed and reactivated.

We recommend taking prompt action to avoid data loss. If you have any further questions or require assistance, feel free to reach out.  
Thank you for your attention.  

Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>
