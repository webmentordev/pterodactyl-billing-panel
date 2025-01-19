<x-mail::message>
# ✔ Rust Trial Server Approved
We’re excited to see you take the next step in your gaming journey! With your new Trial Rust game hosting, you’re all set to enjoy an incredible multiplayer experience for 24 Hours.  

Your server is being installed, which usually takes 2-3 minutes. Once complete, use the game panel information below to log in or sign up if you haven’t already. After logging in for the first time, please verify your email and remember to start the server.

<code class="order">ORDERID# {{ $order->id }}</code>
@if ($password)
<x-mail::table>
| Header       | Action         |
| :------------- | -----------: |
@if ($isNew)
| Billing Panel      | [Access here]({{ route('dashboard') }})      |
| Email      | {{ $order->user->email }} |
| Password      | {{ $newPassword }} |
@endif
| Game Panel      | [Access here]({{ config('app.ptero_url') }})      |
| Email      | {{ $order->user->email }} |
| Password      | {{ $password }} |
</x-mail::table>    
@endif


We’re here to support you along the way, so if you need any assistance or have questions, feel free to reach out. Here’s to many exciting adventures in Rust!

Thank you for choosing us, and happy gaming!  

Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>
