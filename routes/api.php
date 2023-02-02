<?php
$log = ['URI' => \Request::fullUrl(),'REQUEST_BODY' => \Request::all(),'HEADER' => \Request::header(),];
 \DB::table('tbl_http_logger')->insert(array('request'=>'API_CALL','header'=>json_encode($log)));
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('user','UserController@user');
Route::post('signup','ApiController@signup');
Route::post('login','ApiController@login');
Route::post('customerlogin','ApiController@customerlogin');
Route::post('termCondition','ApiController@termsCondition');
Route::post('otpVerify','ApiController@otpVerify');
Route::post('viewVehicle','ApiController@viewVehicle');
Route::post('addVehicle','ApiController@addVehicle');
Route::get('vehicleType','ApiController@vehicleType');
Route::post('category','ApiController@category');
Route::post('packages','ApiController@packages');
Route::post('addOns','ApiController@addOns');
Route::post('make','ApiController@make');
Route::get('year','ApiController@year');
Route::post('model','ApiController@model');
Route::post('resentOtp','ApiController@resentOtp');
Route::post('washerSignup','ApiController@washerSignup');
Route::post('washregistration','ApiController@washerregistration');
Route::post('userdetails','ApiController@userdetails');
Route::get('get_country','ApiController@get_country');
Route::post('get_state','ApiController@get_state');
Route::post('get_city','ApiController@get_city');
Route::post('save_complete_profile','ApiController@save_complete_profile');
Route::post('get_bank_details','ApiController@get_bank_details');

Route::post('save_bank_details','ApiController@save_bank_details');

Route::post('save_bank_details','ApiController@save_bank_details');
Route::post('change_password','ApiController@change_password');

Route::post('bookinghistory','ApiController@bookinghistory');
Route::post('newjobrequest','ApiController@newjobrequest');
Route::post('reject_job','ApiController@reject_job');
Route::post('accept_job','ApiController@accept_job');
Route::post('reviewrating_list','ApiController@reviewrating_list');
Route::post('earninglist','ApiController@earninglist');

Route::post('upload_drivinglicense','ApiController@upload_drivinglicense');
Route::post('drivinglicensedetails','ApiController@drivinglicensedetails');
Route::post('update_drivinglicense','ApiController@update_drivinglicense');
Route::get('backgroundcheck','ApiController@backgroundcheck');
Route::post('saveagree','ApiController@saveagree');
Route::post('updatepackages','ApiController@updatepackages');
Route::post('singlepackagesdetails','ApiController@singlepackagesdetails');
Route::post('singlebookingdetails','ApiController@singlebookingdetails');
Route::post('useronlinestatus','ApiController@useronlinestatus');
Route::post('updatestatus','ApiController@updatestatus');
Route::post('singlebookingdetailstest','ApiController@singlebookingdetailstest');

Route::post('push_Notification_test','ApiController@push_Notification_test');
Route::post('finishedjob','ApiController@finishedjob');

Route::post('runningjob','ApiController@runningjob');
Route::post('startjob','ApiController@startjob');
Route::post('updatecounttime','ApiController@updatecounttime');
Route::post('addMoreTime','ApiController@addMoreTime');
Route::post('documentVerify','ApiController@documentVerify');
// customerapi

Route::get('customerapi','ApicustomerController@index');
Route::post('washerpackagesdetails','ApicustomerController@washerpackagesdetails');
Route::post('vendorlist','ApicustomerController@vendorlist');
Route::post('customerbookinghistory','ApicustomerController@customerbookinghistory');

Route::post('vendordetails','ApicustomerController@vendordetails');
Route::post('viwvendorreview','ApicustomerController@viwvendorreview');
Route::post('savebooking','ApicustomerController@savebooking');

Route::post('customerrunningbooking','ApicustomerController@customerrunningbooking');

Route::post('addCard','ApicustomerController@addcard');
Route::post('updateCard','ApicustomerController@updatecard');
Route::post('getCardDetails','ApicustomerController@get_card_details');


Route::get('get_payment_type','ApicustomerController@get_payment_type');
Route::post('applycoupan','ApicustomerController@applycoupan');
Route::post('forget_password','ApicustomerController@forget_password');


Route::get('reminder','ApiController@reminder');
Route::get('todaybookinreminder','ApiController@todaybookinreminder');

Route::post('onMyWay','ApiController@onMyWay');
Route::post('updateUserPofile','ApiController@user_complete_profile');

Route::post('removeVehicle','ApiController@removeVehicle');
Route::get('categories','ApiController@categories');
Route::post('subcategory','ApiController@subcategory');
Route::post('demandPackagesDetails','ApiController@demandpackagesdetails');
Route::post('addPaypalId','ApicustomerController@addPaypalId');
Route::post('automaticallyShowVendor','ApiController@automaticallyShowVendor');
Route::post('paymentorder','ApiController@paymentorder');

Route::post('liveTracking','ApiController@liveTracking');
Route::post('rewards','ApiController@rewards');

Route::post('getWasherLocation','ApiController@getWasherLocation');

Route::post('deleteBooking','ApiController@deleteBooking');

Route::post('cancelled_job','ApiController@cancelled_job');
Route::post('getFinishedJobImage','ApiController@getFinishedJobImage');

Route::post('userImage','ApiController@userImage');
Route::post('cardDetails','ApiController@cardDetails');

Route::get('testsms','ApiController@testsms');
Route::post('getPromotions','ApiController@getPromotions');
Route::post('get_washser','ApiController@get_washser');
Route::post('sms','ApiController@sendSms');
Route::post('sendingSms','ApiController@sendingSms');
Route::post('getSms','ApiController@getSms');
Route::post('sms_msg','ApiController@sms_msg');
Route::post('oneMessage','ApiController@oneMessage');
Route::post('savebookingnew','ApiController@savebookingnew');
Route::get('distance','ApiController@distance');
Route::get('extratime','ApiController@extratime');
Route::get('service','ApiController@service');

Route::get('addCardDetails','ApiController@addCardDetails');
Route::post('getWasherCalendar','ApiController@getWasherCalendar');
Route::post('getClientSecret','ApiController@getClientSecret');
Route::post('addReviewRating','ApiController@addReviewRating');
Route::post('addBackground','ApicustomerController@addBackground');
Route::post('addVehicleInsurance','ApicustomerController@addVehicleInsurance');
Route::post('addVehicleRegistration','ApicustomerController@addVehicleRegistration');
Route::post('checkDocument','ApicustomerController@checkDocument');
Route::post('createCoupons','ApicustomerController@createCoupons');

Route::post('cancelRequest','ApiController@cancelRequestBill');
Route::get('getBackground','ApicustomerController@getBackground');
Route::get('getVehicleInsurance','ApicustomerController@getVehicleInsurance');
Route::get('getVehicleRegistration','ApicustomerController@getVehicleRegistration');

Route::post('getWasherSchedule', 'ApiController@getWasherSchedule');

Route::post('callingWasher', 'ApiController@callingWasher');
Route::post('washerUnavailableSet','ApiController@washerUnavailableSet');
Route::post('getWasherUnavailable','ApiController@getWasherUnavailable');

Route::post('wahserPayoutHistory','ApiController@wahserPayouthistory');
Route::post('accountcreatewasher','ApiController@accountcreatewasher');
Route::get('reauth/{id}','ApiController@reauth');
Route::get('return/{id}','ApiController@returndata');
