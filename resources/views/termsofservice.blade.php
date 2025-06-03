@extends('base')

<style>
    main {
        background-color: #f8f4ee;
    }
</style>

@section('content')
<style>
.full-content{
    padding-top: 1rem;
}
.back-button {
    display:inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 2px solid #8B4513; /* warna coklat */
    border-radius: 50%;
    text-decoration: none;
    color: #8B4513;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.back-button:hover {
    background-color: #8B4513;
    color: white;
}
</style>
<div class="container mt-5 mb-5" style="font-family: 'Monserrat', sans-serif; color: #5c3c1d;">
    <a href={{ url()->previous() }} class="back-button" title="Back">
            ←
        </a>
    <h2 class="mb-4 text-center pb-2" style="font-weight: 300; color: #5c3c1d;">TERMS OF SERVICE</h2>
    <p class="mb-3" style="color: #948b81">Effective Date: May 2025</p>

    <p>Welcome to Lumiere. These Terms of Service govern your use of our website and services. By accessing or purchasing from our store, you agree to be bound by the following terms and conditions.</p>

    <h6 class="mt-4 fw-semibold">1. Overview</h6>
    <p>This website is operated by Lumiere, located in CitraLand, Surabaya, East Java, 60219, Indonesia. Throughout the site, the terms “we”, “us”, and “our” refer to Lumiere. By using our site and/or purchasing something from us, you agree to be bound by these Terms of Service, including any additional terms and policies referenced here or available by hyperlink.</p>

    <h6 class="mt-4 fw-semibold">2. Online Store Terms</h6>
    <p>By agreeing to these Terms of Service, you confirm that you are legally capable of entering into binding contracts. You may not use our products for any illegal or unauthorized purpose.
    <br>You must not transmit any worms, viruses, or any code of a destructive nature.
    <br>A breach or violation of any of the Terms will result in an immediate termination of your services.</p>

    <h6 class="mt-4 fw-semibold">3. General Conditions</h6>
    <p>We reserve the right to refuse service to anyone for any reason at any time. Your content (excluding payment information) may be transferred unencrypted and may involve transmissions over various networks.
    <br>You agree not to reproduce, duplicate, copy, sell, resell, or exploit any portion of the service without our written permission.</p>

    <h6 class="mt-4 fw-semibold">4. Accuracy of Information</h6>
    <p>We are not responsible if information made available on this site is not accurate, complete, or current. The material on this site is provided for general information only.
    <br>We reserve the right to modify the contents of this site at any time, but we have no obligation to update any information.</p>

    <h6 class="mt-4 fw-semibold">5. Modifications to the Service and Prices</h6>
    <p>Prices for our products are subject to change without notice. We reserve the right to modify or discontinue any product or service at any time without notice.</p>

    <h6 class="mt-4 fw-semibold">6. Products or Services</h6>
    <p>Certain products may have limited quantities and are subject to return or exchange only according to our Return Policy. Please note that we do not accept returns or refunds unless the product is damaged upon arrival.
    <br>We have made every effort to display our products as accurately as possible. We cannot guarantee that your device's display of colors will be accurate.
    <br>We reserve the right to limit the sales of our products to any person, geographic region, or jurisdiction within Indonesia.</p>

    <h6 class="mt-4 fw-semibold">7. Billing and Account Information</h6>
    <p>We reserve the right to refuse any order you place with us. You agree to provide current, complete, and accurate purchase and account information.
    <br>Payment methods accepted: Credit/debit cards, bank transfer, e-wallets, and QRIS.</p>

    <h6 class="mt-4 fw-semibold">8. Third-Party Links</h6>
    <p>Some content or services on our website may include materials from third parties. We are not responsible for examining or evaluating the content or accuracy of third-party websites.</p>

    <h6 class="mt-4 fw-semibold">9. User Comments and Feedback</h6>
    <p>Any feedback, suggestions, or submissions you send us may be used without restriction. We are under no obligation to maintain any comments in confidence or respond to them.</p>

    <h6 class="mt-4 fw-semibold">10. Personal Information</h6>
    <p>Your submission of personal information through the store is governed by our Privacy Policy.</p>

    <h6 class="mt-4 fw-semibold">11. Errors, Inaccuracies, and Omissions</h6>
    <p>Occasionally there may be information on our site that contains typographical errors or inaccuracies. We reserve the right to correct any errors or update information at any time without prior notice.</p>

    <h6 class="mt-4 fw-semibold">12. Prohibited Uses</h6>
    <p>You are prohibited from using the site or its content for any unlawful purpose or to interfere with the security features of the service or any related website.</p>

    <h6 class="mt-4 fw-semibold">13. Disclaimer of Warranties and Limitation of Liability</h6>
    <p>We do not guarantee that your use of our service will be uninterrupted, timely, or error-free. You agree that your use of, or inability to use, the service is at your sole risk.
    <br>In no case shall Lumiere be liable for any injury, loss, or claim arising from your use of the service or products.</p>

    <h6 class="mt-4 fw-semibold">14. Indemnification</h6>
    <p>You agree to indemnify and hold harmless Lumiere and our partners, affiliates, and employees, from any claim or demand due to your breach of these Terms or violation of any law.</p>

    <h6 class="mt-4 fw-semibold">15. Governing Law</h6>
    <p>These Terms of Service and any separate agreements shall be governed by and construed in accordance with the laws of Indonesia.</p>

    <h6 class="mt-4 fw-semibold">16. Changes to Terms of Service</h6>
    <p>We reserve the right to update or change any part of these Terms at our discretion. It is your responsibility to check this page periodically for changes.</p>

    <h6 class="mt-4 fw-semibold">17. Contact Information</h6>
    <p>For any questions regarding these Terms of Service, please email us at <a href="mailto:info@ciputra.ac.id" style="color: #5c3c1d; font-weight: bold;">customercare@lumiere.co.id</a>
        or call us at <a href="https://wa.me/6212345678910" style="color: #5c3c1d; font-weight: bold;">+6212345678910</a>.</p>
</div>
@endsection
