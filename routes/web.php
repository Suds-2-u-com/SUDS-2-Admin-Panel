<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//      return view('Home/index');
//      //return view('login');
// });
Route::get('/','HomeController@index');

Route::get('/Admin-Login', 'LoginController@index');

Route::get('Admin-Login','LoginController@index');
Route::post('login','LoginController@login');
Route::get('login','LoginController@index');
Route::get('Dashboard','LoginController@dashboard');
Route::get('logout','LoginController@logout');
Route::get('Profile','LoginController@profile');
Route::post('accountSetting/{id}','LoginController@updateAccountSetting');
Route::get('Change-Password','LoginController@changePassword');
Route::post('Change-Password-Frm/{id}','LoginController@ChangePasswordFrm');
Route::get('Washer-List','UserController@userList');
Route::post('delete-user','UserController@deleteUser');
Route::post('changestatus','UserController@changestatus');
Route::get('Customer-List','UserController@customerList');
Route::post('show-details','UserController@showDetails');
Route::post('show-bank-details','UserController@showBankDetails');
Route::post('show-document-details','UserController@showDocumentDetails');
Route::post('show-vehicle-details','UserController@showVehicleDetails');
Route::get('Packages-List','PackageController@index');
Route::post('create-package','PackageController@store');
Route::post('delete-entry','PackageController@deleteEntry');
Route::post('edit-package','PackageController@edit');
Route::post('edit-package/{id}','PackageController@update');
Route::get('Add-ONS-List','AddONSController@index');
Route::post('create-add-ons','AddONSController@store');
Route::post('edit-addons','AddONSController@edit');
Route::post('edit-add-ons/{id}','AddONSController@update');
Route::get('Booking-List','BookingController@index');
Route::post('show-booking','BookingController@show');
Route::get('Category-List','CategoryController@index');
Route::post('create-category','CategoryController@store');
Route::post('edit-category','CategoryController@edit');
Route::post('edit-category-frm/{id}','CategoryController@update');
Route::get('Distance','SettingController@index');
Route::post('create-distance','SettingController@store');
Route::post('edit-distance','SettingController@edit');
Route::post('update-distance/{id}','SettingController@update');
Route::get('Extra-Minutes-Hours','ExtraMinHoursController@index');
Route::post('create-minhours','ExtraMinHoursController@store');
Route::post('edit-extra-minhours','ExtraMinHoursController@edit');
Route::post('update-minhours/{id}','ExtraMinHoursController@update');
Route::post('sub-category','CategoryController@getSubCategory');
Route::post('addons','AddONSController@addons');
Route::get('WasherReviewlist/{id}','UserController@review');
Route::get('CustomerReviewlist/{id}','UserController@review');
Route::get('WasherReviewlist/{id}','UserController@review');
Route::get('CustomerReviewlist/{id}','UserController@review');
Route::get('Booking-Transactions','TransactionsController@index');

Route::post('show-showPayform-details','TransactionsController@showPayDetails');

Route::post('payamount/{id}','TransactionsController@payamount');


Route::get('Country','CountryController@index');
Route::get('State','StateController@index');
Route::get('City','CityController@index');
Route::post('create-country','CountryController@store');
Route::post('edit-country','CountryController@edit');
Route::post('update-country/{id}','CountryController@update');
Route::post('create-state','StateController@store');
Route::post('edit-states','StateController@edit');
Route::post('update-state/{id}','StateController@update');
Route::post('create-city','CityController@store');
Route::post('edit-city','CityController@edit');
Route::post('update-city/{id}','CityController@update');



Route::post('show-payout','TransactionsController@showPayout');
Route::post('show-payout-create','TransactionsController@showPayoutCreate');
Route::post('createAccount/{id}','TransactionsController@createAccount');
Route::post('payment-done','TransactionsController@paymentDone');
Route::get('Payout-Transactions','TransactionsController@payOutTransaction');


