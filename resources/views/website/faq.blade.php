@extends('website.layout.main')
@section('main-content')


    <!-- MAIN SECTION START -->

        <!-- FAQ SECTION START -->
         <!--<div class="col-lg-12">-->
         <!--               <video width="320" height="240" controls>-->
         <!--                 <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/mp4">-->
         <!--                 <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/ogg">-->
         <!--               Your browser does not support the video tag.-->
         <!--               </video>-->
         <!--           </div>-->
        <section class="faq_section px-3 px-md-0">
            <h1 class="text-center text-uppercase mb-5 col-lg-8 mx-auto"><span style="font-weight: 900; color: var(--mainColor);">SUDS-2-U</span> <span class="font-weight-lighter">FAQ</span></h1>

            <div class="container mb-n3">
                <div class="row">
                   
                    <div class="col-lg-12 mx-auto">
                        <ul class="accordion list-unstyled mb-0 ml-3" id="faq">
                            <li class="">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-header" id="faqhead1">
                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">What is SUDS-2-U?</a>
                                    </div>
                            
                                    <div id="faq1" class="collapse" aria-labelledby="faqhead1" data-parent="#faq">
                                        <div class="card-body">SUDS-2-U is an on-demand mobile wash service app that connects wash clients to professional mobile washers, at any location. Just download the app, enter your location, select a package and a mobile wash professional will be on their way to service your vehicle, RV, motorcycle, boat, or business.</div>
                                    </div>
                                </div>
                            </li>

                            <li class="">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-header" id="faqhead2">
                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">How to schedule a wash for a later time or date?</a>
                                    </div>
                            
                                    <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                                        <div class="card-body">Scheduling a wash is simple and take only minutes.
From your dashboard select the schedule tab. From there, select the vendor, time, date and package you want and that’s it! The washer you selected will be assigned the package and will arrive at the selected time and date! That’s it! Washing made easy!</div>
                                    </div>
                                </div>
                            </li>

                            <li class="">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-header" id="faqhead3">
                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq3">What if I like my usual mobile wash vendor? Or what if I really liked the last on-demand washer that was sent to me and would like to use them again?</a>
                                    </div>
                            
                                    <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                                        <div class="card-body">We love repeat customers and are here to connect you with your valued washer. If you like your current washer, great!! Chances are they have a profile on our app and can be scheduled through our app!! If you enjoyed your last on-demand washer and would like to use them again, find the washers name from your booking history in the navigation pane in the app and schedule them again! Its that easy! </div>
                                    </div>
                                </div>                             
                            </li>

                            <li class="">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-header" id="faqhead4">
                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4" aria-expanded="true" aria-controls="faq4">Who are the mobile washers used?</a>
                                    </div>
                            
                                    <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                                        <div class="card-body">SUDS-2-U mobile washers are licensed, background checked and insured professionals who have made a commitment to provide the best professional car washing experience for anyone using the app. Our mobile washers are professionals who run their own businesses and are all available through our app.</div>
                                    </div>
                                </div>                             
                            </li>

                            <li class="">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-header" id="faqhead5">
                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq5" aria-expanded="true" aria-controls="faq5">What if I have multiple cars and items to wash?</a>
                                    </div>
                            
                                    <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                                        <div class="card-body">With the SUDS-2-U app servicing multiple vehicles is a snap! Afterselecting the package you would like to order for the first vehicle, anADD CAR button will appear on the next screen. Simply tap the ADD CARbutton to add additional cars to your request and follow the same procedure to add as many vehicles as needed. </div>
                                    </div>
                                </div>
                            </li>

                            <li class="">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-header" id="faqhead6">
                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq6" aria-expanded="true" aria-controls="faq6">Can I contact my washer through the app?</a>
                                    </div>
                            
                                    <div id="faq6" class="collapse" aria-labelledby="faqhead6" data-parent="#faq">
                                        <div class="card-body">you can message your mobile washer directly through the app for up to 24 hours after your wash is complete. To contact your mobile washer after your wash is complete simply go to your booking history in the app and select the washer from there you can send them a message. Note: washers are sometimes busy, please give them time to respond.</div>
                                    </div>
                                </div>
                            </li>

                            <li class="">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-header" id="faqhead7">
                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq7" aria-expanded="true" aria-controls="faq7">Can I rate and/or tip my washer?</a>
                                    </div>
                            
                                    <div id="faq7" class="collapse" aria-labelledby="faqhead7" data-parent="#faq">
                                        <div class="card-body">When your wash is complete, you will be asked to tip, rate and favorite(if you wish) your mobile wash professional. And while tipping is greatly appreciated it is not required.  Please remember it’s always important to rate your mobile wash experience so we can make sure you have the best SUDS-2-U experience, every time you use the app!</div>
                                    </div>
                                </div>                             
                            </li>

                          
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- FAQ SECTION END -->
    </main>
    <!-- MAIN SECTION END -->
        <main class="container-fluid px-0">
          <section class="faq_section px-3 px-md-0" style="padding-top: 0px;margin-top: 0px;">
         

            <div class="container mb-n3">
                <div class="row">
                   
                    <!-- <div class="col-lg-4 mx-auto">
                        <video width="100%" height="100%" controls>
                          <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/mp4">
                          <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/ogg">
                        Your browser does not support the video tag.
                        </video>
                    </div> -->
                    <div class="col-lg-4 mx-auto">
                       <video width="100%" height="100%" controls>
                          <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/mp4">
                          <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/ogg">
                        Your browser does not support the video tag.
                        </video>
                    </div>
                    <!-- <div class="col-lg-4 mx-auto">
                        <video width="100%" height="100%" controls>
                          <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/mp4">
                          <source src="{{url('public/Suds-2-uintrovideo.mp4')}}" type="video/ogg">
                        Your browser does not support the video tag.
                        </video>
                    </div> -->
                </div>
                </div>
                </section>
      </main>
@endsection

    