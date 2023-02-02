@extends('website.layout.main')
@section('main-content')
    <!-- MAIN SECTION START -->
    <main class="container-fluid px-0">
        <!-- GET AN APP SECTION START -->
        <section class="get_an_app_section px-3 px-md-0">
            <div class="col-lg-4 col-md-8 mobile_box">
                <h3 class="text-white text-center text-uppercase">Get <span style="font-weight: 900; color: var(--mainColor);">SUDS-2-U App</span></h3>
                <div id="successmsg"></div>
                <form method="post" id="getapp">
                      @csrf
                     
                <div class="form-group form-group-lg">
                    <select class="form-control" name="device" id="device"  style="min-height: 50px;">
                       <option value="">Select Device</option>
                       <option value="1">Android</option>
                       <option value="2">Iphone</option>
                   </select>
                </div>
                     
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Your Mobile Number" style="min-height: 50px;" name="mobile" id="mobile">
                    <div class="input-group-append">
                        <button class="btn customBtn" type="button" id="getappbtn">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                </div>
                </form>
                 <span class="text-danger error-text 0_err"></span>
                <div class="row mt-5">
                    <div class="col-6">
                        <a href="https://play.google.com/store/apps/details?id=com.suds_2_u" class="app_link_btn shadow" target="_blank">
                            <!-- <span class="text-center small"><b>Get SUDS-2-U on</b></span> -->
                            <div class="d-flex align-items-center store-wrap flex-wrap justify-content-center">
                                <img src="{{url('public/website/images/stock-images/playstore.png')}}" class="img-fluid d-block" >
                                <h5 class="text-center font-weight-bold mb-0">Google Play</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="app_link_btn shadow" target="_blank">
                            <!-- <span class="text-center small"><b>Get SUDS-2-U on</b></span> -->
                            <div class="d-flex align-items-center store-wrap flex-wrap justify-content-center">
                                <img src="{{url('public/website/images/stock-images/im.png')}}" class="img-fluid d-block">
                                <h5 class="text-center font-weight-bold mb-0">App Store</h5>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="mt-5 mb-3">
                      <a href="{{url('Order-On-Site')}}" class="btn customBtn btn-lg btn-block">Order on site</a>
                </div>
                <div class="mb-5">
                      <a href="{{url('Press')}}" class="btn customBtn btn-lg btn-block">Get a Business/Fleet Account</a>
                </div>
            </div>
        </section>
        
        <div class="modal fade" id="getapprequest">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">×</button>

                <!-- <h3 class="text-center text-uppercase mt-5 mb-4" style="font-weight: 900;"><span class="font-weight-lighter">Congratulations!!</span></h3>
                            <h3 class="text-center text-uppercase mb-5" style="font-weight: 900;"><span style="font-weight: 900; color: var(--mainColor);">Someone is gonna be contacting you soon</span></h3> -->
                <h3 class="text-center text-uppercase mt-5 mb-4" style="font-weight: 900;"><span
                        class="font-weight-lighter">Thank You!!</span></h3>
                <h3 class="text-center text-uppercase mb-5" style="font-weight: 900;"><span
                        style="font-weight: 900; color: var(--mainColor);">A Text message will be sent to you soon</span>

            </div>
        </div>
    </div>
</div>
        <!-- GET AN APP SECTION END -->
    </main>
    <!-- MAIN SECTION END -->
@endsection

   