Route::get('Requests','RequestController@index');
Route::post('edit-requests','RequestController@edit');
Route::post('update-requests/{id}','RequestController@update');
Route::get('App-Request','RequestController@appRequest');
Route::get('On-Site-Request','RequestController@onSiteRequest');
Route::post('edit-On-Site-Request','RequestController@editOnSiteRequest');
Route::post('update-On-Site-Request/{id}','RequestController@updateOnSiteRequest');
Route::post('viewDetailsOnSiteRequest','RequestController@viewDetailsOnSiteRequest');
Route::get('Press-Request','RequestController@pressRequest');
Route::post('edit-Press-Request','RequestController@editPressRequest');
Route::post('update-Press-Request/{id}','RequestController@updatePressRequest');

Route::get('Home','HomeController@index');
Route::get('Get-An-App','HomeController@getAnApp');
Route::get('Order-On-Site','HomeController@orderOnSite');
Route::get('Cities','HomeController@cities');
Route::get('Faq','HomeController@faq');
Route::get('Blog','HomeController@blog');
Route::get('blog-details','HomeController@blogDetails');
Route::get('news','HomeController@newDetails');
//Route::get('Press','HomeController@Press');
Route::get('Business-Fleet','HomeController@Press');
Route::get('become-a-washer','HomeController@becomeAWasher');
Route::post('show-payout','TransactionsController@showPayoutTransaction');
Route::post('add-payout','TransactionsController@addPayout');

Route::post('request-send','HomeController@requestSend');
Route::post('cityy','HomeController@city');
Route::post('app-request-send','HomeController@appRequestSend');
Route::post('state','HomeController@state');
Route::post('on-site-request','HomeController@onSiteRequest');
Route::post('add-become-a-washer','HomeController@addBecomeAWasher');
Route::post('add-press-request','HomeController@addPressRequest');
Route::get('forget-password/{id}','ApicustomerController@forgetpassword');
Route::post('save-forget-Password','ApicustomerController@updateforgetpassword');
Route::get('forget-password-success','ApicustomerController@successmsg');

Route::get('mail',function(){

  $data=array('to_name'=>'eedt','to_email'=>'sameerbangkok12@yopmail.com','messages'=>'hello','title'=>'SUDS-2-U.COM');
  $to_name='eedt';
  $to_email='sameerbangkok12@yopmail.com';
  $subject='demo';

                   
                    \Mail::send('mail.usermessage', $data, function($message)use($to_name, $to_email,$subject) {
                    $message->to($to_email, $to_email)
                            ->subject($subject);        
                            
                   });
        // $data["email"] = "nehawagh5@gmail.com";
        // $data["title"] = "From ItSolutionStuff.com";
        // $data["body"] = "This is Demo";
 
        // $files = [
        //     public_path('mail/1631340351.pdf'),
        //     public_path('mail/1631340262.jpg'),
        // ];
  
        // Mail::send('mail.usermessage', $data, function($message)use($data, $files) {
        //     $message->to($data["email"], $data["email"])
        //             ->subject($data["title"]);
 
        //     foreach ($files as $file){
        //         $message->attach($file);
        //     }
            
        // });
 
         dd('Mail sent successfully');
});



Route::post('accept-entry','PackageController@acceptEntry');

Route::post('accept-reject','PackageController@acceptReject');
Route::get('Roles','UserController@roles');
Route::get('Roles1','UserController@roles1');
Route::post('create-role','UserController@createRole');
Route::post('editrole','UserController@editrole');
Route::post('editrolefrm','UserController@editrolefrm');

Route::get('send_mail','UserController@sendMail');
Route::get('sent_mail','UserController@sentMail');
Route::post('send_mail_frm','UserController@send_mail_frm');

Route::get('sent_mail','UserController@sentMail');
Route::get('sent_mail_washer','UserController@sentMailWasher');
Route::get('pay','PaymentController@index');
Route::post('transaction', 'PaymentController@makePayment')->name('make-payment');
Route::post('city','CityController@cities');
Route::post('city-inquiry', 'CityController@cityInquiry');

