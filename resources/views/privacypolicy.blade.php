@extends('base')

<style>
    main {
        background-color: #f8f4ee;
    }
</style>

@section('title', 'Privacy Policy')
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
@section('content')
<div class="container mt-5 mb-5" style="font-family: 'Monserrat', sans-serif; color: #5c3c1d;">
    <a href={{ url()->previous() }} class="back-button" title="Back">
            ←
        </a>
    <h2 class="mb-4 text-center pb-2" style="font-weight: 300; color: #5c3c1d;">PRIVACY POLICY</h2>
    <p class="mb-3">Welcome to Lumiere. This Privacy Policy outlines how we collect, use, and protect your personal information when you visit or make a purchase from our website.</p>

    <h6 class="mt-4 fw-semibold">1. Personal Information We Collect</h6>
    <p>When you make a purchase or attempt to make a purchase through our website, we collect certain information from you, including your name, billing address, shipping address, payment information (including credit/debit card numbers or other payment method), phone number, and email address. This is referred to as <strong>"Personal Information".</strong></p>

    <h6 class="mt-4 fw-semibold">2. How We Use Your Information</h6>
    <p>We use the collected Personal Information to:</p>
    <ul>
        <li>Process your orders and payments</li>
        <li>Deliver your products and provide customer support</li>
        <li>Communicate with you regarding your purchase or inquiries</li>
        <li>Comply with legal obligations</li>
    </ul>
    <p>We do not use your personal information for marketing emails or newsletters.</p>

    <h6 class="mt-4 fw-semibold">3. Sharing Your Information</h6>
    <p>We do not sell or rent your personal information to third parties. However, we may share your data with trusted third-party service providers who help us operate our website, process payments, deliver products, or fulfill customer service. These parties are only given the necessary information to perform their specific functions and are required to keep your information confidential.</p>

    <h6 class="mt-4 fw-semibold">4. Data Storage and Security</h6>
    <p>Your data is stored securely and protected from unauthorized access, disclosure, alteration, or destruction. We take reasonable precautions and follow industry best practices to ensure your data is handled safely.</p>

    <h6 class="mt-4 fw-semibold">5. Third-Party Services</h6>
    <p>Our store uses third-party payment processors and delivery services. These third-party providers have their own privacy policies. We recommend you read their privacy policies to understand how your information will be handled by them.</p>

    <h6 class="mt-4 fw-semibold">6. Your Rights</h6>
    <p>If you are a customer residing in Indonesia, you have the right to access, correct, or delete your personal information. To do so, please contact us through the information provided.</p>

    <h6 class="mt-4 fw-semibold">7. Changes to This Policy</h6>
    <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for legal or operational reasons. Changes will be posted on this page.</p>

    <h6 class="mt-4 fw-semibold">8. Contact Us</h6>
    <p>If you have any questions about this Privacy Policy or how your information is handled, please contact us at:</p>
    <ul>
        <li>Email: <a href="mailto:customercare@lumiere.co.id" style="color: #5c3c1d;">customercare@lumiere.co.id</a></li>
        <li>Phone: <a href="https://wa.me/6212345678910" style="color: #5c3c1d;">+6212345678910</a></li>
        <li><p>Address: CitraLand, Surabaya, East Java, 60219, Indonesia</p></li>
    </ul>
</div>
@endsection
