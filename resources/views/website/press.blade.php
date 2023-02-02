@extends('website.layout.main')
@section('main-content')


    <!-- MAIN SECTION START -->
    <main class="container-fluid px-0">
        <!-- ORDER ON SITE SECTION START -->
        <section class="order_on_site_section px-3 px-md-0">
            <!-- <h3 class="text-center text-uppercase mb-4 col-lg-8 mx-auto"><span class="font-weight-lighter">Order </span> <span style="font-weight: 900; color: var(--mainColor);">SUDS-2-U</span> <span class="font-weight-lighter">ON-SITE TODAY AT YOUR WORK SITE, OFFICE, BUILDING OR HOME!<br> LET SUDS-2-U SEND OVER A PROFFESIONAL WASHER FOR ALL YOUR NEEDS</span></h3>
            <p class="text-center mb-5 col-lg-8 mx-auto">Order SUDS-2-U On-site 7 days a week, to your office, work site, building or home. <br>We have specialized pricing for businesses that will save you money by buying in bulk. Let us come take care of all your on-site washing needs!</p> -->

            <h3 class="text-center text-uppercase mb-4 col-lg-8 mx-auto"><span class="font-weight-lighter">Get a </span> <span style="font-weight: 900; color: var(--mainColor);">SUDS-2-U</span> <span class="font-weight-lighter"> Business/Fleet account today and let us come to you and wash your fleet!&nbsp;We wash your entire fleets from just one truck to 50, including cars and trucks, tractor trailers and Box vehicles.&nbsp;Let <span style="font-weight: 900; color: var(--mainColor);">Suds-2-u </span>come wash your Fleet at a time that is convenient for you.<br> Register your business and we will contact you to complete the registration. </span></h3>
            <p class="text-center mb-5 col-lg-8 mx-auto">Come sign up today! And remember we take Credit and Fleet cards! Get your account today!</p>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div id="successmsg"></div>
                        <form  class="mx-n3 mx-md-0" id="pressid" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Company Name" style="min-height: 48px;" name="company_name" id="company_name">
                                    </div>
                                    <span class="text-danger error-text company_name_err"></span>


                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="First Name" style="min-height: 48px;" name="first_name" id="first_name">
                                    </div>
                                    <span class="text-danger error-text first_name_err"></span>
                                    

                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Last Name" style="min-height: 48px;" name="last_name" id="last_name">
                                    </div>
                                     <span class="text-danger error-text last_name_err"></span>

                               
                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Phone Number" style="min-height: 48px;" id="phone_number" name="phone_number">
                                    </div>
                                    <span class="text-danger error-text phone_number_err"></span>


                                     <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email" style="min-height: 48px;" name="email" id="email">
                                    </div>
                                    <span class="text-danger error-text email_err"></span>

                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </span>
                                        </div>                            
                                      <select name="how_many" id="how_many" class="form-control" style="min-height: 48px;" >
                                          <option value="">How Many Vehicles</option>
                                          <option value="1-10">1-10</option>
                                          <option value="11-20">11-20</option>
                                          <option value="21-30">21-30</option>
                                          <option value="31-40">31-40</option>
                                          <option value="41+">41+</option>
                                      </select>
                                    </div>
                                    <span class="text-danger error-text how_many_err"></span>                    
                                   
                                </div>
                                
                                <div class="col-md-6">

                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </span>
                                        </div>  
                                         <input type="text" class="form-control" placeholder="Address" style="min-height: 48px;" name="address" id="address">
                                      
                                    </div>
                                    <span class="text-danger error-text address_err"></span>
                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-city"></i>
                                            </span>
                                        </div>
                                       
                                        <select class="form-control" placeholder="State" style="min-height: 48px;" name="state" id="state">
                                            <option value="">Select State</option>
                                            @if(!empty($state))
                                            @foreach($state as $rows)
                                            <option value="{{$rows['id']}}">{{$rows['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                     <span class="text-danger error-text state_err"></span>


                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-city"></i>
                                            </span>
                                        </div>

                                        <select class="form-control" placeholder="City" style="min-height: 48px;" name="city" id="city">
                                            <option value="">Select City</option>
                                            
                                        </select>
                                    </div>
                                    <span class="text-danger error-text city_err"></span> 

                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-city"></i>
                                            </span>
                                        </div>

                                         <input type="text" class="form-control" placeholder="Zip code" style="min-height: 48px;" name="zip_code" id="zip_code">
                                    </div>
                                    <span class="text-danger error-text zip_code_err"></span> 


                                      <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </span>
                                        </div>                            
                                      <select name="payment_method" id="payment_method" class="form-control" style="min-height: 48px;" >
                                          <option value="">Payment Method</option>
                                          <option value="CC_Payment">CC Payment</option>
                                          <option value="PayPal">PayPal</option>
                                          <option value="Fleet_Card">Fleet Card</option>
                                          
                                      </select>
                                    </div>
                                    <span class="text-danger error-text payment_method_err"></span>   


                                    <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </span>
                                        </div>                            
                                        <select class="form-control" style="min-height: 48px;" name="property_type" id="property_type">
                                            <option selected disabled value="">Property Type</option>
                                            <option value="Residential">Residential</option>
                                            <option value="Commercial">Commercial</option>
                                        </select>
                                    </div>
                                    <span class="text-danger error-text property_type_err"></span>
                                     
                                   
                                   <!--  <div class="input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </span>
                                        </div>                            
                                      <select name="type_of_wash" id="type_of_wash" class="form-control" style="min-height: 48px;" >
                                          
                                          <option value="">Select Wash Type</option>
                                          @if(!empty($category))
                                          @foreach($category as $typerow)
                                          <option value="{{$typerow->category_id}}">{{$typerow->category_name}}</option>
                                          @endforeach
                                          @endif    
                                      </select>
                                    </div>
                                    <span class="text-danger error-text type_of_wash_err"></span> -->
                                    
                                    
                                </div>
                              
                                <div class="col-12">
                                    <button type="button" class="btn customBtn btn-lg btn-block submitpressrequest">Submit</button>
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- ORDER ON SITE SECTION END -->
    </main>
    <!-- MAIN SECTION END -->
@endsection

 