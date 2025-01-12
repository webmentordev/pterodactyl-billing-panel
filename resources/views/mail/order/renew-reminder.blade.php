<x-mail::message>
# Order Renewal Reminder
We hope this message finds you well. This is a friendly reminder regarding your current order with us. Your Rust server is set to expire in 2 days unless renewed.  

If the order is not renewed on time:

- **Server Suspension:** Initially, your Rust server will be suspended, not deleted. During the suspension, you will not have access to the server.
- **Grace Period:** A 2-day grace period will be provided after the suspension.
- **Permanent Deletion:** If the order is not renewed within the grace period (2 days after the expiration date), the server and all associated data—including configurations, plugins, backups, and other items in the package—will be permanently deleted.  

To renew your order, [Go to the Dashboard]({{ route('dashboard') }})

To avoid any disruption, we recommend renewing your order promptly to retain your Rust server and all associated features.

If you have any questions or need assistance, feel free to contact our support team.
  
Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>