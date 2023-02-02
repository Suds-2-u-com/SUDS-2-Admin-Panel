 

<form method="post" action="{{url('permission-settings')}}">

     @csrf
   <input type="hidden" name="id" id="id" value="{{$id}}">
 @if(!empty($permission))

<?php 

 
if(!is_null(json_decode($permission->permission_settings))){ 
    $pers=json_decode($permission->permission_settings);
?>    


 
<ul class="list-group">
    <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">State</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--<label class="form-check-label" for="flexCheckDefault">-->
                    <!--<input class="form-check-input" type="checkbox" value="add_state" id="add_state" name="setting[]"  >-->
                    
                    <!--Add &nbsp;-->
                    <!--</label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--<label class="form-check-label" for="flexCheckDefault">-->
                    <!--<input class="form-check-input" type="checkbox" value="update_state" id="update_state" name="setting[]"  >-->
                    
                    <!--Update &nbsp;-->
                    <!--</label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--<label class="form-check-label" for="flexCheckChecked">-->
                    <!--<input class="form-check-input" type="checkbox" value="delete_state" id="delete_delete" name="setting[]"  >-->
                    
                    <!--Delete &nbsp;-->
                    <!--</label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                    <label class="form-check-label" for="flexCheckChecked">
                    <input class="form-check-input" type="checkbox" value="view_state" id="view_state" name="setting[]"  <?php if(in_array("view_state", $pers)){ echo 'checked'; }  ?>>
                    
                    View &nbsp;
                    </label> 
                    </div>
                </div>
            </div>
        </div>
    </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">City</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_city" id="add_city" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_city" id="update_city" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_city" id="delete_city" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_city" id="view_city" name="setting[]"  <?php if(in_array("view_city", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Promotions</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_Promotions" id="add_Promotions" name="setting[]" >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_Promotions" id="update_Promotions" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_Promotions" id="delete_Promotions" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_Promotions" id="view_Promotions" name="setting[]"  <?php if(in_array("view_Promotions", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Coupon</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_coupon" id="add_coupon" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_coupon" id="update_coupon" name="setting[]" >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_coupon" id="delete_coupon" name="setting[]" >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_coupon" id="view_coupon" name="setting[]"  <?php if(in_array("view_coupon", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Washer</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_washer" id="delete_washer" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_washer" id="view_washer" name="setting[]"  <?php if(in_array("view_washer", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_document" id="view_washer" name="setting[]"  >-->
                     
                    <!--    View Document &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_document" id="view_washer" name="setting[]"  >-->
                     
                    <!--    View Document &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_bank_info" id="view_bank_info" name="setting[]" >-->
                     
                    <!--    View Bank Info &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_review" id="view_review" name="setting[]"  >-->
                     
                    <!--    View Review &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_pay_out" id="view_pay_out" name="setting[]" >-->
                     
                    <!--    View Pay Out &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_percentage" id="view_percentage" name="setting[]"  >-->
                     
                    <!--    View Percentage Adjustable &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_background_check" id="view_background_check" name="setting[]"  >-->
                     
                    <!--    View Background Check &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_vehicle_insurance" id="view_vehicle_insurance" name="setting[]" >-->
                     
                    <!--    View Vehicle Insurance&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_vehicle_registration" id="view_vehicle_registration" name="setting[]"  >-->
                     
                    <!--   Vehicle Registraion&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->

                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Customer</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_customer" id="add_customer" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_customer" id="update_customer" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_customer" id="delete_customer" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_customer" id="view_customer" name="setting[]"  <?php if(in_array("view_customer", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_vehicle" id="view_vehicle" name="setting[]"  >-->
                     
                    <!--    View Vehicle&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_review" id="view_review" name="setting[]"  >-->
                     
                    <!--    View Review&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_extra_details" id="update_extra_details" name="setting[]"  >-->
                     
                    <!--    Update Extra Profile Details&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Wash Type</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_washtype" id="add_washtype" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_washtype" id="update_washtype" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_washtype" id="delete_washtype" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_washtype" id="view_washtype" name="setting[]"  <?php if(in_array("view_washtype", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Add Ons</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_addons" id="add_addons" name="setting[]" >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_addons" id="update_addons" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_addons" id="delete_addons" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_addons" id="view_addons" name="setting[]"  <?php if(in_array("view_addons", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Package</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_package" id="add_package" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_package" id="update_package" name="setting[]" >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_package" id="delete_package" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_package" id="view_package" name="setting[]"  <?php if(in_array("view_package", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
     
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Requests</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_request" id="view_request" name="setting[]"  <?php if(in_array("view_request", $pers)){ echo 'checked'; }  ?>>
                      
                        view &nbsp;
                      </label>
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">App-Request</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_app_rquest" id="view_app_rquest" name="setting[]"  <?php if(in_array("view_app_rquest", $pers)){ echo 'checked'; }  ?>>
                      
                        view &nbsp;
                      </label>
                    </div>
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_app_rquest" id="delete_app_rquest" name="setting[]" >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">On-Site-Request</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_on_site_request" id="view_on_site_request" name="setting[]"  <?php if(in_array("view_on_site_request", $pers)){ echo 'checked'; }  ?>>
                      
                        view &nbsp;
                      </label>
                    </div>
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_on_site_request" id="delete_on_site_request" name="setting[]" >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Press-Request</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_press_request" id="view_press_request" name="setting[]"  <?php if(in_array("view_press_request", $pers)){ echo 'checked'; }  ?>>
                      
                        view &nbsp;
                      </label>
                    </div>
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_press_request" id="delete_press_request" name="setting[]"  >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Job Mailing list </div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_job_mailing" id="view_job_mailing" name="setting[]"  <?php if(in_array("view_job_mailing", $pers)){ echo 'checked'; }  ?>>
                      
                        view &nbsp;
                      </label>
                    </div>
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_view_job_mailing" id="delete_view_job_mailing" name="setting[]" >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Distance</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--      <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--      <input class="form-check-input" type="checkbox" value="add_distance" id="add_distance" name="setting[]"  >-->
                          
                    <!--        Add &nbsp;-->
                    <!--      </label>-->
                    <!--    </div>-->
                    <!--    <div class="form-check mr-3">-->
                    <!--      <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--      <input class="form-check-input" type="checkbox" value="update_distance" id="update_distance" name="setting[]" >-->
                          
                    <!--        Update &nbsp;-->
                    <!--      </label>-->
                    <!--    </div>-->
                        
                        
                    <!--    <div class="form-check mr-3">-->
                    <!--      <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--      <input class="form-check-input" type="checkbox" value="delete_distance" id="delete_distance" name="setting[]"  >-->
                          
                    <!--        Delete &nbsp;-->
                    <!--      </label>-->
                    <!--    </div>-->
                        <div class="form-check mr-3">
                           <label class="form-check-lable" for="flexCheckChecked">
                          <input class="form-check-input" type="checkbox" value="view_distance" id="view_distance" name="setting[]"  <?php if(in_array("view_distance", $pers)){ echo 'checked'; }  ?>>
                         
                            View &nbsp;
                          </label> 
                        </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Free Wash </div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                  <label class="form-check-lable" for="flexCheckDefault">
                  <input class="form-check-input" type="checkbox" value="view_free_wash" id="view_free_wash" name="setting[]"  <?php if(in_array("view_free_wash", $pers)){ echo 'checked'; }  ?>>
                  
                    view &nbsp;
                  </label>
                </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Extra Time</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_extra_time" id="add_extra_time" name="setting[]" >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_extra_time" id="update_extra_time" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_extra_time" id="delete_extra_time" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_extra_time" id="view_distance" name="setting[]"  <?php if(in_array("view_distance", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Service</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_service" id="add_service" name="setting[]" >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_service" id="update_service" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_service" id="delete_service" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_service" id="view_service" name="setting[]"  <?php if(in_array("view_service", $pers)){ echo 'checked'; }  ?>>
                     
                        View &nbsp;
                      </label> 
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </li>
</ul>
<?php }else{ ?>

<ul class="list-group">
    <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">State</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--<label class="form-check-label" for="flexCheckDefault">-->
                    <!--<input class="form-check-input" type="checkbox" value="add_state" id="add_state" name="setting[]"  >-->
                    
                    <!--Add &nbsp;-->
                    <!--</label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--<label class="form-check-label" for="flexCheckDefault">-->
                    <!--<input class="form-check-input" type="checkbox" value="update_state" id="update_state" name="setting[]"  >-->
                    
                    <!--Update &nbsp;-->
                    <!--</label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--<label class="form-check-label" for="flexCheckChecked">-->
                    <!--<input class="form-check-input" type="checkbox" value="delete_state" id="delete_delete" name="setting[]"  >-->
                    
                    <!--Delete &nbsp;-->
                    <!--</label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                    <label class="form-check-label" for="flexCheckChecked">
                    <input class="form-check-input" type="checkbox" value="view_state" id="view_state" name="setting[]"  >
                    
                    View &nbsp;
                    </label> 
                    </div>
                </div>
            </div>
        </div>
    </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">City</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_city" id="add_city" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_city" id="update_city" name="setting[]" >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_city" id="delete_city" name="setting[]" >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_city" id="view_city" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Promotions</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_Promotions" id="add_Promotions" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_Promotions" id="update_Promotions" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_Promotions" id="delete_Promotions" name="setting[]" >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_Promotions" id="view_Promotions" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Coupon</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_coupon" id="add_coupon" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_coupon" id="update_coupon" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_coupon" id="delete_coupon" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_coupon" id="view_coupon" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Washer</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_washer" id="delete_washer" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_washer" id="view_washer" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_document" id="view_washer" name="setting[]" >-->
                     
                    <!--    View Document &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_document" id="view_washer" name="setting[]"  >-->
                     
                    <!--    View Document &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_bank_info" id="view_bank_info" name="setting[]" >-->
                     
                    <!--    View Bank Info &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_review" id="view_review" name="setting[]" >-->
                     
                    <!--    View Review &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_pay_out" id="view_pay_out" name="setting[]" >-->
                     
                    <!--    View Pay Out &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_percentage" id="view_percentage" name="setting[]" >-->
                     
                    <!--    View Percentage Adjustable &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_background_check" id="view_background_check" name="setting[]" >-->
                     
                    <!--    View Background Check &nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_vehicle_insurance" id="view_vehicle_insurance" name="setting[]"  >-->
                     
                    <!--    View Vehicle Insurance&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_vehicle_registration" id="view_vehicle_registration" name="setting[]" >-->
                     
                    <!--   Vehicle Registraion&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->

                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Customer</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_customer" id="add_customer" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_customer" id="update_customer" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_customer" id="delete_customer" name="setting[]" >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_customer" id="view_customer" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_vehicle" id="view_vehicle" name="setting[]" >-->
                     
                    <!--    View Vehicle&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="view_review" id="view_review" name="setting[]"  >-->
                     
                    <!--    View Review&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--   <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_extra_details" id="update_extra_details" name="setting[]"  >-->
                     
                    <!--    Update Extra Profile Details&nbsp;-->
                    <!--  </label> -->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Wash Type</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_washtype" id="add_washtype" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_washtype" id="update_washtype" name="setting[]" >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_washtype" id="delete_washtype" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_washtype" id="view_washtype" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Add Ons</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_addons" id="add_addons" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_addons" id="update_addons" name="setting[]" >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_addons" id="delete_addons" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_addons" id="view_addons" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Package</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_package" id="add_package" name="setting[]" >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_package" id="update_package" name="setting[]" >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_package" id="delete_package" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_package" id="view_package" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <!--<li class="list-group-item px-0">-->
        <!--<div class="row mx-0">-->
        <!--    <div class="col-sm-3">Booking</div>-->
        
        <!--    <div class="col-sm">-->
        <!--        <div class="d-flex justify-content-start flex-wrap">-->
        <!--            <div class="form-check mr-3">-->
        <!--              <label class="form-check-lable" for="flexCheckDefault">-->
        <!--              <input class="form-check-input" type="checkbox" value="view_booking" id="view_booking" name="setting[]" >-->
                      
        <!--                view &nbsp;-->
        <!--              </label>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    </div>-->
        <!--</li>-->
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Requests</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_request" id="view_request" name="setting[]" >
                      
                        view &nbsp;
                      </label>
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">App-Request</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_app_rquest" id="view_app_rquest" name="setting[]"  >
                      
                        view &nbsp;
                      </label>
                    </div>
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_app_rquest" id="delete_app_rquest" name="setting[]"  >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">On-Site-Request</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_on_site_request" id="view_on_site_request" name="setting[]"  >
                      
                        view &nbsp;
                      </label>
                    </div>
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_on_site_request" id="delete_on_site_request" name="setting[]"  >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Press-Request</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_press_request" id="view_press_request" name="setting[]"  >
                      
                        view &nbsp;
                      </label>
                    </div>
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_press_request" id="delete_press_request" name="setting[]"  >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Job Mailing list </div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                      <label class="form-check-lable" for="flexCheckDefault">
                      <input class="form-check-input" type="checkbox" value="view_job_mailing" id="view_job_mailing" name="setting[]" >
                      
                        view &nbsp;
                      </label>
                    </div>
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_view_job_mailing" id="delete_view_job_mailing" name="setting[]"  >-->
                      
                    <!--    delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Distance</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--      <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--      <input class="form-check-input" type="checkbox" value="add_distance" id="add_distance" name="setting[]"  >-->
                          
                    <!--        Add &nbsp;-->
                    <!--      </label>-->
                    <!--    </div>-->
                    <!--    <div class="form-check mr-3">-->
                    <!--      <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--      <input class="form-check-input" type="checkbox" value="update_distance" id="update_distance" name="setting[]"  >-->
                          
                    <!--        Update &nbsp;-->
                    <!--      </label>-->
                    <!--    </div>-->
                        
                        
                    <!--    <div class="form-check mr-3">-->
                    <!--      <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--      <input class="form-check-input" type="checkbox" value="delete_distance" id="delete_distance" name="setting[]"   >-->
                          
                    <!--        Delete &nbsp;-->
                    <!--      </label>-->
                    <!--    </div>-->
                        <div class="form-check mr-3">
                           <label class="form-check-lable" for="flexCheckChecked">
                          <input class="form-check-input" type="checkbox" value="view_distance" id="view_distance" name="setting[]" >
                         
                            View &nbsp;
                          </label> 
                        </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Free Wash </div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <div class="form-check mr-3">
                  <label class="form-check-lable" for="flexCheckDefault">
                  <input class="form-check-input" type="checkbox" value="view_free_wash" id="view_free_wash" name="setting[]" >
                  
                    view &nbsp;
                  </label>
                </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Extra Time</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_extra_time" id="add_extra_time" name="setting[]"  >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_extra_time" id="update_extra_time" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_extra_time" id="delete_extra_time" name="setting[]" >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_extra_time" id="view_distance" name="setting[]"  >
                     
                        View &nbsp;
                      </label> 
                    </div>
                </div>
            </div>
            </div>
        </li>
        <li class="list-group-item px-0">
        <div class="row mx-0">
            <div class="col-sm-3">Service</div>
        
            <div class="col-sm">
                <div class="d-flex justify-content-start flex-wrap">
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="add_service" id="add_service" name="setting[]" >-->
                      
                    <!--    Add &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckDefault">-->
                    <!--  <input class="form-check-input" type="checkbox" value="update_service" id="update_service" name="setting[]"  >-->
                      
                    <!--    Update &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    
                    
                    <!--<div class="form-check mr-3">-->
                    <!--  <label class="form-check-lable" for="flexCheckChecked">-->
                    <!--  <input class="form-check-input" type="checkbox" value="delete_service" id="delete_service" name="setting[]"  >-->
                      
                    <!--    Delete &nbsp;-->
                    <!--  </label>-->
                    <!--</div>-->
                    <div class="form-check mr-3">
                       <label class="form-check-lable" for="flexCheckChecked">
                      <input class="form-check-input" type="checkbox" value="view_service" id="view_service" name="setting[]" >
                     
                        View &nbsp;
                      </label> 
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </li>
</ul>


<?php } ?>
 <button class="btn ripple btn-info" type="submit">Submit</button>
 <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
@endif
</form>