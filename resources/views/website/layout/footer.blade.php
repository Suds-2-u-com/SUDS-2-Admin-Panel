<!-- FOOTER SECTION START -->
<footer class="container-fluid px-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4">
                <img src="{{url('public/website/images/logo/logo-1.svg')}}"
                    class="img-fluid d-block logo_img mb-5 mb-lg-0">
            </div>
            <div class="col-lg-4 col-md-8">
                <ul class="contact_details list-unstyled mb-5 mb-lg-0">

                    <li class="mb-1 px-3">
                        <span>Email :</span>
                        <span>
                            <a href="mailto:support@SUDS-2-U.com">support@SUDS-2-U.com</a>
                        </span>
                    </li>
                    <li class="mb-1 px-3">
                        <span>Phone :</span>
                        <span>
                            <a href="tel:512-586-8786">512-586-8786</a>
                        </span>
                    </li>
                    <li class="mb-1 px-3">
                        <span>Address :</span>
                        <span>603 N Meadow Street, Odessa Texas 79761</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <ul class="other_pages list-unstyled mb-5 mb-lg-0">
                    <!--<li  class="mb-1">-->
                    <!--     <a class="nav-link px-3 {{ Request::is('Faq') ? 'active' : '' }}" href="{{url('Faq')}}">FAQ</a>-->
                    <!-- </li>-->
                    <li class="mb-1">
                        <a class="nav-link px-3 {{ Request::is('Blog') ? 'active' : '' }}"
                            href="{{url('Blog')}}">INFO</a>
                    </li>
                    <!--<li class="mb-1">-->
                    <!--    <a href="privacy-policy.html">Privacy Policy</a>-->
                    <!--</li>-->
                    <li class="mb-1">
                        <span class="copyright-text px-3">© Copyright SUDS-2-U LLC</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <P class="download_text">Download The SUDS-2-U App Now</P>
                <div class="d-flex justify-content-start align-items-center">
                    <a href="https://play.google.com/store/apps/details?id=com.suds_2_u" target="_blank">
                        <img src="{{url('public/website/images/stock-images/google-play.png')}}"
                            class="img-fluid mr-2 w-75">
                    </a>
                    <a href="#" target="_blank">
                        <img src="{{url('public/website/images/stock-images/app-store.png')}}"
                            class="img-fluid ml-2 w-75">
                    </a>
                </div>
                <ul class="social_links list-unstyled mt-4">
                    <li class="d-inline-block mr-3">
                        <a href="https://www.facebook.com/SUDS2UTEXAS/" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="d-inline-block mr-3">
                        <a href="https://www.youtube.com/channel/UClll9QuNOrj8NtaK_xJu1AQ" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <!--<li class="d-inline-block mr-3">-->
                    <!--    <a href="#">-->
                    <!--        <i class="fab fa-twitter"></i>-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER SECTION END -->
<div class="modal fade" id="freedetailsrequest">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">×</button>

                <!-- <h3 class="text-center text-uppercase mt-5 mb-4" style="font-weight: 900;"><span class="font-weight-lighter">Congratulations!!</span></h3>
                            <h3 class="text-center text-uppercase mb-5" style="font-weight: 900;"><span style="font-weight: 900; color: var(--mainColor);">Someone is gonna be contacting you soon</span></h3> -->
                <h3 class="text-center text-uppercase mt-5 mb-4" style="font-weight: 900;"><span
                        class="font-weight-lighter">Thank You!!</span></h3>
                <h3 class="text-center text-uppercase mb-5" style="font-weight: 900;"><span
                        style="font-weight: 900; color: var(--mainColor);">Someone will be contacting you soon</span>

            </div>
        </div>
    </div>
</div>

<!-- JQUERY JS START -->
<script src="{{url('public/admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<!--<script src="{{url('public/website/js/jQuery-v3.5.1.js')}}"></script>-->
<script src="https://johannburkard.de/resources/Johann/jquery.highlight-4.js"></script>
<!-- POPPER JS START -->
<script src="{{url('public/website/js/popper.min.js')}}"></script>
<!-- BOOTSTRAP JS START -->
<script src="{{url('public/website/js/bootstrap.min.js')}}"></script>
<!-- SWIPER SLIDER JS START -->
<script src="{{url('public/website/js/swiper-bundle.min.js')}}"></script>
<!-- MAIN JS START -->
<script src="{{url('public/website/js/main.js')}}"></script>
<script src="{{url('public/admin/assets/js/sweetalert.min.js')}}"></script>
<script src="{{url('public/custom.js')}}"></script>

<script type="text/javascript">
var APP_URL = {
    !!json_encode(url('/')) !!
}
var secure_token = '{{ csrf_token() }}';
</script>
<style type="text/css">
.contact_details li {
    padding: .5rem 1rem;
}

.loading {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    padding-top: 230px;
    text-align: center;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.5);
    display: none;
}

.dumpSearch ul {
    overflow: scroll;
    height: 200px;
}

.swal-text {
    font-weight: 600;
    font-size: 18px;
    font-style: normal;
    padding-top: 22px;
}
</style>
</body>

</html>