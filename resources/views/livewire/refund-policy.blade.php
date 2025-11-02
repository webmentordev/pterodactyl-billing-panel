<div class="flex items-center justify-center py-12 mt-12" id="packages" x-data="{ show: false }">
    <div class="max-w-5xl w-full p-3 text-white">
        <div class="w-full flex items-center justify-center">
            <h1 class="mb-4 m-auto text-center">
                <strong title="RustDedicated Hosting Refund Policy" class="text-5xl text-center"
                    title="Global Rust Server Hosting Locations">RustDedicated Hosting
                    <br><span class="text-rust">Refund Policy</span></strong>
            </h1>
        </div>
        <div class="w-full flex items-center justify-center">
            <time datetime="2025-10-26T00:00:00Z" itemprop="dateCreated">Last updated: 26 October, 2025</time>
        </div>
        <div class="mt-4 p-8 rounded-lg bg-dark-100 border border-white/10 policy 510px:p-3">
            <h3>1. Overview</h3>
            <p>At RustDedicated Hosting, we strive to provide the best hosting services for your Rust game servers.
                However, we understand that there may be instances where you require a refund. This Refund Policy
                outlines the conditions and procedures for requesting a refund.</p>

            <p class="p-4 rounded-r-lg bg-rust/10 border-l-4 mt-3 border-rust">All first-time orders are eligible
                for a
                full refund. To protect against refund
                spams,
                partial refunds
                of {{ config('app.refund_percentage') }}% will be issued. Full refunds are issued in certain cases
                that
                we have mentioned here.</p>

            <h3>2. Refund Eligibility</h3>
            <p>You may be eligible for a refund if:</p>
            <ul>
                <li>You request a refund within 48 hours of your first purchase or server renewal.</li>
                <li>Full refunds are provided at any time if you encounter an issue on our side, such as, but not
                    limited to, NVMe failure causing data loss, etc.</li>
                <li>Full refund for all first-time orders.</li>
                <li>The Service experiences significant downtime due to issues caused by RustDedicated Hosting.</li>
                <li>A billing error occurred, such as duplicate charges.</li>
                <li>Refund requests outside these conditions will be reviewed on a case-by-case basis at the
                    discretion
                    of RustDedicated Hosting.</li>
            </ul>

            <h3>3. Non-Refundable Cases</h3>
            <p>Refunds will not be issued for:</p>
            <ul>
                <li>Failure to adhere to the <a
                        href="https://support.facepunchstudios.com/hc/en-us/articles/360009062817-Guidelines-for-community-servers-using-plugins-mods"
                        target="_blank" rel="nofollow" class="underline text-rust">Facepunch Community Server
                    </a> Rules.</li>
                <li>Exceeding refund request period.</li>
                <li>Requesting a refund on behalf of another user.</li>
            </ul>


            <h3>4. How to Request a Refund</h3>
            <p>To request a refund, follow these steps:</p>
            <ul>
                <li>Click the 'Refund' button in the <a href="{{ route('dashboard') }}" class="text-rust underline"
                        target="_blank">Client Area</a> next to your order that is eligible for a refund.</li>
                <li>Contact us at <strong class="text-rust">support@rustdedicated.com</strong> or socials within the
                    eligible refund period.</li>
                <li>While it is not required, please provide a reason for the refund so we can understand the cause
                    and
                    improve our services.
                </li>
            </ul>

            <h3>5. Processing Refunds</h3>
            <ul>
                <li>Refund requests will be reviewed within 1-2 business days of submission.</li>
                <li>When approved, refunds will be issued to the original payment method within 7-10 business days.
                </li>
            </ul>
            <h3>6. Changes to this Refund Policy</h3>
            <p>RustDedicated Hosting reserves the right to update this Refund Policy at any time. Changes will be
                effective immediately upon posting on our Website. Continued use of the Service constitutes your
                acceptance of the revised Refund Policy.</p>

            <h3>7. Free Trial Server Refunds</h3>
            <p>Free trial Rust servers are free and do not require your credit card or payment for setup, so they are
                not eligible
                for refund requests.</p>

            <h3>8. Contact Information</h3>
            <p>For any questions or concerns regarding this Refund Policy, please contact us at <strong
                    class="text-rust">support@rustdedicated.com</strong>.</p>
        </div>
        <ul class="flex items-center mt-3">
            <li class="mr-5"><a href="{{ config('app.discord_link') }}" target="_blank"
                    title="RustDedicated Hosting Discord">
                    <img src="https://api.iconify.design/logos:discord-icon.svg" alt="RustDedicated Hosting Discord"
                        width="25px">
                </a></li>
            <li class="mr-5"><a href="{{ config('app.yourube_url') }}" target="_blank"
                    title="RustDedicated Hosting YouTube">
                    <img src="https://api.iconify.design/logos:youtube-icon.svg" alt="RustDedicated Hosting YouTube"
                        width="25px">
                </a></li>
            <li class="mr-5"><a href="{{ config('app.facebook_link') }}" target="_blank"
                    title="RustDedicated Hosting Facebook">
                    <img src="https://api.iconify.design/logos:facebook.svg" alt="RustDedicated Hosting Facebook"
                        width="24px">
                </a></li>
            <li class="mr-5"><a href="{{ config('app.twitter_link') }}" target="_blank"
                    title="RustDedicated Hosting Twitter">
                    <img src="https://api.iconify.design/logos:twitter.svg" alt="RustDedicated Hosting Twitter"
                        width="25px">
                </a></li>
            <li class="mr-3"><a href="mailto:support@rustdedicated.com" target="_blank"
                    title="RustDedicated Hosting Support Email">
                    <img src="https://api.iconify.design/twemoji:incoming-envelope.svg"
                        alt="RustDedicated Hosting Support Email" width="25px">
                </a></li>
        </ul>
    </div>
</div>
