
@extends('website.layout.main')
@section('main-content')

    <!-- MAIN SECTION START -->
    <main class="container-fluid px-0">
        <!-- FORM BECOME A WASHER FORM START -->
        <section class="form_become_a_washer_section px-3 px-md-0">
            <div class="form_box col-lg-6 col-md-10 px-0">
                <div class="form_bg">
                    <h3 class="text-center text-white text-uppercase"><span class="font-weight-lighter">Become A</span> <span style="font-weight: 900; color: var(--mainColor);">Detailer</span></h3>
                    <p class="text-center text-white">Earn on your own schedule</p>
                   <div id="successmsg"></div>
                    <form id="becomeid" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name">
                                </div>
                                 <span class="text-danger error-text first_name_err"></span>
                            </div>
                             
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name">
                                </div>
                                <span class="text-danger error-text last_name_err"></span>
                            </div>

                              
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                                </div>
                                <span class="text-danger error-text email_err"></span>
                            </div>
                           
                              
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Phone Number" name="mobile" id="mobile">
                                </div>
                                <span class="text-danger error-text mobile_err"></span>
                            </div>
                              
                              <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-city"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="State" name="state" id="state">
                                </div>
                                <span class="text-danger error-text state_err"></span>
                            </div>
                            
                          
                             
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-city"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City"  id="search" >
                                    <input type="hidden" name="city" id="city" value="">
                                   <div class="dumpSearch searchclass" style="display: none;"></div>
                                   
                                </div>
                                 <span class="text-danger error-text city_err"></span>
                            </div>
                              <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-city"></i>
                                        </span>
                                    </div>
                                   <input type="text" class="form-control" placeholder="Address" name="address" id="address" >
                                
                                </div>
                                <span class="text-danger error-text address_err"></span>
                            </div>
                             
                            <!--<div class="col-md-6">-->
                            <!--    <div class="input-group mb-3">-->
                            <!--        <div class="input-group-prepend">-->
                            <!--            <span class="input-group-text">-->
                            <!--                <i class="fas fa-language"></i>-->
                            <!--            </span>-->
                            <!--        </div>                            -->
                            <!--        <select class="form-control" name="language" id="language">-->
                            <!--            <option selected disabled value="">Language</option>-->
                            <!--            <option value="English">English</option>-->
                            <!--            <option value="Spanish">Spanish</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--    <span class="text-danger error-text language_err"></span>-->
                            <!--</div>-->
                              <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Company" name="company" id="company">
                                </div>
                                <span class="text-danger error-text company_err"></span>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-question"></i>
                                        </span>
                                    </div>                            
                                    <select class="form-control" name="suds_account" id="suds_account">
                                        <option selected disabled value="">Is this your first SUDS-2-U account?</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                 <span class="text-danger error-text suds_account_err"></span>
                            </div>
                             
                            
                             <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Password" name="password" id="password">
                                </div>
                                <span class="text-danger error-text password_err"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
                                </div>
                                <span class="text-danger error-text confirm_password_err"></span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn customBtn btn-block submitwasher">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- FORM BECOME A WASHER FORM END -->


        <!-- IT PAYS SECTION START -->
        <section class="it_pays_section">
            <h1 class="text-center text-uppercase mb-4 col-lg-8 mx-auto"><span class="font-weight-lighter">GET PAID, JOIN OUR TEAM OF PROFESSIONALS</span></h1>
            
            <div class="container mb-n4">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <div class="d-flex justify-content-center align-items-center p-4">
                                <img src="{{url('public/website/images/img/wash.png')}}" class="card-img-top d-block mx-auto ">
                            </div>
                            <div class="card-body">
                                <h5 class="text-uppercase" style="font-weight: bold;">OPERATE AS YOUR OWN WASHER</h5>
                                <p class="mb-0">Operate your own washer through SUDS-2-U. You set your own hours, decide your own pricing and can operate in any city SUDS-2-U are serving.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <div class="d-flex justify-content-center align-items-center p-4">
                                <img src="{{url('public/website/images/img/250720170400.jpg')}}" class="card-img-top d-block mx-auto ">
                            </div>
                            <div class="card-body">
                                <h5 class="text-uppercase" style="font-weight: bold;">MAKE YOUR OWN HOURS</h5>
                                <p class="mb-0">Work your own schedule and set your own hours. Work your own clients from the scheduler or just turn go online and let us send you clients.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <div class="d-flex justify-content-center align-items-center p-4">
                                <img src="{{url('public/website/images/img/mobile-car-washing-service.jpg')}}" class="card-img-top d-block mx-auto ">
                            </div>
                            <div class="card-body">
                                <h5 class="text-uppercase" style="font-weight: bold;">DAILY PAYOUTS</h5>
                                <p class="mb-0">All payments are automatically accepted through the app. Then are deposited into your bank account. Get paid within 24hrs. And you always keep your tips!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- IT PAYS SECTION END -->


        <!-- STORIES SLIDER START -->
        <section class="stories_slider_section px-3 px-md-0">
            <h1 class="text-center text-uppercase mb-4 col-lg-8 mx-auto"><span class="font-weight-lighter">Real</span> <span style="font-weight: 900; color: var(--mainColor);">Stories</span></h1>
            <p class="text-center mb-5 col-lg-8 mx-auto">SUDS-2-U Words</p>
            <div class="swiper-container coverflowEffect container px-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card">
                            <img src="{{url('public/website/images/img/mobile-detailing-south-jersey.jpg')}}" class="card-img-top">
                            <div class="card-body">
                                <p>I love the options SUDS-2-U gives me as a professional washer. I make my own hours and get paid fast! It gives the freedom to maintain my regular customers and service new ones all through the app! </p>
                                <a href="#" class="text-decoration-none text-uppercase">Chris B. Texas</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card">
                            <img src="{{url('public/website/images/img/Thinkstock.jpg')}}" class="card-img-top">
                            <div class="card-body">
                                <p>I work full time at another job, but with SUDS-2-U they give me the opportunity to work nights and weekends to make more money. I love the fact that I can supplement my income with SUDS-2-U.</p>
                                <a href="#" class="text-decoration-none text-uppercase">Ax V. Texas</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card">
                            <img src="{{url('public/website/images/stock-images/banner-4.jpg')}}" class="card-img-top">
                            <div class="card-body">
                                <p>I love not having to juggle my busy schedule with phone calls and text. SUDS-2-U does all my scheduling for me. And, when I have some free time I go online to service new customers! Its that easy!</p>
                                <a href="#" class="text-decoration-none text-uppercase">Cassie M. Texas</a>
                            </div>
                        </div>
                    </div>
                    <!--<div class="swiper-slide">-->
                    <!--    <div class="card">-->
                    <!--        <img src="{{url('public/website/images/stock-images/banner-5.jpg')}}" class="card-img-top">-->
                    <!--        <div class="card-body">-->
                    <!--            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->
                    <!--            <a href="#" class="text-decoration-none text-uppercase">Dave, Age 19 Miami, Fl</a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="swiper-slide">-->
                    <!--    <div class="card">-->
                    <!--        <img src="{{url('public/website/images/stock-images/banner-6.jpg')}}" class="card-img-top">-->
                    <!--        <div class="card-body">-->
                    <!--            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->
                    <!--            <a href="#" class="text-decoration-none text-uppercase">Matteo, Age 25 Los Angeles</a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <!-- ADD ARROWS -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- ADD PAGINATIONS -->
                <div class="swiper-pagination"></div>
            </div>

            <!-- FIND CITY MODAL START -->
            <div class="modal fade" id="findCity">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- MODAL BODY -->
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h1 class="text-uppercase mb-3"><span class="font-weight-lighter">Join</span><br> <span style="font-weight: 900; color: var(--mainColor);">Our Mailing List</span></h1>
                            <p class="mb-5">We’re expanding quickly! We’ll let you know when we arrive in your area.</p>

                            <form action="">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Your Email Address">
                                </div>
                            </form>
                        </div>

                        <!-- MODAL FOOTER -->
                        <div class="modal-footer">
                            <button type="button" class="btn customBtnDark my-0 mr-2" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn customBtn my-0 ml-2">Keep Me Posted</button>                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIND CITY MODAL CLOSE -->
        </section>
        <!-- STORIES SLIDER END -->

        <!-- JOIN THE NETWORK SECTION START -->
        <section class="join_the_network_section">
            <div class="row mx-0">
                <div class="col-md-6 px-0">
                    <div class="d-flex flex-column justify-content-center align-items-start p-5 h-100" style="background-color: var(--mainColor);">
                        <h1 class="text-uppercase mb-4 mt-5"><span class="font-weight-lighter">BECOME A PARTNER</span><br> <span style="font-weight: 900; color: var(--white);">START TODAY</span></h1>
                        <h5 class="mb-3">Join the SUDS-2-U partnership program and start working your own hours and being your own boss</h5>
                        <!--<h5 class="mb-5">Learn the basics or get certified in advanced detailing techniques.</h5>-->
                    </div>
                </div>

                <div class="col-md-6 px-0">
                    <div class="join_the_network_btn_box h-100">
                        <a href="javascript:void(0);" class="btn customBtn btn-lg signuptoday">Sign up today <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- JOIN THE NETWORK SECTION END -->
    </main>
    <!-- MAIN SECTION END -->
<style>
   .shadow .d-flex.justify-content-center.align-items-center.p-4 img{
    
        min-height: 225px;
}

</style>
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
    left: 14%;
    transform: translateX(-50%);
    width: 273px;
    background: #ffffff;
    box-shadow: 1px 2px 8px -4px #000;
    /* border: 1px solid #999; */
    padding: 8px 0;
    z-index: 999;
    /* height: 266px; */
    overflow-y: auto;
    margin-left: 100px;
}

.dumpSearch a {
    display: block;
    color: #000;
    font-size: 15px;
    padding: 8px 20px;
}
</style>
   @endsection