
@extends('website.layout.main')
@section('main-content')

    <!-- MAIN SECTION START -->
    <main class="container-fluid px-0">
        <!-- BLOG SECTION START -->
        <section class="blog_section px-3 px-md-0 monitor" >
            <h1 class="text-center text-uppercase mb-5 col-lg-8 mx-auto"><span style="font-weight: 900; color: var(--mainColor);">SUDS-2-U</span> <span class="font-weight-lighter">Blog</span></h1>

            <div class="container mb-n5">
                <div class="row bg-white shadow rounded overflow-hidden mb-5">
                    <div class="col-md-7 px-0">
                        <img src="{{url('public/website/images/stock-images/banner.jpg')}}" class="img-fluid">
                    </div>
                    <div class="col-md-5 px-0">
                        <div class="d-flex flex-column justify-content-between h-100 p-md-4 p-3">
                            <div class="mb-4">
                                <span class="text-muted font-italic">22 May 2020</span>
                                <h5 class="heading_ellipsis text-uppercase mb-3 mt-3" style="font-weight: bold;">SUDS-2-U is proud to announce a new App that brings the car wash to you anywhere anytime.</h5>
                                <p class="block_ellipsis mb-0 mt-2">SUDS-2-U is coming to a town near you! We are pleased to announce the release of the SUDS-2-U app in Texas and parts of New Mexico. This ground breaking app takes the hassle and frustration out of maintaining your cars sheik appearance. With the SUDS-2-U app you can now order a mobile wash to you On-Demand. Just download the app, select your package, and a mobile wash professional in your area will come right over to detail your vehicle. Its that easy. </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <a href="https://www.facebook.com/SUDS2UTEXAS/" class="d-inline-block mr-2">
                                        <img src="{{url('public/website/images/stock-images/facebook.png')}}" class="img-fluid" width="30">
                                    </a>
                                    <a href="https://www.youtube.com/channel/UClll9QuNOrj8NtaK_xJu1AQ" class="d-inline-block mr-2">
                                        <img src="{{url('public/website/images/stock-images/imgpsh_fullsize_anim.png')}}" class="img-fluid bloimg" width="30">
                                    </a>
                                </div>
                                <!--<a href="{{url('blog-details')}}" class="btn customBtn">Read More</a>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row bg-white shadow rounded overflow-hidden mb-5">
                    <div class="col-md-7 px-0">
                        <img src="{{url('public/website/images/stock-images/banner-2.jpg')}}" class="img-fluid">
                    </div>
                    <div class="col-md-5 px-0">
                        <div class="d-flex flex-column justify-content-between h-100 p-md-4 p-3">
                            <div class="mb-4">
                                <span class="text-muted font-italic">22 May 2020</span>
                                <h5 class="heading_ellipsis text-uppercase mb-3 mt-3" style="font-weight: bold;">SUDS-2-U is proud to announce a new App that brings the car wash to you anywhere anytime.</h5>
                                <p class="block_ellipsis mb-0 mt-2">The SUDS-2-U app is available to download for free on the App Store and Google Play. Once you have registered, Users can request a car wash on their smartphone On-Demand and within minutes a professional detailer arrives at your location to detail your vehicle. Users also have the ability to schedule their wash at a designated time and place with any of the mobile wash professionals in our network. With the SUDS-2-U app, the frustration of finding a mobile washer in your area available on you time is now over. SUDS-2-U also uses GPS tracking on all their mobile wash professionals so users can see in real time where their detailer is and when they will arrive. The app will also let you know every step of the process through notifications so you can see the progress as its being completed. When the wash is complete users will be sent 4 photos of their newly washed vehicle and from there they can rate and even tip the washer! All from the convenience of your work of home. All payments happen automatically through the app so there is no cash or check ever exchanged. Download the app today and let SUDS-2-U do all the work while you enjoy your day!.</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <a href="https://www.facebook.com/SUDS2UTEXAS/" class="d-inline-block mr-2">
                                        <img src="{{url('public/website/images/stock-images/facebook.png')}}" class="img-fluid" width="30">
                                    </a>
                                    <a href="https://www.youtube.com/channel/UClll9QuNOrj8NtaK_xJu1AQ" class="d-inline-block mr-2">
                                        <img src="{{url('public/website/images/stock-images/imgpsh_fullsize_anim.png')}}" class="img-fluid bloimg" width="30">
                                    </a>
                                </div>
                                <!--<a href="{{url('blog-details')}}" class="btn customBtn">Read More</a>-->
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="row bg-white shadow rounded overflow-hidden mb-5">-->
                <!--    <div class="col-md-7 px-0">-->
                <!--        <img src="{{url('public/website/images/stock-images/banner-3.jpg')}}" class="img-fluid">-->
                <!--    </div>-->
                <!--    <div class="col-md-5 px-0">-->
                <!--        <div class="d-flex flex-column justify-content-between h-100 p-md-4 p-3">-->
                <!--            <div class="mb-4">-->
                <!--                <span class="text-muted font-italic">22 May 2020</span>-->
                <!--                <h5 class="heading_ellipsis text-uppercase mb-3 mt-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>-->
                <!--                <p class="block_ellipsis mb-0 mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>-->
                <!--            </div>-->
                <!--            <div class="d-flex justify-content-between align-items-center">-->
                <!--                <div class="">-->
                <!--                    <a href="#" class="d-inline-block mr-2">-->
                <!--                        <img src="{{url('public/website/images/stock-images/facebook.png')}}" class="img-fluid" width="30">-->
                <!--                    </a>-->
                <!--                    <a href="#" class="d-inline-block mr-2">-->
                <!--                        <img src="{{url('public/website/images/stock-images/twitter.png')}}" class="img-fluid" width="30">-->
                <!--                    </a>-->
                <!--                </div>-->
                <!--                <a href="{{url('blog-details')}}" class="btn customBtn">Read More</a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="row bg-white shadow rounded overflow-hidden mb-5">-->
                <!--    <div class="col-md-7 px-0">-->
                <!--        <img src="{{url('public/website/images/stock-images/banner-4.jpg')}}" class="img-fluid">-->
                <!--    </div>-->
                <!--    <div class="col-md-5 px-0">-->
                <!--        <div class="d-flex flex-column justify-content-between h-100 p-md-4 p-3">-->
                <!--            <div class="mb-4">-->
                <!--                <span class="text-muted font-italic">22 May 2020</span>-->
                <!--                <h5 class="heading_ellipsis text-uppercase mb-3 mt-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>-->
                <!--                <p class="block_ellipsis mb-0 mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>-->
                <!--            </div>-->
                <!--            <div class="d-flex justify-content-between align-items-center">-->
                <!--                <div class="">-->
                <!--                    <a href="#" class="d-inline-block mr-2">-->
                <!--                        <img src="{{url('public/website/images/stock-images/facebook.png')}}" class="img-fluid" width="30">-->
                <!--                    </a>-->
                <!--                    <a href="#" class="d-inline-block mr-2">-->
                <!--                        <img src="{{url('public/website/images/stock-images/twitter.png')}}" class="img-fluid" width="30">-->
                <!--                    </a>-->
                <!--                </div>-->
                <!--                <a href="{{url('blog-details')}}" class="btn customBtn">Read More</a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="row bg-white shadow rounded overflow-hidden mb-5">-->
                <!--    <div class="col-md-7 px-0">-->
                <!--        <img src="{{url('public/website/images/stock-images/banner-5.jpg')}}" class="img-fluid">-->
                <!--    </div>-->
                <!--    <div class="col-md-5 px-0">-->
                <!--        <div class="d-flex flex-column justify-content-between h-100 p-md-4 p-3">-->
                <!--            <div class="mb-4">-->
                <!--                <span class="text-muted font-italic">22 May 2020</span>-->
                <!--                <h5 class="heading_ellipsis text-uppercase mb-3 mt-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>-->
                <!--                <p class="block_ellipsis mb-0 mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>-->
                <!--            </div>-->
                <!--            <div class="d-flex justify-content-between align-items-center">-->
                <!--                <div class="">-->
                <!--                    <a href="#" class="d-inline-block mr-2">-->
                <!--                        <img src="{{url('public/website/images/stock-images/facebook.png')}}" class="img-fluid" width="30">-->
                <!--                    </a>-->
                <!--                    <a href="#" class="d-inline-block mr-2">-->
                <!--                        <img src="{{url('public/images/stock-images/twitter.png')}}" class="img-fluid" width="30">-->
                <!--                    </a>-->
                <!--                </div>-->
                <!--                <a href="{{url('blog-details')}}" class="btn customBtn">Read More</a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="text-center mb-5">-->
                <!--    <button type="button" class="btn customBtn btn-lg">Load More</button>-->
                <!--</div>-->
            </div>
        </section>
        <!-- BLOG SECTION END -->
    </main>
    <!-- MAIN SECTION END -->

@endsection