Route::post('submitmail','HomeController@submitmail');

Route::get('mailing-list','UserController@mailingList');
Route::get('second',function(){
    echo gmdate("H:i:s", 60000);
});

Route::get('Promotions','UserController@promotions');
Route::post('create-promotions','UserController@createPromotions');
Route::post('edit-promotion','UserController@editPromotions');
Route::post('update-promotions','UserController@updatePromotions');
Route::post('google','HomeController@search');
Route::get('percentage-adjustable','BookingController@percentageAdjustable');
Route::post('add-percentage','BookingController@addPercentage');
Route::get('On-Demand-Packages-List','PackageController@onDemandPackage');
Route::post('add-user-package','PackageController@addUserPackage');
Route::post('edit-user-package','PackageController@editUserPackage');
Route::post('edit-user-package-frm/{id}','PackageController@editUserPackageFrm');
Route::get('washer-mailing-list','UserController@washerMalingList');
Route::get('free_washes','UserController@freeWashes');
Route::get('drag','UserController@drag');
Route::post('viewrequestwasher','RequestController@viewRequest');
Route::get('setStatus','ApiController@setStatus');
Route::post('adjustpersentage','BookingController@adjustpersentage');

Route::get('Service','BookingController@service');
Route::post('create-service','BookingController@createService');
Route::post('editservice','BookingController@editservice');
Route::post('edit-service/{id}','BookingController@editservicefrm');

Route::post('edit-service/{id}','BookingController@editservicefrm');

Route::post('create-customer','UserController@createCustomer');
Route::post('update-customer-details','UserController@updateCustomerDetails');

Route::post('show-details-basic','UserController@showbasicDetails');
Route::post('edit-user','UserController@editUser');
Route::post('update-customer/{id}','UserController@editUserfrm');
Route::post('edit-washer','UserController@editWasher');
Route::post('update-washer/{id}','UserController@editWasherfrm');
Route::post('show-background','UserController@showBackground');
Route::post('show_vehicle_insurance','UserController@showVehicleInsurance');
Route::post('show_vehicle_registration','UserController@showVehicleRegistration');
Route::get('coupon','CouponController@index');
Route::post('edit-coupon-show','CouponController@editCouponShow');
Route::post('update-coupon/{id}','CouponController@updateCoupon');
Route::post('create-coupon','CouponController@addCoupon');

Route::post('edit-showpermission','UserController@editShowPermission');
Route::post('permission-settings','UserController@permissionSettings');

Route::post('chnageBackgroupStatus','UserController@chnageBackgroupStatus');
Route::post('changeVehicleInsurStatus','UserController@changeVehicleInsurStatus');
Route::post('changeVehicleRegStatus','UserController@changeVehicleRegStatus');
// view-add-ons"
Route::post('view-add-ons','AddONSController@viewAddOns');
Route::get('checkExpDateDocument', 'UserController@checkExpDateDocument');

Route::get('Washer-Earning-List', 'UserController@washerEarning');
// showBookingDetails
Route::post('showBookingDetails', 'UserController@showBookingDetails');
// showPackages
Route::post('showPackages', 'PackageController@showPackages');

Route::get('Radius', 'SettingController@radius');
Route::post('create-radius', 'SettingController@radiusAdd');
Route::post('update-radius/{id}', 'SettingController@radiusUpdate');
Route::post('edit-radius', 'SettingController@radiusGet');
Route::post('delete-radius', 'SettingController@radiusDelete');

Route::post('changeCitiesStatus', 'CityController@changeCitiesStatus');

// 
Route::get('Washer-Cities', 'CityController@washerCities');

Route::get('api/cronBookingNotification','ApiController@cronBookingNotification');
Route::get('api/payoutCron','ApiController@payoutCron');
