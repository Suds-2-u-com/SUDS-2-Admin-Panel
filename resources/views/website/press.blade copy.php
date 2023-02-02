
@extends('website.layout.main')
@section('main-content')

    <!-- MAIN SECTION START -->
    <main class="container-fluid px-0">
        <!-- PRESS SECTION START -->
        <section class="press_section px-3 px-md-0">
            <div class="col-lg-5 col-md-8 search_box">
                <h1 class="text-white text-uppercase text-center"><span style="font-weight: 900; color: var(--mainColor);">SUDS-2-U</span></h1>
                <h4 class="text-white text-center">Search SUDS-2-U in the news:</h4>
                <form method="post" action="javascript:void(0);" target="_blank" id="serarchfrm">
                <div class="input-group input-group-lg">
                    
                    <input type="text" class="form-control" placeholder="Enter Keywords" style="min-height: 50px;" id="keywords" name="keywords">
                     @csrf
                     <div class="input-group-append">
                        <button class="btn customBtn googlesearch" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="dumpSearch searchclass" style="display: none;"></div>
                    
                    
                </div>
                </form>
            </div>
        </section>
        <!-- PRESS SECTION END -->


        <!-- NEWS SECTION START -->
    
        <!-- NEWS SECTION START -->
        <section class="news_section monitor">
            <div class="container mb-n4">
                <div class="row text-center">
                    <!--<div class="col-lg-4 col-md-6 mb-4">-->
                    <!--    <div class="card border-0 shadow h-100">-->
                    <!--        <img src="{{url('public/website/images/stock-images/banner-3.jpg')}}" class="card-img-top">-->
                    <!--        <div class="card-body">-->
                    <!--            <h5 class="heading_ellipsis text-uppercase mb-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>-->
                    <!--            <span class="text-muted small font-italic">22 May 2020</span>-->
                    <!--            <p class="block_ellipsis mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>-->
                    <!--            <a href="{{url('blog-details')}}" class="text-decoration-none">Read More <i class="fas fa-long-arrow-alt-right ml-1"></i></a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<div class="col-lg-4 col-md-6 mb-4">-->
                    <!--    <div class="card border-0 shadow h-100">-->
                    <!--        <img src="{{url('public/website/images/stock-images/banner-4.jpg')}}" class="card-img-top">-->
                    <!--        <div class="card-body">-->
                    <!--            <h5 class="heading_ellipsis text-uppercase mb-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>-->
                    <!--            <span class="text-muted small font-italic">22 May 2020</span>-->
                    <!--            <p class="block_ellipsis mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>-->
                    <!--            <a href="{{url('blog-details')}}" class="text-decoration-none">Read More <i class="fas fa-long-arrow-alt-right ml-1"></i></a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<div class="col-lg-4 col-md-6 mb-4">-->
                    <!--    <div class="card border-0 shadow h-100">-->
                    <!--        <img src="{{url('public/website/images/stock-images/banner-5.jpg')}}" class="card-img-top">-->
                    <!--        <div class="card-body">-->
                    <!--            <h5 class="heading_ellipsis text-uppercase mb-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>-->
                    <!--            <span class="text-muted small font-italic">22 May 2020</span>-->
                    <!--            <p class="block_ellipsis mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>-->
                    <!--            <a href="{{url('blog-details')}}" class="text-decoration-none">Read More <i class="fas fa-long-arrow-alt-right ml-1"></i></a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <h3 style="margin: 0 auto;">No news stories now, please check back later</h3>
                </div>
            </div>
        </section>
        <!-- NEWS SECTION END -->
        <!-- NEWS SECTION END -->


        <!-- MAIL COMPOSS SECTION START -->
        <section class="mail_composs_section px-3 px-md-0">
            <h1 class="text-center text-uppercase mb-4 col-lg-8 mx-auto"><span class="font-weight-lighter">PRESS TO</span> <span style="font-weight: 900; color: var(--mainColor);">SUDS-2-U</span> <span class="font-weight-lighter">PRESS INQUIERES </span></h1>
            <p class="text-center mb-5 col-lg-8 mx-auto">For press and media inquiries, contact us via email at press@suds2u.com</p>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                          <div id="successmsg"></div>
                        <form class="mx-n3 mx-md-0" id="pressid">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Name" style="min-height: 48px;" name="name" id="name">
                                    </div>
                                     <span class="text-danger error-text name_err"></span>
                                </div>
                
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Your Email Address" style="min-height: 48px;"  name="email" id="email">
                                    </div>
                                     <span class="text-danger error-text email_err"></span>
                                </div>
                
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <textarea class="form-control form-control-lg" rows="5" placeholder="Your Message" name="message" id="message"></textarea>
                                    </div>
                                     <span class="text-danger error-text message_err"></span>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn customBtnDark btn-lg btn-block">Cancel</button>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn customBtn btn-lg btn-block submitpressrequest">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- MAIL COMPOSS SECTION END -->
    </main>
    <!-- MAIN SECTION END -->


<style>
    .googleul li{
        padding: 10px;
        border-bottom: 1px solid #d4d4d4;
    }
</style>
@endsection   