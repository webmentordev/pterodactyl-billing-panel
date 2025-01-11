<x-mail::message>
# Order confirmation
We’re thrilled to see you take the next step in your gaming journey! With your new Rust game hosting, you're all set for an incredible multiplayer experience.  

Your server is being installed, which may take 2-3 minutes. Once the installation is complete, use the game panel information provided below to visit the panel and log in (if you have not already signed up). You will need to start the server after the installation is finished.

<code class="order">ORDERID# {{ $order->id }}</code>
@if ($password)
<x-mail::table>
| Header       | Action         |
| :------------- | -----------: |
| Game Panel      | [Access here]({{ config('app.ptero_url') }})      |
| Email      | {{ $order->user->email }} |
| Password      | {{ $password }} |
</x-mail::table>    
@endif


We’re here to support you along the way, so if you need any assistance or have questions, feel free to reach out. Here’s to many exciting adventures in Rust!

Happy gaming and welcome to the community!  
Best regards,  
  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>
