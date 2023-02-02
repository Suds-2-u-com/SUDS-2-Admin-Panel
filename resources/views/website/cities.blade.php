@extends('website.layout.main')
@section('main-content')


<!-- MAIN SECTION START -->
<main class="container-fluid px-0">
    <!-- CITIES SECTION START -->
    <section class="cities_section px-3 px-md-0">
        <div class="col-lg-4 col-md-8 search_box">
            <h3 class="text-white text-uppercase text-center">Where we <span
                    style="font-weight: 900; color: var(--mainColor);">wash</span></h3>
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Search by City" style="min-height: 50px;"
                    id="searchn">
                <div class="dumpSearch searchclass" style="display: none;"></div>
                <div class="input-group-append">
                    <button class="btn customBtn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- CITIES SECTION END -->
    <!-- CITIES SECTION END -->
    <!-- COVERFLOW EFFET SLIDER START -->
    <section class="coverflow_slider_section px-3 px-md-0">
        <h1 class="text-center text-uppercase mb-4 col-lg-8 mx-auto"><span class="font-weight-lighter">FIND OUT
                WHERE</span> <span style="font-weight: 900; color: var(--mainColor);">WE ARE WASHING</span></h1>
        <p class="text-center mb-5 col-lg-8 mx-auto">Find out if we’re washing near you!</p>
        <div class="swiper-container coverflowEffect container px-3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/texas.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">Texas</h4>
                            <p>We love the lone star state! Its home to 29 million people and where SUDS-2-U is located.
                                Click to see the list of cities we service in Texas.</p>
                            <a href="#" class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/arizona.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">Arizona</h4>
                            <p>Coming Soon!</p>
                            <a href="#" class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/nevada.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">Nevada</h4>
                            <p>Coming Soon!</p>
                            <a href="#" class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/oklahoma.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">Oklahoma</h4>
                            <p>Coming Soon!</p>
                            <a href="#" class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/new-mexico.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">New Mexico</h4>
                            <p>The great state of New Mexico is home to many wonderful attrations and has a rich history
                                of culture and people. Click to see where we are servicing in New Mexico.</p>
                            <a href="#" class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADD ARROWS -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- ADD PAGINATIONS -->
            <div class="swiper-pagination"></div>
        </div>



    </section>
    <!-- COVERFLOW EFFET SLIDER END -->
    <div class="login-section ptb-100" style="padding-top: 100px; padding-bottom: 100px;">
        <div class="container">
            <div class="login-form" style="padding:50px 100px;">
                <div class="login-title">
                    <h3
                        style="font-size: 42px; margin-bottom: 18px; color: #343846; font-weight:700; text-align: center;">
                        Not in your town?</h3>



                    <div class="text-center">
                        <button type="button" class="btn customBtn" data-toggle="modal" data-target="#findCity">Request
                            SUDS-2-U in your town</button>
                    </div>

                    <!-- FIND CITY MODAL START -->
                    <div class="modal fade" id="findCity">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- MODAL BODY -->
                                <form method="post" id="sumidmail">
                                    @csrf
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal">×</button>

                                        <h1 class="text-uppercase mb-3"
                                            style="font-weight: 900; font-size: 34px;  padding-top: 22px;"><span
                                                class="font-weight-lighter">Join</span> <span
                                                style="font-weight: 900; color: var(--mainColor);">Our Mailing
                                                List</span></h1>
                                        <p class="mb-5" style="text-align: center;">We’re expanding quickly! We’ll let
                                            you know when we arrive in your area.</p>
                                        <div id="successmsg"></div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Name" name="name"
                                                id="name">

                                        </div>
                                        <span class="name_err" style="color:red;"></span>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" placeholder="Your Email Address"
                                                name="email" id="email">

                                        </div>
                                        <span class="email_err" style="color:red;"></span>

                                        <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-city"></i>
                                            </span>
                                        </div>
                                       
                                        <select class="form-control" placeholder="State" style="min-height: 48px;" name="state" id="statehome">
                                            <option value="">Select State</option>
                                            @if(!empty($state))
                                            @foreach($state as $rows)
                                            <option value="{{$rows['id']}}">{{$rows['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>


                                        
                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-city"></i>
                                            </span>
                                        </div>

                                        <select class="form-control" placeholder="City" style="min-height: 48px;" name="city" id="cityhome">
                                            <option value="">Select City</option>
                                            
                                        </select>
                                    </div>
                                    <span class="text-danger error-text city_err"></span> 

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Your Mobile Number"
                                                name="mobile" id="mobile">

                                        </div>
                                        <span class="mobile_err" style="color:red;"></span>
                                    </div>

                                    <!-- MODAL FOOTER -->
                                    <div class="modal-footer" style="margin: 0 auto;">
                                        <button type="button" class="btn customBtnDark my-0 mr-2"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn customBtn my-0 ml-2 submitmail">Keep Me
                                            Posted</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- FIND CITY MODAL CLOSE -->

                    <!-- FIND CITY MODAL START -->
                    <div class="modal fade" id="citypop">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal">×</button>

                                    <h3 class="text-center text-uppercase mt-5 mb-4" style="font-weight: 900;"><span
                                            class="font-weight-lighter">Congratulations!!</span></h3>
                                    <h3 class="text-center text-uppercase mb-5" style="font-weight: 900;"><span
                                            style="font-weight: 900; color: var(--mainColor);">Suds-2-U is in your
                                            town</span></h3>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIND CITY MODAL CLOSE -->

                    <!-- FIND CITY MODAL START -->
                    <div class="modal fade" id="cityNopop">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal">×</button>

                                    <h3 class="text-center text-uppercase mt-5 mb-4" style="font-weight: 900;"><span
                                            class="font-weight-lighter">We’re sorry!!</span></h3>
                                    <h3 class="text-center text-uppercase mb-5" style="font-weight: 900;"><span
                                            style="font-weight: 900; color: var(--mainColor);">Suds-2-U is not available in your
                                            town</span></h3>

                                            
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn cityRpt">Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIND CITY MODAL CLOSE -->

                </div>

            </div>
        </div>
    </div>
</main>
<!-- MAIN SECTION END -->
<style>
.login-section .login-form {
    border: 1px solid #dedede;
}

.login-form {
    background: #fff;
    -webkit-box-shadow: 0 2px 48px 0 rgb(0 0 0 / 8%);
    box-shadow: 0 2px 48px 0 rgb(0 0 0 / 8%);
    padding: 40px;
    border-radius: 5px;
    max-width: 600px;
    margin: auto;
}

.dumpSearch {
    position: absolute;
    top: 105%;
    left: 26%;
    transform: translateX(-50%);
    width: 421px;
    background: #ffffff;
    border-radius: 4px !important;
    box-shadow: 1px 2px 8px -4px #000;
    /* border: 1px solid #999; */
    padding: 8px 0;
    z-index: 999;
    /* height: 266px; */
    overflow-y: auto;
    margin-left: 100px;
}

.dumpSearch ul {
    height: auto !important;
    max-height: 200px !important;
    overflow: auto !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.dumpSearch a {
    display: block;
    color: #000;
    font-size: 15px;
    padding: 8px 20px;
    text-decoration: none;
}

.dumpSearch a:hover {
    background-color: #00afec;
    color: #ffffff;
}

@media only screen and (max-width: 600px) {
    .dumpSearch {

    left: 20px;
    width: 221px;
}
}
</style>
@endsection