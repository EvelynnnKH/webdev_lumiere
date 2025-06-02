<style>
    .footer-with-border {
        border-top: 1px solid #d3d3d3;
        background-color: #f8f4ee;
    }

    footer h6 {
        font-weight: bold;
        color: #5c3c1d;
    }

    footer .list-unstyled a {
        text-decoration: none;
        color: #5c3c1d;
    }

    footer .list-unstyled a:hover {
        color: #3f2c14;
    }

    footer p, footer li {
        color: #5c3c1d;
    }

    .social-icons a {
        text-decoration: none;
        font-size: 20px;
        color: #979797;
        margin: 0 10px 0 0;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        color: #5c3c1d;
    }

    .social-icons {
        margin-top: 20px;
        text-align: left;
    }

    .footer-bottom {
        text-align: right;
        padding: 10px 0 20px;
        font-family: 'Playfair Display', serif;
        color: #5c3c1d;
    }

    @media (max-width: 550px) {
        .tulisan-footer {
            margin-left: 40px;
        }

        .footer-bottom {
            text-align: center;
        }
    }
</style>

<footer class="footer-with-border pt-5">
    <div class="container" style="font-family: 'Montserrat', sans-serif;">
        <div class="row text-start tulisan-footer">
            <div class="col-md-4 mb-4">
                <h6 style="margin-bottom: 20px;">HELP</h6>
                <ul class="list-unstyled">
                    <li style="margin-bottom: 15px;"><a href="{{ route('contactus') }}">Contact Us</a></li>
                    <li style="margin-bottom: 15px;"><a href="{{ route('faq') }}">FAQ</a></li>
                    <li><a href="#">Shipping</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h6 style="margin-bottom: 20px;">LEGAL</h6>
                <ul class="list-unstyled">
                    <li style="margin-bottom: 15px;"><a href="{{ route('termsofservice') }}">Terms & Conditions</a></li>
                    <li style="margin-bottom: 15px;"><a href="#">Safety Certification</a></li>
                    <li><a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h6 style="margin-bottom: 10px;">LUMIÈRE CANDLE SHOP</h6>
                <p class="mb-1">Citraland Surabaya</p>
                <p class="mb-1">East Java, 60219</p>
                <p>+621234567890</p>
            </div>
        </div>

        <!-- Social icons row -->
        <div class="row">
            <div class="col-md-12 social-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.pinterest.com" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                <a href="https://www.tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row">
            <div class="col-12 footer-bottom" style="font-family: 'Montserrat', sans-serif;">
                © 2025 - Lumière Candle Shop
            </div>
        </div>
    </div>
</footer>
