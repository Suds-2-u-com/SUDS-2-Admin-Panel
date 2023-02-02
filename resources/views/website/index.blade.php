@extends('website.layout.main')
<style>
.banner_section .form_bg .justify-content-start {
    -ms-flex-pack: start !important;
    justify-content: center !important;
}
</style>
@section('main-content')
<section class="banner_section">
    <video autoplay muted loop id="myVideo">
        <source src="{{url('public/website/images/stock-images/car-washing.mp4')}}" type="video/mp4">
    </video>

    <div class="text_box">
        <h1 class="text-white text-uppercase"><span class="font-weight-lighter">Order Your</span><br> <span
                style="font-weight: 900; color: var(--mainColor);">Wash Now!</span></h1>
    </div>

    <div class="form_box col-lg-7 col-md-7 ml-md-auto">
        <div class="form_bg">
            <h3 class="text-center text-white text-uppercase"><span
                    style="font-weight: 900; color: var(--mainColor);">Order A</span> <span
                    class="font-weight-lighter">Wash</span></h3>
            <div class="d-flex justify-content-start align-items-center w-75 mx-auto mb-4">
                <a href="https://play.google.com/store/apps/details?id=com.suds_2_u">
                    <img src="{{url('public/website/images/stock-images/google-play.png')}}" class="img-fluid mr-2"
                        style=" max-width: 130px;">
                </a>
                <a href="#">
                    <img src="{{url('public/website/images/stock-images/app-store.png')}}" class="img-fluid ml-2"
                        style="max-width: 130px;">
                </a>
            </div>
            <h3 class="text-center text-white text-uppercase"><span
                    style="font-weight: 900; color: var(--mainColor);">Full Detail</span> <span
                    class="font-weight-lighter">Request</span></h3>
            <p class="text-center text-white">Our representative will contact you today to schedule a custom detailing
                of your vehicle.</p>
            <div id="successmsg"></div>
            <form id="requestfrm" method="post">
                @csrf
                <div id="success"></div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="First Name" name="fname" id="fname">
                        </div>
                        <span class="text-danger error-text fname_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lname">
                        </div>
                        <span class="text-danger error-text lname_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        </div>
                        <span class="text-danger error-text email_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone">
                        </div>
                        <span class="text-danger error-text phone_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-city"></i>
                                </span>
                            </div>
                            <select class="form-control" id="state" name="state">
                                <option value="">Select State</option>
                                @if(!empty($state))
                                @foreach($state as $rows)
                                <option value="{{$rows['id']}}">{{$rows['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <span class="text-danger error-text state_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-city"></i>
                                </span>
                            </div>
                            <select class="form-control" id="city" name="city">
                                <option value="">Select City</option>

                            </select>

                        </div>
                        <span class="text-danger error-text city_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-city"></i>
                                </span>
                            </div>

                            <input type="text" class="form-control" placeholder="Zip code" name="zip_code"
                                id="zip_code">
                        </div>
                        <span class="text-danger error-text zip_code_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address" name="address" id="address">

                        </div>
                        <span class="text-danger error-text address_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </span>
                            </div>
                            <select class="form-control" name="service" id="service">
                                <option selected disabled>Select Wash Type</option>
                                @if(!empty($category))
                                @foreach($category as $typerow)
                                <option value="{{$typerow->category_id}}">{{$typerow->category_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <span class="text-danger error-text service_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </span>
                            </div>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="">Payment Method</option>
                                <option value="CC_Payment">CC Payment</option>
                                <option value="PayPal">PayPal</option>
                                <option value="Fleet_Card">Fleet Card</option>

                            </select>
                        </div>
                        <span class="text-danger error-text payment_method_err"></span>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </span>
                            </div>
                            <select name="how_many" id="how_many" class="form-control">
                                <option value="">How Many Vehicles</option>
                                <option value="1-10">1</option>
                                <option value="1-10">2</option>
                                <option value="1-10">3</option>
                                <option value="41+">4</option>
                            </select>
                        </div>
                        <span class="text-danger error-text how_many_err"></span>
                    </div>
                    <div class="col-6">

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </span>
                            </div>
                            <select class="form-control" name="property_type" id="property_type">
                                <option selected disabled value="">Property Type</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                            </select>
                        </div>
                        <span class="text-danger error-text property_type_err"></span>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn customBtn btn-block my-0 requestSubmit">Submit</button>
                    </div>
                    <div class="col-6">
                        <button type="reset" class="btn customBtnDark btn-block my-0 resetbtn">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
</header>
<!-- HEADER SECTION END -->


<!-- MAIN SECTION START -->
<main class="container-fluid px-0">
    <!-- SIMPLE SLIDER START -->
    <section class="simple_slider_section px-3 px-md-0">
        <div class="swiper-container simpleSlider container px-3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-2">
                            <div class="text_box mb-4">
                                <h1 class="text-lg-right text-center text-uppercase mb-4"><span
                                        class="font-weight-lighter">How It</span> <span
                                        style="font-weight: 900; color: var(--mainColor);">Works</span></h1>
                                <p class="text-lg-right text-center mb-4">1. Select From Our</p>
                                <p class="text-lg-right text-center mb-4">Bronze, Silver, Gold, Diamond Or Platinum
                                    Packages.</p>
                                <div class="text-lg-right text-center">
                                    <a href="#" class="btn customBtn">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="img_box">
                                <img src="{{url('public/website/images/stock-images/img-1.png')}}"
                                    class="img-fluid d-block mr-lg-auto mx-auto w-75">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-2">
                            <div class="text_box mb-4">
                                <h1 class="text-lg-right text-center mb-4"><span class="font-weight-lighter">HOW
                                        IT</span> <span style="font-weight: 900; color: var(--mainColor);">WORKS</span>
                                </h1>
                                <p class=" text-lg-right text-center mb-4">2. Suds-2-U is on its way</p>
                                <p class="text-lg-right text-center mb-4">A nearby professional mobile car detailer is
                                    located and assigned to you</p>
                                <div class="text-lg-right text-center">
                                    <a href="#" class="btn customBtn">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="img_box">
                                <img src="{{url('public/website/images/stock-images/img-2.png')}}"
                                    class="img-fluid d-block mr-lg-auto mx-auto w-75">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-2">
                            <div class="text_box mb-4">
                                <h1 class="text-lg-right text-center mb-4"><span class="font-weight-lighter">HOW
                                        IT</span> <span style="font-weight: 900; color: var(--mainColor);">WORKS</span>
                                </h1>
                                <p class="text-lg-right text-center mb-4">3. SUDS-2-U in Progress</p>
                                <p class="text-lg-right text-center mb-4">A fully equipped SUDS-2-U professional arrives
                                    at your location to detail your car to perfection</p>
                                <div class="text-lg-right text-center">
                                    <a href="#" class="btn customBtn">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="img_box">
                                <img src="{{url('public/website/images/stock-images/img-3.png')}}"
                                    class="img-fluid d-block mr-lg-auto mx-auto w-75">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-2">
                            <div class="text_box mb-4">
                                <h1 class="text-lg-right text-center mb-4"><span class="font-weight-lighter">HOW
                                        IT</span> <span style="font-weight: 900; color: var(--mainColor);">WORKS</span>
                                </h1>
                                <p class=" text-lg-right text-center mb-4">4. SUDS-2-U Wash Completed</p>
                                <p class="text-lg-right text-center mb-4">Once your wash is completed you will receive a
                                    notification with pictures of your completed wash. From here you can rate, tip and
                                    review the washer!”</p>
                                <div class="text-lg-right text-center">
                                    <a href="#" class="btn customBtn">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="img_box">
                                <img src="{{url('public/website/images/stock-images/img-4.png')}}"
                                    class="img-fluid d-block mr-lg-auto mx-auto w-75">
                            </div>
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
    <!-- SIMPLE SLIDER END -->


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
                            <a href="{{url('Cities')}}"  class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/arizona.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">Arizona</h4>
                            <p>Coming Soon!</p>
                            <a href="{{url('Cities')}}" class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/nevada.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">Nevada</h4>
                            <p>Coming Soon!</p>
                            <a href="{{url('Cities')}}" class="text-decoration-none text-uppercase">Search City List</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{url('public/website/images/stock-images/oklahoma.jpg')}}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="text-uppercase">Oklahoma</h4>
                            <p>Coming Soon!</p>
                            <a href="{{url('Cities')}}" class="text-decoration-none text-uppercase">Search City List</a>
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
                            <a href="{{url('Cities')}}" class="text-decoration-none text-uppercase">Search City List</a>
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
        <div class="text-center">
            <button type="button" class="btn customBtn" data-toggle="modal" data-target="#findCity">Don't See Your
                City?</button>
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
                                    style="font-weight: 900; color: var(--mainColor);">Our Mailing List</span></h1>
                            <p class="mb-5" style="text-align: center;">We’re expanding quickly! We’ll let you know when
                                we arrive in your area.</p>
                            <div id="successmsg"></div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Name" name="name" id="name">

                            </div>
                            <span class="name_err" style="color:red;"></span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" placeholder="Your Email Address" name="email"
                                    id="email">

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
                                        <i class="fas fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Mobile" id="mobile" name="mobile">

                            </div>
                            <span class="mobile_err" style="color:red;"></span>


                        </div>

                        <!-- MODAL FOOTER -->
                        <div class="modal-footer" style="margin: 0 auto;">
                            <button type="button" class="btn customBtnDark my-0 mr-2"
                                data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn customBtn my-0 ml-2 submitmail">Keep Me Posted</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIND CITY MODAL CLOSE -->
    </section>
    <!-- COVERFLOW EFFET SLIDER END -->


    <!-- BECOME A WASHER SECTION START -->
    <section class="become_a_washer_section">
        <h1 class="section_heading text-center text-uppercase mb-4 col-lg-8 mx-auto"><span
                class="font-weight-lighter">Join Our Team Of Networking</span><br> <span
                style="font-weight: 900; color: var(--mainColor);">Professional DETAILERS</span></h1>
        <p class="text-center mb-5 col-lg-8 mx-auto">Find out if we’re washing near you!</p>
        <div class="container mb-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow h-100">
                        <div class="d-flex justify-content-center align-items-center p-4">
                            <img src="{{url('public/website/images/img/car-cleaning.png')}}"
                                class="card-img-top d-block mx-auto ">
                        </div>
                        <div class="card-body">
                            <h5 class="text-uppercase" style="font-weight: bold;">Be your own boss</h5>
                            <p class="mb-0">Operate your own business through SUDS-2-U. You decide where, when and how
                                much you work.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow h-100">
                        <div class="d-flex justify-content-center align-items-center p-4">
                            <img src="{{url('public/website/images/img/car-wash-franchise.jpg')}}"
                                class="card-img-top d-block mx-auto ">
                        </div>
                        <div class="card-body">
                            <h5 class="text-uppercase" style="font-weight: bold;">Choose your own hours</h5>
                            <p class="mb-0">We’ll only send you job requests when you’re “online.” Your schedule is your
                                call.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow h-100">
                        <div class="d-flex justify-content-center align-items-center p-4">
                            <img src="{{url('public/website/images/img/Detailing.jpg')}}"
                                class="card-img-top d-block mx-auto ">
                        </div>
                        <div class="card-body">
                            <h5 class="text-uppercase" style="font-weight: bold;">Get paid fast</h5>
                            <p class="mb-0">All payments are automatically submitted through the app, and deposited into
                                your bank account. (Tips too!)</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="text-center">
            <a href="{{url('become-a-washer')}}" class="btn customBtn">Sign up today</a>
        </div>
    </section>
    <!-- BECOME A WASHER SECTION END -->
</main>
<!-- MAIN SECTION END -->

<style>
.shadow .d-flex.justify-content-center.align-items-center.p-4 img {

    min-height: 225px;
}
</style>
@endsection