<footer class="site-footer border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4">Navigations</h3>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <ul class="list-unstyled">
                            <li ><a href="{{ route('home') }}">Anasayfa</a></li>
                            <li ><a href="{{ route('about') }}">Hakkımızda</a></li>
                            <li><a href="{{ route('product') }}">ürünler</a></li>
                            <li><a href="{{ route('contact') }}">iletisim</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">İletişim</h3> <!-- şimdilik burdan elle yazıyorum sonra panelden verileri çekeceğim  -->
                    <ul class="list-unstyled">
                        <li class="address">Adres bilgilerimiz burada olacak </li>
                        <li class="phone"><a href="tel://23923929210">+90 551 555 55 55</a></li>
                        <li class="email">emailaddress@domain.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright  &copy; {{ date('Y') }} Tüm haklarımız saklıdır
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>

        </div>
    </div>
</footer>
