<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\AddONSModel;
use App\PackageModel;
use App\CategoryModel;
use App\UserModel;
use App\VehicleModel;
use App\SubCategoryModel;
use App\UserDetailsModel;
use App\CityModel;
use App\CountryModel;
use App\StateModel;
use App\BankModel;
use App\BookingModel;
use App\UserdocModel;
use App\UserpackagesModel;
use App\FinishedbookingModel;
use App\TransactionsModel;
use App\PromotionsModel;
use App\PayOutTransactionsModel;

use Auth;
use DB;
use Hash;
use Validator;
use Input;
use Image;
use Mail;
use Stripe;
use DateTime;
use Carbon\Carbon;


class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $AddONS;
    private $Package;
    private $Category;
    private $Vehicle;
    private $Subcategory;
    private $UserDetailsModel;
    private $CityModel;
    private $CountryModel;
    private $StateModel;
    private $BankModel;
    private $BookingModel;
    private $UserdocModel;
    private $UserpackagesModel;
    private $FinishedbookingModel;

    public function __construct(AddONSModel $AddONSModel,PackageModel $PackageModel,CategoryModel $CategoryModel,UserModel $UserModel,VehicleModel $VehicleModel,SubCategoryModel $SubCategoryModel,UserDetailsModel $UserDetailsModel,CityModel $CityModel,CountryModel $CountryModel,StateModel $StateModel,BankModel $BankModel,BookingModel $BookingModel,UserdocModel $UserdocModel,UserpackagesModel $UserpackagesModel,FinishedbookingModel $FinishedbookingModel)
    {
        $this->AddONS=new UserRepository($AddONSModel);
        $this->Package=new UserRepository($PackageModel);
        $this->Category=new UserRepository($CategoryModel);
        $this->User=new UserRepository($UserModel);
        $this->Vehicle=new UserRepository($VehicleModel);
        $this->Subcategory=new UserRepository($SubCategoryModel);
        $this->UserDetailsModel=new UserRepository($UserDetailsModel);
        $this->CityModel=new UserRepository($CityModel);
        $this->CountryModel=new UserRepository($CountryModel);
        $this->StateModel=new UserRepository($StateModel);
        $this->BankModel=new UserRepository($BankModel);
        $this->BookingModel=new UserRepository($BookingModel);
        $this->UserdocModel=new UserRepository($UserdocModel);
        $this->UserpackagesModel=new UserRepository($UserpackagesModel);
        $this->FinishedbookingModel=new UserRepository($FinishedbookingModel);

    }

    public function index()
    {
        return response()->json(['response' => trans('true'),'message' => 'success','data'=>array()]);
    }

    public function signup(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'mobile'=>'required',
            'password'=>'required',
            'device_token'=>'required',
            //'conutry_code' => 'required'
        ]);

        // return  $request->all();

        if ($validator->passes()) {
            // dd($data);
            $data = $request->except([
                '_token',
                'password'
            ]);
            $data['role_as']=3;
            $data['status']=0;
            $data['password']=Hash::make($request->input('password'));
            $data['remember_token']=$request->input('device_token');
            $data['longitude']=$request->input('longitude');
            $data['latitude']=$request->input('latitude');
            $data['api_token']=Str::random(60);
            $data['otp_verify']=0;
            $data['uploading_status']=0;
            $data['total_amount']=0;
            $data['wallet_amount']=0;

            if(count($this->User->where(array('email'=>$request->input('email'))))>0){

                return response()->json(['response' => false,'message' => 'Email id already exists','data'=>array()],400);

            }elseif(count($this->User->where(array('mobile'=>$request->input('mobile'))))>0){

                return response()->json(['response' => false,'message' => 'Mobile number already exists','data'=>array()],400);
            }else{
                
                $user=$this->User->create($data);
                if($user){
                    $datavalue=array('id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'mobile'=>$user->mobile,'role_as'=>$user->role_as,'status'=>$user->status,'api_token'=>$user->api_token);

                    $otp=rand(999,10000);
                    $to_name=$request->input('name');
                    $to_email=$request->input('email');
                    $data=array("name"=>$to_name,"body"=>"Suds",'otp'=>$otp);
                    $message='Your OTP is '.$otp;
                    Mail::send('mail.otp',$data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)
                            ->subject('Verification otp');
                    });
                    $this->sms($message,$user->mobile);
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $stripe = new \Stripe\StripeClient(
                        'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
                    );

                    $customer = \Stripe\Customer::create(
                        ['email'=>$request->input('email'),"description" => "Make add card."]
                    );
                    $this->User->update(array('secretkey'=>$customer->id),$user->id);




                    return response()->json(['response' => true,'message' => 'success','data'=>$datavalue,'otp'=>$otp,'secretkey'=>$customer->id],201);
                } else{
                    return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
                }
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function termsCondition(Request $request){

        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('id');
        $this->User->update(array('status'=>1),$id);
        return response()->json(['response'=>true,'message'=>'success'],201);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password'=>'required',
        ]);
        if ($validator->passes()) {

            $email=$request->input('email');
            $password=$request->input('password');
            $user=$this->User->get_first_records(array('email'=>$email/*,'role_as'=>2*/));

            if (!$user) {
                return response()->json(['response'=>false, 'message' => 'Login Fail, please check email id'],400);
            }



            $verify=\DB::table('users')->where(array('otp_verify'=>0,'email'=>$email))->first();

            $upload=\DB::table('users')->where(array('uploading_status'=>0,'email'=>$email))->first();
            if(!empty($verify)){

                $otp=rand(999,10000);
                $to_name=$user->name;
                $to_email=$user->email;
                $data=array("name"=>$to_name,"body"=>"Suds",'otp'=>$otp);
                $message='Your OTP is '.$otp;
                Mail::send('mail.otp',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)
                        ->subject('Verification otp');
                });
                $this->sms($message,$user->mobile);
                $api_token=Str::random(60);

                $this->User->update(array('remember_token'=>$request->input('device_token'),'api_token'=>$api_token),$user->id);

                return response()->json(['response'=>false,'status'=>$verify->otp_verify ,'message' => 'Your OTP not verified','otp'=>$otp,'id'=>$user->id,'api_token'=>$api_token,'document_status'=>$verify->uploading_status,'terms_status'=>$verify->status],400);

            }elseif(!empty($upload)){

                $api_token=Str::random(60);

                $this->User->update(array('remember_token'=>$request->input('device_token'),'api_token'=>$api_token),$user->id);


                return response()->json(['response'=>false,'upload_status'=>$upload->uploading_status ,'message' => 'Please upload document','id'=>$user->id,'api_token'=>$api_token],400);

            }elseif($user->status==0){

                $api_token=Str::random(60);
                $userd['id']=$user->id;
                $this->User->update(array('remember_token'=>$request->input('device_token'),'api_token'=>$api_token),$user->id);
                $userd['api_token']=$api_token;


                return response()->json(['response'=>false, 'message' => 'Please select terms and condition','status'=>0,'data' => $userd],400);

            }
            else{
                if (!Hash::check($password, $user->password)) {
                    return response()->json(['response'=>false, 'message' => 'Login Fail, pls check password'],400);
                }
                $api_token=Str::random(60);
                $this->User->update(array('remember_token'=>$request->input('device_token'),'api_token'=>$api_token),$user->id);

                $user1=$this->User->get_first_record($email,'email');
                return response()->json(['response'=>true,'message'=>'success', 'data' => $user1],201);
            }
        }
        return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
    }

    public function sms($message,$mobile){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/ACcad39ba7d08eac53c181194c238d7824/Messages.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            //   CURLOPT_POSTFIELDS => 'Body='.$message.'&From=%2B15202145984&To=%2B919913448692',
            CURLOPT_POSTFIELDS => 'Body='.$message.'&From=%2B15202145984&To=%2B1'.$mobile,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic QUNjYWQzOWJhN2QwOGVhYzUzYzE4MTE5NGMyMzhkNzgyNDoyNGUzZTNkNzIzNTc2NDEzNWVjZjlhZDcxN2EyZDdkYQ==',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        return $response;
    }

    public function oneMessage(Request $request){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/ACcad39ba7d08eac53c181194c238d7824/Messages.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            //   CURLOPT_POSTFIELDS => 'Body='.$message.'&From=%2B15202145984&To=%2B919913448692',
            CURLOPT_POSTFIELDS => 'Body='.$request->message.'&From=%2B15202145984&To=%2B1'.$request->to_id,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic QUNjYWQzOWJhN2QwOGVhYzUzYzE4MTE5NGMyMzhkNzgyNDoyNGUzZTNkNzIzNTc2NDEzNWVjZjlhZDcxN2EyZDdkYQ==',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        return response()->json(['response' => true,'message' => 'success', 'smsRes' => $response],200);
    }

    public function customerlogin(Request $request){

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password'=>'required',
        ]);
        if ($validator->passes()) {

            $email=$request->input('email');
            $password=$request->input('password');
            $user=\DB::table('users')->where(array('email'=>$email,'role_as'=>3))->first();

            if (!$user) {
                return response()->json(['response'=>false, 'message' => 'Login Fail, please check email id'],400);
            }
            $verify=\DB::table('users')->where(array('otp_verify'=>0,'email'=>$email,'role_as'=>3))->first();

            // $upload=\DB::table('users')->where(array('uploading_status'=>0,'email'=>$email))->first();   
            if(!empty($verify)){

                $otp=rand(999,10000);
                $to_name=$user->name;
                $to_email=$user->email;
                $data=array("name"=>$to_name,"body"=>"Suds",'otp'=>$otp);
                $message='Your OTP is '.$otp;
                Mail::send('mail.otp',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)
                        ->subject('Verification otp');
                });
                $this->sms($message,$user->mobile);
                $api_token=Str::random(60);

                $this->User->update(array('remember_token'=>$request->input('device_token'),'api_token'=>$api_token),$user->id);

                return response()->json(['response'=>false,'status'=>$verify->otp_verify ,'message' => 'Your OTP not verified','otp'=>$otp,'id'=>$user->id,'api_token'=>$api_token,'terms_status'=>$verify->status],400);

            }elseif($user->status==0){

                $api_token=Str::random(60);
                $userd['id']=$user->id;
                $this->User->update(array('remember_token'=>$request->input('device_token'),'api_token'=>$api_token),$user->id);
                $userd['api_token']=$api_token;


                return response()->json(['response'=>false, 'message' => 'Please select terms and condition','status'=>0,'data' => $userd],400);

            }
            else{
                if (!Hash::check($password, $user->password)) {
                    return response()->json(['response'=>false, 'message' => 'Login Fail, pls check password'],400);
                }
                $api_token=Str::random(60);
                $this->User->update(array('remember_token'=>$request->input('device_token'),'api_token'=>$api_token),$user->id);

                $user1=$this->User->get_first_record($email,'email');
                return response()->json(['response'=>true,'message'=>'success', 'data' => $user1],201);
            }
        }
        return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
    }

    public function otpVerify(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }

        $id=$request->input('id');
        if(!empty($id)){


            $api_token=Str::random(60);
            $response=$this->User->update(array('otp_verify'=>1,'api_token'=>$api_token),$id);
            $user1=$this->User->get_first_record($id,'id');
            if($user1->role_as == 3) {
                $message_cp='You have received the coupon for first wash Coupon';
                $to_email = $user1->email;
                $to_name = $user1->name;
                $data=array(
                    "name"=>$to_name,
                    "body"=>"Suds",
                    'coupan_code' => 'NEWSUDS10',
                    'amount' => '10',
                    'messages' => $message_cp
                );
                Mail::send('mail.coupon',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)
                        ->subject('Coupon Discount');
                });
                $type= 9;
                $title='You have received Coupon';
                $sms_message = 'You have received Coupon. Please check email box. ';
                $this->sms($sms_message,$user1->mobile);
                $this->push_Notification($user1->remember_token,1,$message_cp,$type,$title);
            }

            return response()->json(['response'=>true,'message'=>'success','data' => $user1,'api_token'=>$api_token],201);

        }else{
            return response()->json(['response'=>false, 'message' => 'something went wrong'],400);
        }
    }

    public function documentVerify(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('id');
        if(!empty($id)){

            $api_token=Str::random(60);


            $response=$this->User->update(array('uploading_status'=>1,'api_token'=>$api_token),$id);
            $user1=$this->User->get_first_record($id,'id');
            return response()->json(['response'=>true,'message'=>'success','data' => $user1,'api_token'=>$api_token],201);

        }else{
            return response()->json(['response'=>false, 'message' => 'something went wrong'],400);
        }
    }

    public function addVehicle(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }

        $validator = Validator::make($request->all(), [

            'user_id' => 'required',
            'make'=>'required',
            'year' => 'required',
            'model'=>'required',
            // 'engine' => 'required',
            'image'=>'required',
            'vehicle_type'=>'required',
            'category_id'=>'required'
        ]);
        if ($validator->passes()) {

            $data = $request->except([
                '_token',
            ]);
            if (Input::hasFile('image')){

                $file = Input::file('image');
                $name = $file->getClientOriginalName();


                $image = Image::make(Input::file('image')->getRealPath());
                $image->save(public_path() . '/vehicle/' . $data['image']->getClientOriginalName());

                $data['image'] = $name;
            }

            if($this->Vehicle->create($data)){
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong'],400);
            }

        }

        return response()->json(['response' => false,'message' => 'required all field','error'=>$validator->errors()],400);
    }

    public function viewVehicle(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('user_id');
        $vehicle=$this->Vehicle->get_record($id,'user_id');

        if($vehicle){
            return response()->json(['response' => true,'message' => 'success','data'=>$vehicle,'url'=>url('public/vehicle/')],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
        return response()->json(['response' => false,'message' => 'id is required','data'=>array()],400);
    }

    public function packages(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $vehicle_id=$request->input('category_id');
        $subcategory_id=$request->input('subcategory_id');
        if(empty($subcategory_id)){
            $package=PackageModel::where(['category_id'=>$vehicle_id])->get();
        }else{
            $package=PackageModel::where(['category_id'=>$vehicle_id,'subcategory_id'=>$subcategory_id])->get();
        }
        if(!empty($package)){
            return response()->json(['response' => true,'message' => 'success','data'=>$package],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function vehicleType(){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $category=$this->Category->all();
        if(!empty($category)){
            return response()->json(['response' => true,'message' => 'success','data'=>$category],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function category(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('vehicle_id');
        $subcate=$this->Subcategory->get_record($id,'category_id');
        if(!empty($subcate)){
            return response()->json(['response' => true,'message' => 'success','data'=>$subcate],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function addOns(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $category_id=$request->input('category_id');

        $addons=$this->AddONS->where(array('package_id'=>$category_id));
        //$addons=$this->AddONS->all();
        if(count($addons)>0){
            return response()->json(['response' => true,'message' => 'success','data'=>$addons],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function resentOtp(Request $request){
        $email=$request->input('email');
        $user=$this->User->get_first_record($email,'email');
        if($user){
            $otp=rand(999,10000);
            $to_name=$user->name;
            $to_email=$request->input('email');
            $data=array("name"=>$to_name,"body"=>"Suds",'otp'=>$otp);
            $message='Your OTP is '.$otp;
            Mail::send('mail.otp',$data,function($message) use ($to_name,$to_email){
                $message->to($to_email)
                    ->subject('Verification otp');
            });
            $this->sms($message,$user->mobile);

            return response()->json(['response' => true,'message' => 'success','otp'=>$otp],201);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong'],400);
        }
    }

    public function make(Request $request){
        $token = request()->header('App-Key');

        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }

        $curl = curl_init();
        // $where = urlencode('{
        //     "Make": {
        //         "$exists": true
        //     }
        // }');
        $year=$request->input('year');
        $where = urlencode('{
            "Year": '.$year.'
        }');
        curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Car_Model_List?limit=100000&keys=Make&where=' . $where);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Parse-Application-Id: hlhoNKjOvEhqzcVAJ1lxjicJLZNVv36GdbboZj3Z', // This is the fake app's application id
            'X-Parse-Master-Key: SNMJJF0CZZhTPhLDIqGhTlUNV9r60M2Z5spyWfXW' // This is the fake app's readonly master key
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $x=curl_exec($curl); // Here you have the data that you need

        //json_encode($data, JSON_PRETTY_PRINT);

        curl_close($curl);
        $dec=json_decode($x);
        $uni=$this->my_array_unique($dec->results,'Make');
        echo json_encode(['response' => true,'message' => 'success','data'=>$uni],201);



    }

    function my_array_unique($array, $key){
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {

            if (!in_array($val->$key, $key_array)) {
                $key_array[$i] = $val->$key;
                $temp_array[] = $val;
            }
            $i++;
        }
        return $temp_array;

    }

    public function year(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Car_Model_List?limit=100000&keys=Year');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Parse-Application-Id: hlhoNKjOvEhqzcVAJ1lxjicJLZNVv36GdbboZj3Z', // This is the fake app's application id
            'X-Parse-Master-Key: SNMJJF0CZZhTPhLDIqGhTlUNV9r60M2Z5spyWfXW' // This is the fake app's readonly master key
        ));


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $x=curl_exec($curl); // Here you have the data that you need


        curl_close($curl);
        $dec=json_decode($x);
        $uni=$this->my_array_unique($dec->results,'Year');
        $result=$this->array_sort_by_column($uni, 'Year');


        echo json_encode(['response' => true,'message' => 'success','data'=>$uni],200);
    }

    function aasort (&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {

            $sorter[$ii] = $va->$key;
        }

        asort($sorter);

        foreach ($sorter as $ii => $va) {
            $ret[] = $array[$ii];
        }
        // print_r($ret);die();
        $array = $ret;
    }

    function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[] = $row->$col;

        }

        array_multisort($sort_col, $dir, $arr);
    }

    public function model(Request $request){

        $token = request()->header('App-Key');

        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }

        $curl = curl_init();

        $make=$request->input('make');
        $curl = curl_init();
        $where = urlencode('{
                "Make": "'.$make.'"
            }');
        curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Car_Model_List?limit=999999&order=Model&keys=Model&where=' . $where);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Parse-Application-Id: hlhoNKjOvEhqzcVAJ1lxjicJLZNVv36GdbboZj3Z', // This is the fake app's application id
            'X-Parse-Master-Key: SNMJJF0CZZhTPhLDIqGhTlUNV9r60M2Z5spyWfXW' // This is the fake app's readonly master key
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $x=curl_exec($curl); // Here you have the data that you need


        curl_close($curl);
        $dec=json_decode($x);
        $uni=$this->my_array_unique($dec->results,'Model');



        echo json_encode(['response' => true,'message' => 'success','data'=>$uni],200);
    }

    public function washerSignup(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'mobile'=>'required',
            'password'=>'required',
            'device_token'=>'required',

        ]);
        if ($validator->passes()) {
            $data = $request->except([
                '_token',
                'password'
            ]);
            $data['role_as']=2;
            $data['status']=0;
            $data['password']=Hash::make($request->input('password'));
            $data['remember_token']=$request->input('device_token');
            $data['longitude']=$request->input('longitude');
            $data['latitude']=$request->input('latitude');
            $data['total_amount']=0;
            $data['wallet_amount']=0;
            if(count($this->User->where(array('email'=>$request->input('email'),'role_as'=>2)))>0){

                return response()->json(['response' => false,'message' => 'Email id already exists','data'=>array()],400);

            }elseif(count($this->User->where(array('mobile'=>$request->input('mobile'),'role_as'=>2)))>0){

                return response()->json(['response' => false,'message' => 'Mobile number already exists','data'=>array()],400);
            }else{
                $user=$this->User->create($data);
                if($user){
                    $datavalue=array('id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'mobile'=>$user->mobile,'role_as'=>$user->role_as,'status'=>$user->status);

                    $otp=rand(999,10000);
                    $to_name=$request->input('name');
                    $to_email=$request->input('email');
                    $data=array("name"=>$to_name,"body"=>"Suds",'otp'=>$otp);
                    $message='Your OTP is '.$otp;
                    
                    Mail::send('mail.otp',$data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)
                            ->subject('Verification otp');
                    });
                    $this->sms($message,$user->mobile);
                    //dd('test');
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $stripe = new \Stripe\StripeClient(
                        'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
                    );

                    $accounts = $stripe->accounts->create([
                    'type' => 'custom',
                    'country' => 'US',
                    'email' => $user->email,
                    'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                    ],
                    //'individual'=> ['phone' => '804-222-1111'], 
                    ]);

                    $accountLinks = $stripe->accountLinks->create([
                    'account' => $accounts->id,
                    'refresh_url' => 'https://suds-2-u.com/reauth',
                    'return_url' => 'https://suds-2-u.com/return',
                    'type' => 'account_onboarding',
                    ]);

                    $this->User->update(array('washer_accountid'=>$accounts->id,'washer_account_link'=>$accountLinks->url),$user->id);
                    return response()->json(['response' => true,'message' => 'success','data'=>$datavalue,'otp'=>$otp],201);
                }else{
                    return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
                }
               
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function washerregistration(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'mobile'=>'required',
            'password'=>'required',
            'device_token'=>'required',

        ]);
        if ($validator->passes()) {
            $data = $request->except([
                '_token',
                'password'
            ]);

            $data['role_as']=2;
            $data['status']=0;
            $data['password']=Hash::make($request->input('password'));
            $data['remember_token']=$request->input('device_token');
            $data['longitude']=$request->input('longitude');
            $data['latitude']=$request->input('latitude');

            $data['api_token']=Str::random(60);
            $data['total_amount']=0;
            $data['wallet_amount']=0;
            if(count($this->User->where(array('email'=>$request->input('email'),'role_as'=>2)))>0){

                return response()->json(['response' => false,'message' => 'Email id already exists','data'=>array(),'otp'=>''],400);

            }elseif(count($this->User->where(array('mobile'=>$request->input('mobile'),'role_as'=>2)))>0){

                return response()->json(['response' => false,'message' => 'Mobile number already exists','data'=>array(),'otp'=>''],400);
            }else{
                $user=$this->User->create($data);
                if($user){
                    $datavalue=array('id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'mobile'=>$user->mobile,'role_as'=>$user->role_as,'status'=>$user->status,'api_token'=>$user->api_token);

                    $otp=rand(999,10000);
                    $to_name=$request->input('name');
                    $to_email=$request->input('email');
                    $data=array("name"=>$to_name,"body"=>"Suds",'otp'=>$otp);
                    $message='Your OTP is '.$otp;
                    Mail::send('mail.otp',$data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)
                            ->subject('Verification otp');
                    });
                    $this->sms($message,$user->mobile);

                    return response()->json(['response' => true,'message' => 'success','data'=>$datavalue,'otp'=>$otp],201);
                }else{
                    return response()->json(['response' => false,'message' => 'something went wrong','data'=>array(),'otp'=>''],400);
                }
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors(),'otp'=>''],400);
        }
    }

    public function userdetails(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');

            $user=$this->User->get_first_record($id,'id');
            if(!empty($user)){
                $userdetails=(object)array();

                $userdetails= $this->getotherdetails($user);

                return response()->json(['response' => true,'message' => 'success','data'=>$userdetails],200);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    function getotherdetails($b){

        $userdetails['id']=$b->id;
        $userdetails['name']=$b->name;
        $userdetails['email']=$b->email;
        $userdetails['image']=$b->image;
        $userdetails['mobile']=$b->mobile;
        $userdetails['role_as']=$b->role_as;
        $user=$this->UserDetailsModel->get_first_record($b->id,'user_id');
        if(!empty($user)){
            $userdetails['preferred_method_of_contact']=$user->preferred_method_of_contact;
            $userdetails['complete_address']=$user->complete_address;



            $city=$this->CityModel->get_first_record($user->city,'id');
            $userdetails['city']=$user->city;
            $userdetails['city_name']=$city->name;
            $state=$this->StateModel->get_first_record($user->state,'id');
            $userdetails['state']=$user->state;
            $userdetails['state_name']=$state->name;

            $country=$this->CountryModel->get_first_record($user->country,'id');
            $userdetails['country']=$user->country;
            $userdetails['country_name']=$country->name;
            $userdetails['hourly_rate']=$user->hourly_rate;
            $userdetails['language']=$user->language;
            $userdetails['suds_account']=$user->suds_account;
        }
        return $userdetails;
    }

    public function get_country(){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $Country=$this->CountryModel->all();
        if(!empty($Country)){
            return response()->json(['response' => true,'message' => 'success','data'=>$Country],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function get_state(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('country_id');

        $state=$this->StateModel->where(array('country_id'=>$id));

        if(count($state)>0){
            return response()->json(['response' => true,'message' => 'success','data'=>$state],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function get_city(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('state_id');

        $city=$this->CityModel->where(array('state_id'=>$id));

        if(count($city)>0){
            return response()->json(['response' => true,'message' => 'success','data'=>$city],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function save_complete_profile(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'preferred_method_of_contact' => 'required',
            'complete_address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'hourly_rate'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);

            $data['phone_number']=$request->input('mobile');
            $data['preferred_method_of_contact']=$request->input('preferred_method_of_contact');
            $data['complete_address']=$request->input('complete_address');
            $data['city']=$request->input('city');
            $data['state']=$request->input('state');
            $data['country']=$request->input('country');
            $data['hourly_rate']=$request->input('hourly_rate');
            $data['user_id']=$request->input('user_id');
            $id=$request->input('user_id');

            if (Input::hasFile('image')){

                $file = Input::file('image');
                $name = $file->getClientOriginalName();


                $image = Image::make(Input::file('image')->getRealPath());
                $image->save(public_path() . '/profile/' . $file->getClientOriginalName());

                $datauser['image'] = $name;
                $datauser['mobile'] = $request->input('mobile');
                $this->User->updateWithId($datauser,$id,'id');
            }


            $user=$this->UserDetailsModel->get_first_record($id,'user_id');
            if(!empty($user)){

                $this->UserDetailsModel->updateWithId($data,$id,'user_id');
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                $user= $this->UserDetailsModel->create($data);
            }
            if($user){
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function get_bank_details(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');

            $user=$this->BankModel->get_first_record($id,'user_id');
            if(!empty($user)){

                return response()->json(['response' => true,'message' => 'success','data'=>$user],200);
            }else{
                return response()->json(['response' => false,'message' => 'No Records Founds','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function save_bank_details(Request $request){

        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'account_number' => 'required',
            'routing_number'=>'required',
            'bank_code'=>'required',
            'branch_code'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);

            $data['bank_name']=$request->input('bank_name');
            $data['account_number']=$request->input('account_number');
            $data['routing_number']=$request->input('routing_number');
            $data['bank_code']=$request->input('bank_code');
            $data['branch_code']=$request->input('branch_code');
            $data['user_id']=$request->input('user_id');
            $id=$request->input('user_id');

            $user=$this->BankModel->get_first_record($id,'user_id');
            if(!empty($user)){

                $this->BankModel->updateWithId($data,$id,'user_id');
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                $user= $this->BankModel->create($data);
            }
            if($user){
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function change_password(Request $request){

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'user_id' => 'required',
            'newpassword' => 'required'

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);

            $old_password=$request->input('old_password');
            $data['password']=Hash::make($request->input('newpassword'));

            $id=$request->input('user_id');

            $user=$this->User->get_first_record($id,'id');
            if(!empty($user)){
                if (!Hash::check($old_password, $user->password)) {
                    return response()->json(['response'=>false, 'message' => 'Wrong Old password'],400);
                }else{
                    $this->User->updateWithId($data,$id,'id');
                    return response()->json(['response' => true,'message' => 'success'],201);
                }
            }else{

                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function bookinghistory(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');
            $offset = $request->pagecount;
            $limit = 10;

            $booking = \DB::table('booking')->where('washer_id', $id)->orderBy('booking_id', 'DESC')->offset($offset*$limit)->limit($limit)->get();
            if(!empty($booking)){
                $bookingdetails=array();
                foreach($booking as $b){
                    $bookingdetails[]= $this->getbookingdetails($b);
                }


                return response()->json(['response' => true,'message' => 'success','data'=>$bookingdetails],200);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function getbookingdetails($b){
        $data['booking_id']=$b->booking_id;
        $data['user_id']=$b->user_id;
        $users = \DB::table('users')->where('id', $b->user_id)->get();
        if(!empty($users)){
            $data['userdetails']=$users;
        }else{
            $data['userdetails']=(object)array();
        }
        $data['type']=$b->type;
        $data['washer_id']=$b->washer_id;
        $data['vehicle_id']=$b->vehicle_id;
        $vehicle = \DB::table('vehicle')->where('vehicle_id', $b->vehicle_id)->get();
        if(!empty($vehicle)){
            $data['vehicledetails']=$vehicle;
        }else{
            $data['vehicledetails']=(object)array();
        }
        $data['booking_date']=$b->booking_date;
        $data['booking_time']=$b->booking_time;
        $data['package']=$b->package;
        $data['extra_add_ons']=$b->extra_add_ons;
        if(!empty($b->extra_add_ons)){
            $a= explode(',',$b->extra_add_ons);

            $extra_add_ons = \DB::table('add_ons')->whereIn('id', $a)->get();

            if(!empty($extra_add_ons)){
                $data['extraaddonsdetails']=$extra_add_ons;
            }else{
                $data['extraaddonsdetails']=array();
            }
        }
        $data['wash_location']=$b->wash_location;

        $data['vehicle_type']=categoryname($b->vehicle_type);
        $vehicle_type=$b->vehicle_type;
        if($vehicle_type=='7'){
            $data['length']=$b->length;
            $data['width']=$b->width;

        }elseif($vehicle_type=='6'){

            $data['hours']=$b->hours;
        }elseif($vehicle_type=='5'){

            $data['feet']=$b->feet;

        }elseif($vehicle_type=='3'){
            $data['feet']=$b->feet;
        }

        $data['total']=$b->total;
        $data['status']=$b->status;
        $data['created_at']=$b->created_at;
        $data['updated_at']=$b->updated_at;
        return $data;
    }

    public function newjobrequest(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');

            $booking = \DB::table('booking')->where('washer_id', $id)->where('status', 0)->orderBy('booking_id','DESC')->first();
            if(!empty($booking)){
                $bookingdetails=(object)array();

                $bookingdetails= $this->getbookingdetails($booking);



                return response()->json(['response' => true,'message' => 'success','data'=>$bookingdetails],200);
            }else{
                return response()->json(['response' => true,'message' => 'No Result Founds','data'=>(object)array()],200);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function reject_job(Request $request){

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'user_id' => 'required'


        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);

            $booking_id=$request->input('booking_id');
            $data['user_id']=$request->input('user_id');
            $datas['status']=6;
            $id=$request->input('user_id');
            $booking = \DB::table('booking')->where('booking_id', $booking_id)->where('status', 0)->first();

            if(!empty($booking)){
                \DB::table('booking')->where('booking_id', $booking_id)->update($datas);
                $user = \DB::table('users')->where('id', $booking->user_id)->first();

                if(!empty($user)){
                    $user1 = \DB::table('users')->where('id',  $booking->washer_id)->first();

                    $msg=$user1->name. ' have Reject your job';
                    $type='3';
                    $title='Reject job request';
                    $this->push_Notification($user->remember_token,$booking_id,$msg,$type,$title);
                    $message = $title;
                    $to_name=$user->name;
                    $to_email=$user->email;
                    $mail_data=array('to_name'=>$to_name,'to_email'=>$to_email,'messages'=>$title,'title'=>'SUDS-2-U.COM');
                    Mail::send('mail.usermessage',$mail_data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)
                            ->subject('Reject job request');
                    });
                }
                // DB::table('users')->insert(array('washer_id'=>$booking->washer_id,'booking_id'=>$booking_id));

                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'Job is not available'],201);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function accept_job(Request $request){

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'user_id' => 'required'


        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);

            $booking_id=$request->input('booking_id');
            $data['user_id']=$request->input('user_id');
            $datas['status']=1;
            $id=$request->input('user_id');
            $booking = \DB::table('booking')->where('booking_id', $booking_id)->where('status', 0)->first();

            if(!empty($booking)){
                \DB::table('booking')->where('booking_id', $booking_id)->update($datas);
                $user = \DB::table('users')->where('id', $booking->user_id)->first();

                if(!empty($user)){
                    $user1 = \DB::table('users')->where('id',  $booking->washer_id)->first();

                    $msg=$user1->name. ' have Accepted your job';
                    $type='2';
                    $title='Accepted job request';
                    $this->push_Notification($user->remember_token,$booking_id,$msg,$type,$title);
                    $message = $title;
                    $to_name=$user->name;
                    $to_email=$user->email;
                    $mail_data=array('to_name'=>$to_name,'to_email'=>$to_email,'messages'=>$title,'title'=>'SUDS-2-U.COM');
                    Mail::send('mail.usermessage',$mail_data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)
                            ->subject('Accepted job request');
                    });
                }

                return response()->json(['response' => true,'message' => 'success'],201);
            }
            else{
                return response()->json(['response' => false,'message' => 'Job is not available'],201);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function reviewrating_list(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');
            $offset = $request->pagecount;
            $limit = 10;

            $rating=\DB::table('review')->where('to_id',$id)->selectRaw('SUM(rating)/COUNT(from_id) AS avg_rating')->first()->avg_rating;
            $numberAsString = number_format($rating, 1);

            $ratingData=array();

            $ratinguser1 = \DB::table('review')->where('to_id', $id)->whereBetween('rating', [0, 1.5])->get();
            $totalratinguser1=count($ratinguser1);

            $ratinguser2 = \DB::table('review')->where('to_id', $id)->whereBetween('rating', [2, 2.5])->get();
            $totalratinguser2=count($ratinguser2);

            $ratinguser3 = \DB::table('review')->where('to_id', $id)->whereBetween('rating', [3, 3.5])->get();
            $totalratinguser3=count($ratinguser3);

            $ratinguser4 = \DB::table('review')->where('to_id', $id)->whereBetween('rating', [4, 4.5])->get();
            $totalratinguser4=count($ratinguser4);

            $ratinguser5 = \DB::table('review')->where('to_id', $id)->where('rating', 5)->get();
            $totalratinguser5=count($ratinguser5);
            $ratingData[]=array('ratingStars'=>'1','count'=>$totalratinguser1);
            $ratingData[]=array('ratingStars'=>'2','count'=>$totalratinguser2);
            $ratingData[]=array('ratingStars'=>'3','count'=>$totalratinguser3);
            $ratingData[]=array('ratingStars'=>'4','count'=>$totalratinguser4);
            $ratingData[]=array('ratingStars'=>'5','count'=>$totalratinguser5);
            $review = \DB::table('review')->where('to_id', $id)->offset($offset*$limit)->limit($limit)->get();
            $totalreviewcount=count($review);
            if(!empty($review)){
                $reviewdetails=array();
                foreach($review as $b){
                    $reviewdetails[]= $this->getreviewdetails($b);
                }


                return response()->json(['response' => true,'message' => 'success','totalreviewcount'=>"$totalreviewcount",'totalrating'=>"$numberAsString",'ratingData'=>$ratingData,'data'=>$reviewdetails],200);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function getreviewdetails($b){
        $data['id']=$b->id;
        $data['from_id']=$b->from_id;
        $data['to_id']=$b->to_id;
        $data['comment']=$b->comment;
        $data['rating']=$b->rating;
        $data['created_date']=$b->created_date;
        $users = \DB::table('users')->where('id', $b->from_id)->get();
        if(!empty($users)){
            $data['userdetails']=$users;
        }else{
            $data['userdetails']=(object)array();
        }


        return $data;
    }

    public function earninglist(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');
            $type=$request->input('type');
            $offset = $request->pagecount;
            $limit = 10;
            if($type=='today'){
                $today=date('Y-m-d');
                $bookingt = \DB::table('booking')->where('washer_id', $id)->where('booking_date', $today)->get();
                $booking = \DB::table('booking')->where('washer_id', $id)->where('booking_date', $today)->offset($offset*$limit)->limit($limit)->get();

                $totalbooking=count($bookingt);
                $bookingamt = DB::table('booking')->where('washer_id', $id)->where('booking_date', $today)->sum('total');
                $bookingtime = DB::table('booking')->where('washer_id', $id)->where('booking_date', $today)->sum('totaltime');

                $totalamount=$bookingamt;
                $totaltime=$bookingtime;
            } else {
                $today=date('Y-m-d');
                $previous_week = strtotime("-1 week +1 day");
                $start_week = strtotime("last sunday midnight",$previous_week);
                $end_week = strtotime("next saturday",$start_week);
                $start_week = date("Y-m-d",$start_week);
                $end_week = date("Y-m-d",$end_week);
                // print_r($start_week);
                // print_r($end_week); exit;
                $bookingt = \DB::table('booking')->where('washer_id', $id)->whereBetween('booking_date', [$start_week, $end_week])->get();
                // DB::enableQueryLog();     
                $booking = \DB::table('booking')->where('washer_id', $id)->whereBetween('booking_date', [$start_week, $end_week])->offset($offset*$limit)->limit($limit)->get();
                //  dd(DB::getQueryLog());
                //  echo '<pre>';
                //  print_r($booking);die();
                $totalbooking=count($bookingt);
                $bookingamt = DB::table('booking')->where('washer_id', $id)->whereBetween('booking_date', [$start_week, $end_week])->sum('total');
                $bookingtime = DB::table('booking')->where('washer_id', $id)->whereBetween('booking_date', [$start_week, $end_week])->sum('totaltime');

                $totalamount=$bookingamt;
                $totaltime=$bookingtime;
            }


            if(!empty($booking)){
                $bookingdetails=array();
                foreach($booking as $b){
                    $bookingdetails[]= $this->getearningdetails($b);
                }
                return response()->json(['response' => true,'message' => 'success','totalbooking'=>"$totalbooking",'totaltime'=>"$totaltime",'totalamount'=>"$totalamount",'data'=>$bookingdetails],200);
            } else {
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        } else {
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function getearningdetails($b){
        $data['booking_id']=$b->booking_id;
        $data['user_id']=$b->user_id;
        $users = \DB::table('users')->where('id', $b->user_id)->get();
        if(!empty($users)){
            $data['userdetails']=$users;
        }else{
            $data['userdetails']=(object)array();
        }
        $data['washer_id']=$b->washer_id;
        $data['vehicle_id']=$b->vehicle_id;
        $vehicle = \DB::table('vehicle')->where('vehicle_id', $b->vehicle_id)->get();
        if(!empty($vehicle)){
            $data['vehicledetails']=$vehicle;
        }else{
            $data['vehicledetails']=(object)array();
        }
        $data['booking_date']=$b->booking_date;
        $data['booking_time']=$b->booking_time;
        $data['package']=$b->package;
        //   $data['extra_add_ons']=$b->extra_add_ons;
        $data['totaltime']=$b->totaltime;


        //   $extra_add_ons = \DB::table('add_ons')->whereIn('id', [$b->extra_add_ons])->get();
        // if(!empty($extra_add_ons)){
        //       $data['extraaddonsdetails']=$extra_add_ons;
        // }else{
        //     $data['extraaddonsdetails']=array();
        // }
        $data['wash_location']=$b->wash_location;
        $data['total']=$b->total;
        $data['status']=$b->status;
        $data['created_at']=$b->created_at;
        $data['updated_at']=$b->updated_at;
        return $data;
    }

    public function upload_drivinglicense(Request $request){

        $validator = Validator::make($request->all(), [
            'license_number' => 'required',
            'license_classification' => 'required',
            'issued_on'=>'required',
            'expiry_date'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);
            $id=$request->input('user_id');

            $data['license_number']=$request->input('license_number');
            $data['license_classification']=$request->input('license_classification');
            $data['issued_on']=$request->input('issued_on');
            $data['expiry_date']=$request->input('expiry_date');

            $data['term_condition']=$request->input('term_condition');


            if (Input::hasFile('image')){

                $file = Input::file('image');
                $name = $file->getClientOriginalName();


                $image = Image::make(Input::file('image')->getRealPath());
                $image->save(public_path() . '/document/' . $file->getClientOriginalName());

                $data['license_image'] = $name;

            }


            $user=$this->UserdocModel->get_first_record($id,'user_id');
            if(!empty($user)){

                $this->UserdocModel->updateWithId($data,$id,'user_id');
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                $data['user_id']=$request->input('user_id');
                $user= $this->UserdocModel->create($data);
            }
            if($user){
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function drivinglicensedetails(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');


            $doc = \DB::table('user_document')->where('user_id', $id)->first();
            if(!empty($doc)){

                return response()->json(['response' => true,'message' => 'success','data'=>$doc],200);
            }else{
                return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function update_drivinglicense(Request $request){

        $validator = Validator::make($request->all(), [
            'license_number' => 'required',
            'license_classification' => 'required',
            'issued_on'=>'required',
            'expiry_date'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);
            $id=$request->input('user_id');

            $data['license_number']=$request->input('license_number');
            $data['license_classification']=$request->input('license_classification');
            $data['issued_on']=$request->input('issued_on');
            $data['expiry_date']=$request->input('expiry_date');


            if (Input::hasFile('image')){

                $file = Input::file('image');
                $name = $file->getClientOriginalName();


                $image = Image::make(Input::file('image')->getRealPath());
                $image->save(public_path() . '/document/' . $file->getClientOriginalName());

                $data['license_image'] = $name;

            }


            $user=$this->UserdocModel->get_first_record($id,'user_id');
            if(!empty($user)){

                $this->UserdocModel->updateWithId($data,$id,'user_id');
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                $data['user_id']=$request->input('user_id');
                $user= $this->UserdocModel->create($data);
            }
            if($user){
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function backgroundcheck(){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $doc = \DB::table('app_content')->where('type', 'backgroundcheck')->first();
        if(!empty($doc)){
            return response()->json(['response' => true,'message' => 'success','data'=>$doc],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function saveagree(Request $request){

        $validator = Validator::make($request->all(), [

            'user_id'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);
            $id=$request->input('user_id');

            $data['term_condition']='1';


            $user=$this->UserdocModel->get_first_record($id,'user_id');
            if(!empty($user)){

                $this->UserdocModel->updateWithId($data,$id,'user_id');
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'Upload document First','data'=>array()],400);
            }
            if($user){
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function updatepackages(Request $request){

        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'time' => 'required',
            'user_id'=>'required',
            'type'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);
            $id=$request->input('user_id');

            $data['price']=$request->input('price');
            $data['package_time']=$request->input('time');
            $data['type']=$request->input('type');
            $data['description']=$request->input('description');

            $packages = \DB::table('user_packages')->where('user_id', $request->input('user_id'))->where('type', $request->input('type'))->first();

            if(!empty($packages)){

                $this->UserpackagesModel->updateWithId($data,$id,'user_id');
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                $data['user_id']=$request->input('user_id');
                $user= $this->UserpackagesModel->create($data);
            }
            if($user){
                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function singlepackagesdetails(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
            'type'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');
            $type=$request->input('type');


            $doc = \DB::table('user_packages')->where('user_id', $id)->where('type', $type)->first();
            if(!empty($doc)){

                return response()->json(['response' => true,'message' => 'success','data'=>$doc],200);
            }else{
                return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function singlebookingdetails(Request $request){


        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'booking_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('booking_id');
            $type=$request->input('type');
            $time_zone=$request->input('time_zone');

            $booking = \DB::table('booking')->where('booking_id', $id)->first();
            if(!empty($booking)){
                $bookingdetails=(object)array();

                $bookingdetails= $this->getsinglebookingdetails($booking,$type,$time_zone);



                return response()->json(['response' => true,'message' => 'success','data'=>$bookingdetails],200);
            }else{
                return response()->json(['response' => false,'message' => 'No Result Founds','data'=>(object)array()],200);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function getsinglebookingdetails($b,$type,$time_zone){
        date_default_timezone_set($time_zone);
        $data['booking_id']=$b->booking_id;
        $data['user_id']=$b->user_id;

        $types=$b->type;
        $data['type']=$b->type;
        $users = \DB::table('users')->where('id', $b->user_id)->get();
         if(!empty($users)){
            $data['userdetails']=$users;

            // $data['wash_lat_lng']=array('latitude'=>$users[0]->latitude,'longitude'=>$users[0]->longitude);

        }else{
            $data['userdetails']=(object)array();
        }
        $usersb = \DB::table('users')->where('id', $b->washer_id)->get();
        if(!empty($usersb)){
            $data['washerdetails']=$usersb;
        }else{
            $data['washerdetails']=(object)array();
        }

        $data['wash_lat_lng']=array('latitude'=>$b->wash_lat,'longitude'=>$b->wash_long);


        $data['washer_id']=$b->washer_id;
        $data['vehicle_id']=$b->vehicle_id;
        $vehicle = \DB::table('vehicle')->where('vehicle_id', $b->vehicle_id)->get();
        if(!empty($vehicle)){
            $data['vehicledetails']=$vehicle;
        }else{
            $data['vehicledetails']=(object)array();
        }

        $finishedbooking= \DB::table('finished_booking')->where('booking_id', $b->booking_id)->where('user_id', $b->washer_id)->first();

        if(!empty($finishedbooking)){
            $data['image'][]=array('image1'=>url('public/job/'.$finishedbooking->image),'image2'=>url('public/job/'.$finishedbooking->image1),'image3'=>url('public/job/'.$finishedbooking->image2),'image4'=>url('public/job/'.$finishedbooking->image3));

        }else{
            $data['image'][]='';
        }

        $data['vehicle_type']=categoryname($b->vehicle_type);
        $vehicle_type=$b->vehicle_type;
        if($vehicle_type=='7'){
            $data['length']=$b->length;
            $data['width']=$b->width;

        }elseif($vehicle_type=='6'){

            $data['hours']=$b->hours;
        }elseif($vehicle_type=='5'){

            $data['feet']=$b->feet;

        }elseif($vehicle_type=='3'){
            $data['feet']=$b->feet;
        }

        $to=$b->booking_date.' '.$b->start_time;
        $data['booking_date']=$b->booking_date;
        $data['booking_time']=$b->booking_time;
        $data['start_time']=$to;
        $data['end_time']=$b->end_time;
        $data['extra_time']=$b->extra_time;
        $staus='';
        if($b->status==0){
            $staus='WASH_PENDING';
            $staus1=0;
        }elseif($b->status==1){
            $staus='WASHER_ACCEPTED';
            $staus1=1;
        }elseif($b->status==2){
            $staus='WASHER_ON_THE_WAY';
            $staus1=2;
        }elseif($b->status==3){
            $staus='WASHER_ARRIVED';
            $staus1=3;
        }elseif($b->status==4){
            $staus='WASH_IN_PROGRESS';
            $staus1=4;
        }elseif($b->status==5){
            $staus='WASH_COMPLETED';
            $staus1=5;
        }elseif($b->status==6){
            $staus='WASH_REJECTED';
            $staus1=6;
        }
        $data['booking_status']=$staus1;
        $time1 = new DateTime($b->start_time);
        $time2 = new DateTime($b->end_time);
        $interval = $time1->diff($time2);

        $s= $interval->format('%h:%i:%s');

        $data['package']=$b->package;

        if($b->type=='0'){

            $package = \DB::table('user_packages')->where('id', $b->package)->first();

            if(!empty($package)){
                if ($package->type == 'Silver') {
                $time_v = '60';
                } 
                else if ($package->type == 'Gold') {
                $time_v = '90';
                } 
                else if ($package->type == 'Diamond') {
                $time_v = '180';                            
                } 
                else if ($package->type == 'Platinuim') {
                $time_v = '120';
                } else{
                $time_v = '';   
                }
                $totaltime= $package->package_time;
                $data['package_price']=$package->price;
                if(!empty($b->extra_time)){
                    $extra=gmdate("H:i:s", $b->extra_time);
                    $ex=strtotime($package->package_time)+strtotime($extra);
                    $data['package_time']=$ex;
                }else{
                    $data['package_time']=$package->package_time;
                }
                $data['packageDetails']=array('name'=>$package->type,'price'=>$package->price,'time'=>$time_v);
            }else{

                $totaltime='';
                $data['package_price']='';
                $data['package_time']='';
                $data['packageDetails']=array();
            }
        }else{
            $package = \DB::table('packages')->where('package_id', $b->package)->first();
            if(!empty($package)){
            $userpackage = \DB::table('user_packages')->where('id', $b->package)->first();

                if ($userpackage->type == 'Silver') {
                $time_v = '60';
                } 
                else if ($userpackage->type == 'Gold') {
                $time_v = '90';
                } 
                else if ($userpackage->type == 'Diamond') {
                $time_v = '180';                            
                } 
                else if ($userpackage->type == 'Platinuim') {
                $time_v = '120';
                } else{
                $time_v = '';   
                }
                $totaltime=$package->package_time;
                $data['package_price']=$package->package_price;
                if(!empty($b->extra_time)){
                    $extra=gmdate("H:i:s", $b->extra_time);
                    $ex=strtotime($package->package_time)+strtotime($extra);
                    $data['package_time']=$ex;
                }else{
                    $data['package_time']=$package->package_time;
                }
                $data['packageDetails']=array('name'=>$package->package_name,'price'=>$package->package_price,'time'=>$time_v);
            }else{
                $data['package_price']='';
                $totaltime='';
                $data['package_price']='';
                $data['packageDetails']=array();
            }
        }


        $t=$b->start_time;
        $sjd=$b->start_job_date;
        if(!empty($b->extra_time)){
            $extra=gmdate("H:i:s", $b->extra_time);
            $ex=strtotime($totaltime)+strtotime($extra);
            $tex=date('H:i',$ex);
            $data['totaltime']=strtotime($t)+($this->time2sec($tex)*60);
        }else{

            //   $start =strtotime(date('H:i'));
            //   $stop = strtotime($t)+($this->time2sec($totaltime)*60);
            //   $diff = ($stop - $start); 

            //  $x = ($diff/3600)*60; 

            // $y = intdiv($x, 60).':'. ($x% 60);
            // $xd=date("h:i",strtotime($y));


            if(!empty($t)){
                $tarr = explode(':', $t);
                if(strpos( $t, 'AM') === false && $tarr[0] !== '12'){
                    $tarr[0] = $tarr[0] + 12;
                }elseif(strpos( $t, 'PM') === false && $tarr[0] == '12'){
                    $tarr[0] = '00';
                }
                $repl= preg_replace("/[^0-9 :]/", '', implode(':', $tarr));
            }else{
                $repl=0;
            }

            $start = strtotime($b->booking_date.' '.$t);
            $stop = strtotime(date('Y-m-d H:i:s'));
            $diff = ($stop - $start); //Diff in seconds
            $difsff= $diff/3600;

            $data['totaltime']= round(abs($start - $stop) / 60,2);
            $data['totalti']=$difsff;
            // $data['s']=$b->booking_date.' '.$t;
            // $data['e']=date('Y-m-d H:i:s');

        }

        //$data['totaltime']=strtotime($totaltime);


        $data['extra_add_ons']=$b->extra_add_ons;

        if(!empty($b->extra_add_ons)){
            $a= explode(',',$b->extra_add_ons);

            $extra_add_ons = \DB::table('add_ons')->whereIn('id', $a)->get();


            if(!empty($extra_add_ons)){
                $data['extraaddonsdetails']=$extra_add_ons;
            }else{
                $data['extraaddonsdetails']=array();
            }
        }
        $data['wash_location']=$b->wash_location;
        $data['total']=$b->total;

        $data['tip']=$b->booking_tip;
        $review = \DB::table('review')->where('request_id', $b->booking_id)->first();
        if(!empty($review)){
            $data['rating']=$review->rating;
            $data['review']=$review->comment;
        }else{
            $data['rating']='0';
            $data['review']='';
        }
        $data['created_at']=$b->created_at;
        $data['updated_at']=$b->updated_at;
        return $data;
    }

    function time2sec($time) {

        // $time = "21:30:10";
        $timeArr = array_reverse(explode(":", $time));
        $seconds = 0;
        foreach ($timeArr as $key => $value)
        {
            if ($key > 2) break;
            $seconds += pow(60, $key) * $value;
        }
        return $seconds;
    }

    public function useronlinestatus(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',

        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');

            $users = \DB::table('users')->where('id', $id)->first();
            if(!empty($users)){

                return response()->json(['response' => true,'message' => 'success','status'=>$users->onlinestatus],200);
            }else{
                return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function updatestatus(Request $request){

        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
            'status'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);
            $id=$request->input('user_id');

            $data['onlinestatus']=$request->input('status');

            $users = \DB::table('users')->where('id', $id)->first();

            if(!empty($users)){

                if($request->input('status')=='1'){

                    $book=DB::table('booking')->where(['washer_id'=>$id])->whereBetween('status', [0, 4])->get();

                    if(count($book)>0){
                        return response()->json(['response' => false,'message' => 'washer is busy','data'=>array()],400);
                    }else{
                        $this->User->updateWithId($data,$id,'id');
                        return response()->json(['response' => true,'message' => 'success'],201);
                    }
                }else{
                    $this->User->updateWithId($data,$id,'id');
                    return response()->json(['response' => true,'message' => 'success'],201);
                }
            }else{
                return response()->json(['response' => false,'message' => 'User Id is Wrong','data'=>array()],400);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function push_Notification_test(){
        $device_id='d3Akp1T9ZkWZsqpqQGtUeA:APA91bHO56ULiAlRMOeSWsl9mGGTvhVEaM1CM46Dh3xQ-zLD3C6zFylyjD80TDIB5uOf7Y9vfXiuIOxRh6fWuWoKcbTVpJQW6B3QFAqYM_tRPwajb20OcMzRFxWsQOVupU2GqK7eQeWv';
        $title='job request';
        $message='new job request';
        $booking_id='1';
        $message_final = array(
            'title' => $title,
            'body' => $message,

            'sound' => 'Default',
            'image' => 'Notification Image',
        );

        if($device_id)
        {
            $fields = array(
                'to' => $device_id,
                'notification' => $message_final,

                'data' => array (
                    "booking_id" => $booking_id
                ),
                'android_channel_id'=>'suds2u',
                'priority' => 'high',
                'content_available' => true
            );

        }

        $url = 'https://fcm.googleapis.com/fcm/send';
        //$api_key = 'AAAAinqmE8A:APA91bHRucjXF2cqL-meJy4TsN2QOYNZSUJ9eLrOd96dypwkxw5lfUyFCuirjK1EoR8jfqniLzOssyRzqwd_4tucj6wDpQOHd61_szKaYxE58MQHRa1O2ITXjnFHA2lZDj6sP6fA_dZY';
        $api_key = 'AAAAvP7_hT0:APA91bG6RP5_MKHdGUUzImUTr6RMU0q-yafqEjWlY9TWLaNsedKVucHRZN1vYPNzecIC4exu-7fLQI8NyKnrZbNu_zH262QTQXFuK6-m1Sioln0EurF3XIgvEtT0lb7F4nGEMPoaJNFG';
        $headers = array(
            'Authorization: key=' .$api_key ,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        print_r($result);
    }

    public function finishedjob(Request $request){
        //\DB::table('image_test_log')->insert(array('filess'=>"testtt"));
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'user_id' => 'required',
            'comment'=>'required',
        ]);
        if ($validator->passes()) {
            //\DB::table('image_test_log')->insert(array('filess'=>$request->file('image')));
            $data1 = $request->except([
                '_token'
            ]);
            $id=$request->input('user_id');
            $data['user_id']=$request->input('user_id');
            $data['booking_id']=$request->input('booking_id');
            $data['comment']=$request->input('comment');
            $booking_id=$request->input('booking_id');


            if (/*Input::hasFile('image')*/$request->hasFile('image')){
                $file = /*Input::file('image')*/$request->file('image');
                $name = $file->getClientOriginalName();

                $image = Image::make($request->file('image')->getRealPath());
                $image->save(public_path() . '/job/' . $file->getClientOriginalName());

                $data['image'] = $name;

            }

            if (/*Input::hasFile('image1')*/$request->hasFile('image1')){

                $file = $request->file('image1');
                $name1 = $file->getClientOriginalName();

                $image = Image::make($request->file('image1')->getRealPath());
                $image->save(public_path() . '/job/' . $file->getClientOriginalName());

                $data['image1'] = $name1;

            }


            if (/*Input::hasFile('image2')*/$request->hasFile('image2')){

                $file = $request->file('image2');
                $name2 = $file->getClientOriginalName();

                $image = Image::make($request->file('image2')->getRealPath());
                $image->save(public_path() . '/job/' . $file->getClientOriginalName());

                $data['image2'] = $name2;

            }
            if (/*Input::hasFile('image3')*/$request->hasFile('image3')){

                $file = $request->file('image3');
                $name3 = $file->getClientOriginalName();

                $image = Image::make($request->file('image3')->getRealPath());
                $image->save(public_path() . '/job/' . $file->getClientOriginalName());

                $data['image3'] = $name3;

            }

            $booking=$this->BookingModel->get_first_record($booking_id,'booking_id');
            if(!empty($booking)){
                $datas['status']='5';
                $data['status']='5';
                $datas['totaltime']=$request->input('totaltime');
                $datas['end_time']=date('h:i:s');

                $this->BookingModel->updateWithId($datas,$booking_id,'booking_id');
                $userf= $this->FinishedbookingModel->create($data);

                if($userf){

                    $user = \DB::table('users')->where('id', $booking->user_id)->first();

                    if(!empty($user)){
                        $user1 = \DB::table('users')->where('id',  $booking->washer_id)->first();

                       $msg=$user1->name. 'Congrats! Your Wash is Completed. Here is your photos';
                        $type='7';
                        $title='Finished job';
                        $this->push_Notification($user->remember_token,$booking_id,$msg,$type,$title);
                        $message = $title;
                        $to_name=$user->name;
                        $to_email=$user->email;
                        $mail_data=array('to_name'=>$to_name,'to_email'=>$to_email,'messages'=>$msg,'title'=>'SUDS-2-U.COM');
                        Mail::send('mail.usermessage',$mail_data,function($message) use ($to_name,$to_email){
                            $message->to($to_email)
                                ->subject('Finished job');
                        });
                    }
                    $result=DB::table('reward')->insert(array('user_id'=>$booking->user_id,'washer_id'=>$booking->washer_id,'reward_amount'=>1,'created_at'=>date('Y-m-d')));
                    $rewardresult=DB::table('reward')->where('user_id',$booking->user_id)
                        ->select('user_id','created_at', DB::raw('count(*) as total'))
                        ->groupBy('user_id')
                        ->get();

                    if(count($rewardresult)>0){

                        if($rewardresult[0]->total>=10){

                            if(!empty($user)){

                                $msg='10 Vases Completed You Will Get 50% Discount';
                                $type='9';
                                $title='Extra Discount';
                                $this->push_Notification($user->remember_token,$booking_id,$msg,$type,$title);
                                $message = $title;
                                $to_name=$user->name;
                                $to_email=$user->email;
                                $mail_data=array('to_name'=>$to_name,'to_email'=>$to_email,'messages'=>$msg,'title'=>'SUDS-2-U.COM');
                                Mail::send('mail.usermessage',$mail_data,function($message) use ($to_name,$to_email){
                                    $message->to($to_email)
                                        ->subject('Finished job');
                                });

                            }
                        }
                    }
                    // DB::table('reward')->where(array('user_id'=>$booking->user_id))->delete();
                    return response()->json(['response' => true,'message' => 'success'],201);
                }else{
                    return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
                }

            }else{
                return response()->json(['response' => false,'message' => 'Booking Id is wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function runningjob(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');

            //   $booking = \DB::table('booking')->where('washer_id', $id)->where('status','!=', 5)->orderBy('booking_id','DESC')->first();
            $booking = \DB::table('booking')->where('washer_id', $id)->whereBetween('status', [0, 4])->orderBy('booking_id','DESC')->first();

            if(!empty($booking)){
                $bookingdetails=(object)array();

                $bookingdetails= $this->getrunningjodetails($booking);



                return response()->json(['response' => true,'message' => 'success','data'=>$bookingdetails],200);
            }else{
                return response()->json(['response' => true,'message' => 'No Result Founds','data'=>(object)array()],200);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function getrunningjodetails($b){
        $data['booking_id']=$b->booking_id;
        $users = \DB::table('users')->select('id','name','image','latitude','longitude')->where('id', $b->user_id)->get();
        if(!empty($users)){
            $data['userdetails']=$users;
        }else{
            $data['userdetails']=(object)array();
        }
        $data['washer_id']=$b->washer_id;

        $data['booking_date']=$b->booking_date;
        $data['booking_time']=$b->booking_time;

        $data['wash_location']=$b->wash_location;
        $data['status']=$b->status;


        return $data;
    }

    public function startjob(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'booking_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('booking_id');
            $time_zone=$request->input('time_zone');
            date_default_timezone_set($time_zone);
            $booking = \DB::table('booking')->where('booking_id', $id)->first();
            if(!empty($booking)){
                $datas['status']='4';
                $datas['start_time']=date('h:i:s');
                $datas['start_job_date']=date('Y-m-d');
                $this->BookingModel->updateWithId($datas,$id,'booking_id');

                $user = \DB::table('users')->where('id', $booking->user_id)->first();
                if(!empty($user->remember_token)){
                    $msg=$user->name. ' Wash in progress';
                    $type='6';
                    $title='job request';

                    $this->push_Notification($user->remember_token,$id,$msg,$type,$title);

                    $message = $title;
                    $to_name=$user->name;
                    $to_email=$user->email;
                    $mail_data=array('to_name'=>$to_name,'to_email'=>$to_email,'messages'=>$msg,'title'=>'SUDS-2-U.COM');
                    Mail::send('mail.usermessage',$mail_data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)
                            ->subject('Job request');
                    });
                }

                return response()->json(['response' => true,'message' => 'success','booking_id' => "$id"],200);
            }else{
                return response()->json(['response' => true,'message' => 'No Result Founds','data'=>(object)array()],200);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function updatecounttime(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'booking_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('booking_id');

            $booking = \DB::table('booking')->where('booking_id', $id)->first();
            if(!empty($booking)){

                $datas['totaltime']=$request->input('counttime');
                $this->BookingModel->updateWithId($datas,$id,'booking_id');
                return response()->json(['response' => true,'message' => 'success'],200);
            }else{
                return response()->json(['response' => true,'message' => 'No Result Founds','data'=>(object)array()],200);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function push_Notification($token,$id,$msg,$type,$title){
        $device_id=$token;
        $title=$title;
        $message=$msg;
        $booking_id=$id;
        $message_final = array(
            'title' => $title,
            'body' => $message,

            'sound' => 'Default',
            'image' => 'Notification Image',
        );
        if($device_id)
        {
            $fields = array(
                'to' => $device_id,
                'notification' => $message_final,

                'data' => array (
                    "booking_id" => $booking_id,
                    "type" => $type
                ),
                'android_channel_id'=>'suds2u',
                'priority' => 'high',
                'content_available' => true
            );
        }

        $url = 'https://fcm.googleapis.com/fcm/send';
        //$api_key = 'AAAAinqmE8A:APA91bHRucjXF2cqL-meJy4TsN2QOYNZSUJ9eLrOd96dypwkxw5lfUyFCuirjK1EoR8jfqniLzOssyRzqwd_4tucj6wDpQOHd61_szKaYxE58MQHRa1O2ITXjnFHA2lZDj6sP6fA_dZY';
        $api_key = 'AAAAvP7_hT0:APA91bG6RP5_MKHdGUUzImUTr6RMU0q-yafqEjWlY9TWLaNsedKVucHRZN1vYPNzecIC4exu-7fLQI8NyKnrZbNu_zH262QTQXFuK6-m1Sioln0EurF3XIgvEtT0lb7F4nGEMPoaJNFG';
        $headers = array(
            'Authorization: key=' .$api_key ,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        //echo "<pre>";print_r($result);exit;
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        $result;

        return;
    }

    public function addMoreTime(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            'extra_time'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('booking_id');
            $booking = \DB::table('booking')->where('booking_id', $id)->first();


            if(!empty($booking)){
                $datas['extra_time']=$request->input('extra_time');
                $this->BookingModel->updateWithId($datas,$id,'booking_id');
                $bookinga = \DB::table('booking')->where('booking_id', $id)->first();

                $cUser = $this->User->get_first_record($booking->user_id,'id');

                $msg=$user->name. ' add more ' . $request->input('extra_time') / 60 . ' min';
                $title='Add more time';
                $type='10';

                if(!empty($cUser->remember_token)){
                    $notification=$this->push_Notification($cUser->remember_token,$id, $msg, $type, $title);
                }

                return response()->json(['response' => true,'message' => 'success','data'=>$bookinga],200);
            }
            else{
                return response()->json(['response' => true,'message' => 'No Result Founds','data'=>(object)array()],200);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function reminder(){
        date_default_timezone_set("Asia/Calcutta");
        $user=BookingModel::join('users','booking.user_id','=','users.id')->get();
        if(!empty($user)){
            foreach($user as $rows){

                if($rows['booking_date']==date('Y-m-d')){
                    $time=$rows['booking_time'];
                    $currenttime=date('h:i A',strtotime($time . ' -15 minutes'));

                    if($currenttime==date('h:i A')){
                        $msg=$rows['name']. 'this booking arriving after 15 min';
                        $type='5';
                        $title='booking arriving';
                        $user = \DB::table('users')->where('id', $rows['washer_id'])->first();
                        BookingModel::where(['users.id'=>$rows['user_id'],'booking.washer_id'=>$rows['washer_id']])->update(['status'=>3]);
                        if(!empty($user->remember_token)){

                            $notification=$this->push_Notification($user->remember_token,$rows['booking_id'],$msg,$type,$title);

                            // print_r($notification);
                        }
                    }
                }
            }
        }
    }

    public function todaybookinreminder(){
        date_default_timezone_set("Asia/Calcutta");
        $user=BookingModel::join('users','booking.user_id','=','users.id')->where(['booking_date'=>date('Y-m-d')])->groupBy('washer_id')->get();
        if(!empty($user)){
            foreach($user as $key=> $rows){

                $user = \DB::table('users')->where('id', $rows['washer_id'])->first();
                $msg= 'Today Booking';
                $type='Booking';
                $title='booking arriving';
                if(!empty($user->remember_token)){
                    $notification=$this->push_Notification($user->remember_token,$rows['booking_id'],$msg,$type,$title);
                }

            }
        }
    }

    public function onMyWay(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [


            'user_id'=>'required',
        ]);
        if ($validator->passes()) {

            $user_id=$request->input('user_id');
            $washer_id=$request->input('washer_id');
            $booking_id=$request->input('booking_id');
            $user=BookingModel::join('users','booking.user_id','=','users.id')->where(['users.id'=>$user_id,'booking.washer_id'=>$washer_id,'booking_id'=>$booking_id])->orderBy('booking.booking_id', 'DESC')->first();

            $msg= 'Congratulations! washer is on the way ';
            $type='4';
            $title='On My Way';

            if(!empty($user->remember_token)){
                BookingModel::where(['booking.user_id'=>$user_id,'booking.washer_id'=>$washer_id,'booking_id'=>$booking_id])->update(['status'=>2]);
                $notification=$this->push_Notification($user->remember_token,$user->booking_id,$msg,$type,$title);
                $message = $title;
                $to_name=$user->name;
                $to_email=$user->email;
                $mail_data=array('to_name'=>$to_name,'to_email'=>$to_email,'messages'=>$title,'title'=>'SUDS-2-U.COM');
                Mail::send('mail.usermessage',$mail_data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)
                        ->subject('On My Way');
                });
                return response()->json(['response' => true,'message' => 'success'],200);
            }else{
                return response()->json(['response' => true,'message' => 'No Result Founds','data'=>(object)array()],200);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function user_complete_profile(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'preferred_method_of_contact' => 'required',
            'complete_address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);

            $cityData = DB::table('cities')->where('id','=', $request->input('city'))->select('status')->first();

            if($cityData->status == 1) {

                $data['phone_number']=$request->input('mobile');
                $data['preferred_method_of_contact']=$request->input('preferred_method_of_contact');
                $data['complete_address']=$request->input('complete_address');
                $data['city']=$request->input('city');
                $data['state']=$request->input('state');
                $data['country']=$request->input('country');
                $data['user_id']=$request->input('user_id');
                $id=$request->input('user_id');
    
                if (Input::hasFile('image')){
    
                    $file = Input::file('image');
                    $name = $file->getClientOriginalName();
    
    
                    $image = Image::make(Input::file('image')->getRealPath());
                    $image->save(public_path() . '/profile/' . $file->getClientOriginalName());
    
                    $datauser['image'] = $name;
                    $datauser['mobile'] = $request->input('mobile');
                    $this->User->updateWithId($datauser,$id,'id');
                }
    
    
                $user=$this->UserDetailsModel->get_first_record($id,'user_id');
                if(!empty($user)){
    
                    $this->UserDetailsModel->updateWithId($data,$id,'user_id');
                    return response()->json(['response' => true,'message' => 'success'],201);
    
                }else{
    
                    $user= $this->UserDetailsModel->create($data);
                }
                if($user){
                    return response()->json(['response' => true,'message' => 'success'],201);
                }else{
                    return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
                }
            } else {
                $city = DB::table('washer_no_cities')->insert(array("city_id" => $request->input('city')));
                return response()->json(['response' => false,'message' => 'Suds-2-u is not available in your city.','data'=>array()],400);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function removeVehicle(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('id');
        $this->Vehicle->deleteRecord($id,'vehicle_id');
        return response()->json(['response' => true,'message' => 'success'],201);
    }

    public function categories(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $category=$this->Category->all();
        if(!empty($category)){
            return response()->json(['response' => true,'message' => 'success','data'=>$category],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function subcategory(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('category_id');
        $subcate=$this->Subcategory->get_record($id,'category_id');
        if(!empty($subcate)){
            return response()->json(['response' => true,'message' => 'success','data'=>$subcate],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }

    public function demandpackagesdetails(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'vendor_id'=>'required',

        ]);
        if ($validator->passes()) {
            $id=$request->input('vendor_id');
            $doc = \DB::table('user_packages')->where('user_id', $id)->get();
            if(!empty($doc)){

                return response()->json(['response' => true,'message' => 'success','data'=>$doc],200);
            }else{
                return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function  automaticallyShowVendor(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            'lat'=>'required',
            'long'=>'required',
        ]);
        if ($validator->passes()) {
            $latitude= $request->input('lat');
            $longitude= $request->input('long');

            $raw = DB::raw('( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( users.latitude ) ) ) ) AS distance , users.*');

            $radius = DB::table('radius')->select('radius')->first();

            // echo "<pre>";
            // print_r($radius->radius);
            // exit;

            if($request->input('status') == 0) {
                $washer = \DB::table('users')->addSelect($raw)->where('users.onlinestatus', '=' , 1)->where('users.role_as', 2)->where('users.latitude','!=','')->where('users.longitude','!=','')->having('distance', '<', $radius->radius)->orderBy('distance','asc')->get();
                if(!empty($washer)){
                    return response()->json(['response' => true,'message' => 'success','data'=>$washer], 200);
                } else {
                    return response()->json(['response' => false,'message' => 'No Washers around at the moment.','data'=>array()],400);
                }
            } else {
                $washer = \DB::table('users')->addSelect($raw)->where('users.onlinestatus','=',1)->where('users.role_as',2)->where('users.latitude','!=','')->where('users.longitude','!=','')->having('distance', '<', $radius->radius)->orderBy('distance','asc')->get();

                // echo "<pre>";
                // print_r($washer); exit;
                //  $washer = \DB::table('users')->addSelect($raw)->join('booking','booking.washer_id','=','users.id')->whereNotIn('booking.status', [0,1,2,3,4])->where('users.onlinestatus','=',1)->where('users.role_as',2)->where('users.latitude','!=','')->where('users.longitude','!=','')->orderBy('distance','asc')->first();
                
                if(!empty($washer)){

                    // $book=DB::table('booking')->where(['washer_id'=>$washer->id])->whereBetween('status', [1, 4])->get();
                    // if(count($book)>0) {
                    //     return response()->json(['response' => false,'message' => 'Washers around you are booked at the moment.','data'=>array()],400);
                    // } else {
                    //     return response()->json(['response' => true,'message' => 'success','data'=>$washer],200);
                    // }

                    $availableWasher = array();
                    foreach ($washer as $key => $value) {
                        $book=DB::table('booking')->where(['washer_id'=>$value->id])->whereBetween('status', [1, 4])->get();
                        if(count($book) == 0) {
                            array_push($availableWasher, $value);
                        }
                    }
                    
                    if(count($availableWasher) == 0) {
                        //return response()->json(['response' => false,'message' => 'Washers around you are booked at the moment.','data'=>array()],400);
                        return response()->json(['response' => false,'message' => 'Already Booked','data'=>array()],400);
                    } else {
                        
                        $booking = \DB::table('booking')->whereBetween('status', [0, 4])->where('washer_id', $availableWasher[0]->id)->where(['booking_date'=>date('Y-m-d')])->get();
                        if(count($booking) >0) {
                            return response()->json(['response' => false,'message' => 'Already Booked'],400);
                        }

                        return response()->json(['response' => true,'message' => 'success','data'=>$availableWasher[0]],200);
                    }

                }else{
                    return response()->json(['response' => false,'message' => 'No Washers around at the moment.','data'=>array()],400);
                }
            }
        }
    }

    public function paymentorder(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [


            'amount'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {

            $data1 = $request->except([
                '_token'
            ]);

            $amount=$request->input('amount');
            $user_id=$request->input('user_id');
            $booking_id=$request->input('booking_id');
            $strinv = "suds";
            $orderid = $strinv.$booking_id;


            $users=$this->User->where(array('id'=>$user_id));
            $customer_id= $email='';
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new \Stripe\StripeClient(
                'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
            );

            if(!empty($users)){
                $email=$users[0]->email;
                if(!empty($users[0]->secretkey)){
                    $customer_id=$users[0]->secretkey;
                }else{
                    $customer = \Stripe\Customer::create(
                        ['email'=>$email,"description" => "Make payment and chill."]
                    );
                    $customer_id= $customer->id;
                }

            }


            $result=$stripe->customers->all(['email'=>$email]);

            if(count($result)>0){

                $ephemeralKey = \Stripe\EphemeralKey::create(
                    ['customer' => $result['data'][0]->id],
                    ['stripe_version' => '2020-08-27']
                );
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => $amount,
                    'currency' => 'usd',
                    'customer' =>  $result['data'][0]->id
                ]);
                $stripe->customers->createSource(
                    $customer_id,
                    ['source' => 'tok_amex']
                );
                $res= response()->json([
                    'paymentIntent' => $paymentIntent->client_secret,
                    'ephemeralKey' => $ephemeralKey->secret,
                    'customer' => $result['data'][0]->id,
                    'response' => true,
                    'message' => 'payment successfully send',
                ],200);

            }else{

                //   $customer = \Stripe\Customer::create(
                //      ['email'=>$email,"description" => "Make payment and chill."]
                //      );

                $ephemeralKey = \Stripe\EphemeralKey::create(
                    ['customer' => $customer_id],
                    ['stripe_version' => '2020-08-27']
                );
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => $amount,
                    'currency' => 'usd',
                    'customer' => $customer_id
                ]);


                $stripe->customers->createSource(
                    $customer_id,
                    ['source' => 'tok_amex']
                );
                $res= response()->json([
                    'paymentIntent' => $paymentIntent->client_secret,
                    'ephemeralKey' => $ephemeralKey->secret,
                    'customer' =>$customer_id,
                    'response' => true,
                    'message' => 'payment successfully send',
                ],200);
            }

            $balance_transaction='txn_'.rand();
            $status='succeeded';
            if($status == 'succeeded')
            {


                $userspayment=$this->User->find($user_id);
                $camount=0;
                if(!empty($userspayment)){
                    $books=BookingModel::where(['user_id'=>$user_id])->orderBy('booking_id', 'DESC')->first();

                    $washer_id=0;
                    $per=0;$adc=0;
                    $booking_ids=0;
                    if(!empty($books)){
                        $washer_id=$books->washer_id;
                        $percentage=DB::table('percentage')->where(['washer_id'=>$washer_id])->first();
                       
                        if(!empty($percentage)){
                            $camount=$amount*$percentage->vendor_percentage/100;
                            $per=$percentage->vendor_percentage;
                            $adc=$percentage->admin_percentage;
                        }
                        //dd($per);

                        $booking_ids=$books->booking_id;
                        $user = \DB::table('users')->where('id', $washer_id)->first();
                        // if(!empty($user)){
                        //     if(!empty($user->remember_token)){ 
                        //          $msg='Payment done';
                        //          $type='Payment Completed';
                        //          $title='Payment';
                        //         $this->push_Notification($user->remember_token,$booking_ids,$msg,$type,$title);
                        //     }
                        // }

                    }


                    TransactionsModel::insert(array('from_id'=>$user_id,'to_id'=>$washer_id,'request_id'=>$booking_ids,'amount'=>$amount,'commmison'=>$per,'admin_comission'=>$adc,'washer_amt'=>$camount,'txn_id'=>$paymentIntent->id,'status'=>0,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));

                    UserModel::where(['id'=>$washer_id])->update([
                        'total_amount' => \DB::raw('total_amount + '.$amount),
                        'wallet_amount' => \DB::raw('wallet_amount + '.$amount)
                    ]);
                }

                return   $res;

            }else{
                return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
            }

        }
    }

    public function liveTracking(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'lat'=>'required',
            'long'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {

            $data1 = $request->except([
                '_token'
            ]);
            $user_id=$request->input('user_id');

            $lat=$request->input('lat');
            $long=$request->input('long');
            UserModel::where(['id'=>$user_id])->update([
                'latitude' => $lat,
                'longitude' => $long
            ]);
            return response()->json(['response' => true,'data'=>array('latitude' => $lat,'longitude'=>$long)],200);

        }
    }

    public function getWasherLocation(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'washer_id'=>'required',

        ]);
        if ($validator->passes()) {

            $data1 = $request->except([
                '_token'
            ]);
            $user_id=$request->input('washer_id');
            $data=DB::table('users')->select('id','latitude','longitude')->where(['id'=>$user_id,'role_as'=>2])->get();

            if($data){
                return response()->json(['response' => true,'data'=>$data],200);
            }else{
                return response()->json(['response' => false,'message'=>'Something Went Wrong'],400);
            }
        }

    }

    public function rewards(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',

        ]);
        if ($validator->passes()) {

            $data1 = $request->except([
                '_token'
            ]);
            $user_id=$request->user_id;
            $reward_amount=$request->reward_amount;
            $washer_id=$request->washer_id;

            $result=DB::table('reward')->where(['user_id'=>$user_id])->get();

            return response()->json(['response' => true,'data'=>$result,'count'=>count($result)],200);

        }
    }

    public function deleteBooking(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            'booking_id'=>'required',

        ]);
        if ($validator->passes()) {

            $data1 = $request->except([
                '_token'
            ]);

            $booking_id=$request->input('booking_id');
            BookingModel::where(['booking_id'=>$booking_id])->delete();
            return response()->json(['response' => true,'message'=>'booking deleted'],200);
        }
    }

    public function cancelled_job(Request $request){

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'user_id' => 'required'


        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);

            $booking_id=$request->input('booking_id');
            $data['user_id']=$request->input('user_id');
            $datas['status']=7;
            $id=$request->input('user_id');
            $booking = \DB::table('booking')->where('booking_id', $booking_id)->where('status', 0)->first();

            if(!empty($booking)){
                \DB::table('booking')->where('booking_id', $booking_id)->update($datas);

                $user = \DB::table('users')->where('id', $booking->washer_id)->first();

                if(!empty($user)){
                    $user1 = \DB::table('users')->where('id',  $booking->user_id)->first();

                    $msg=$user1->name. ' have Cancelled  job';
                    $type='8';
                    $title='Cancelled job request';
                    $this->push_Notification($user->remember_token,$booking_id,$msg,$type,$title);
                }

                return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'Job is not available'],201);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function getFinishedJobImage(Request $request){
        $validator = Validator::make($request->all(), [

            'user_id' => 'required'


        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);


            $user_id=$request->input('user_id');
            $finish=$this->FinishedbookingModel->where(['user_id'=>$user_id]);

            return response()->json(['response' => true,'message' => 'sucess','data'=>$finish,'url'=>url('public/job/')],201);

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function userImage(Request $request){
        $validator = Validator::make($request->all(), [

            'user_id' => 'required'
        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);


            $user_id=$request->input('user_id');

            if (Input::hasFile('image')){

                $file = Input::file('image');
                $name = $file->getClientOriginalName();

                $image = Image::make(Input::file('image')->getRealPath());
                $image->save(public_path() . '/profile/' . $file->getClientOriginalName());
                $imagename = $name;
            }else{
                $imagename = '';
            }

            $finish= $this->User->update(array('image'=>$imagename),$user_id);
            //   if(!empty($finish)){
            return response()->json(['response' => true,'message' => 'sucess'],201);
            //   }else{
            //         return response()->json(['response' => false,'message' => 'Something went wrong'],201);
            //   }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function cardDetails(Request $request){

        $validator = Validator::make($request->all(), [

            'email' => 'required'
        ]);
        if ($validator->passes()) {
            $data1 = $request->except([
                '_token'
            ]);


            $email=$request->input('email');
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new \Stripe\StripeClient(
                'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
            );
            $result=$stripe->customers->all(['email'=>$email]);
            $results=array();
            foreach($result as $rows){

                $results[]=$stripe->customers->allSources(
                    $rows['id'],
                    ['object' => 'card', 'limit' => 5]
                );

            }

            if(count($results)>0){
                return response()->json(['response' => true,'message' => 'sucess','data'=>$results],201);
            }else{
                return response()->json(['response' => false,'message' => 'Something went wrong','data'=>array()],201);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function testsms(){
        //1-432-557-3382
        //$this->sms('test',14325573382);
        $id = "ACcad39ba7d08eac53c181194c238d7824";
        $token = "24e3e3d7235764135ecf9ad717a2d7da";
        $url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
        $from = "+15202145984";
        $to = "+15125868786"; // twilio trial verified number
        $body = "using twilio rest api from Fedrick";
        $data = array (
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url );
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        curl_close($x);
        var_dump($post);
        var_dump($y);

    }

    public function getPromotions(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $id=$request->input('user_id');
        $rewardresult=DB::table('reward')->where('user_id',$id)
            ->select('user_id','created_at', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get();

        if(count($rewardresult)>0){

            if($rewardresult[0]->total>=10){

                $data=PromotionsModel::where('end_date','>=',date('Y-m-d'))->get();
            }else{
                $data=PromotionsModel::where('end_date','>=',date('Y-m-d'))->where(['type'=>'normal'])->get();
            }
        }else{
            $data=PromotionsModel::where('end_date','>=',date('Y-m-d'))->where(['type'=>'normal'])->get();
        }


        //$data=PromotionsModel::where('end_date','>=',date('Y-m-d'))->where(['type'=>'free'])->get();
        if(count($data)>0){
            return response()->json(['response' => true,'message' => 'sucess','data'=>$data],201);

        }else{
            return response()->json(['response' => false,'message' => 'data not available','data'=>array()],400);
        }
    }

    public function  get_washser(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'lat'=>'required',
            'long'=>'required',

        ]);
        // if ($validator->passes()) {
        $latitude= $request->input('lat');
        $longitude= $request->input('long');




        $raw = DB::raw('( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( users.latitude ) ) ) ) AS distance , users.*');

        $washer = \DB::table('users')->addSelect($raw)->where('users.onlinestatus','=',1)->where('users.role_as',2)->where('users.latitude','!=','')->where('users.longitude','!=','')->orderBy('distance','asc')->get();

        //  $washer = \DB::table('users')->addSelect($raw)->join('booking','booking.washer_id','=','users.id')->whereNotIn('booking.status', [0,1,2,3,4])->where('users.onlinestatus','=',1)->where('users.role_as',2)->where('users.latitude','!=','')->where('users.longitude','!=','')->orderBy('distance','asc')->first();


        if(count($washer)>0){

            $book=DB::table('booking')->where(['washer_id'=>$washer[0]->id])->whereBetween('status', [0, 4])->get();

            if(count($book)>0){

                return response()->json(['response' => false,/*'message' => 'Washers around you are booked at the moment.',*/'data'=>array()],400);
            }else{

                return response()->json(['response' => true,'message' => 'success','data'=>$washer],200);
            }
        }else{
            return response()->json(['response' => false,/*'message' => 'Washers around you are booked at the moment.',*/'data'=>array()],400);
        }

        // }
    }

    public function sendingSms(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'from_id'=>'required',
            'to_id'=>'required',
            'message'=>'required',
            'type'=>'required',

        ]);
        if ($validator->passes()) {
            $from_id= $request->input('from_id');
            $to_id= $request->input('to_id');
            $message= $request->input('message');
            $type= $request->input('type');


            $user=$this->User->where(array('id'=>$to_id))->first();
            if(!empty($user)){
                $smsRes = $this->sms($message,$user->mobile);
                \DB::table('sms')->insert(array('from_id'=>$from_id,'to_id'=>$to_id,'type'=>$type,'message'=>$message,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));

                return response()->json(['response' => true,'message' => 'success', 'smsRes' => $smsRes],200);
            }else{
                return response()->json(['response' => false,'message' => 'Something went wrong'],201);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }
    
    public function sendSms(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            'to_id'=>'required',
            'message'=>'required',
        ]);
        if ($validator->passes()) {
            $to_id= $request->input('to_id');
            $message= $request->input('message');
            $smsRes = $this->sms($message,$to_id);
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function getSms(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'from_id'=>'required',
            'to_id'=>'required',
        ]);
        if ($validator->passes()) {
            $sms=\DB::table('sms')->where(array('from_id'=>$request->input('from_id'),'to_id'=>$request->input('to_id')))->get();
            if(count($sms)>0){
                return response()->json(['response' => true,'message' => 'success','data'=>$sms],200);
            }else{
                return response()->json(['response' => false,'message' => 'Something went wrong','data'=>array()],201);
            }

        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function sms_msg(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $message='Your OTP is';
        Mail::send('mail.otp',$data,function($message) use ($to_name,$to_email){
        	$message->to($to_email)
        	->subject('Verification otp');
        });
        $this->sms($message,$request->input('mobile'));
        echo "send";
    }

    public function setStatus(){
        $where=DB::table('booking')->where('status',0)->get();

        if(count($where)>0){
            foreach($where as $rows){

                if($rows->booking_date==date('Y-m-d')){


                    //  DB::table('booking')->where('booking_id',$rows->booking_id)->where('booking_date',date('Y-m-d'))->update(array('status'=>6));
                    //  date_default_timezone_set('Africa/Addis_Ababa'); 
                    date_default_timezone_set('Asia/Calcutta');

                    $tarr = explode(':', $rows->booking_time);
                    if(strpos( $rows->booking_time, 'AM') === false && $tarr[0] !== '12'){
                        $tarr[0] = $tarr[0] + 12;
                    }elseif(strpos( $rows->booking_time, 'PM') === false && $tarr[0] == '12'){
                        $tarr[0] = '00';
                    }
                    $repl= preg_replace("/[^0-9 :]/", '', implode(':', $tarr));

                    $bokkin=date($rows->booking_date.' '.$repl);
                    $date = $rows->booking_date.' '.$rows->booking_time;
                    $book = date("Y-m-d H:i:s",strtotime($bokkin." +5 minutes"));


                    $cur=date("Y-m-d H:i:s");

                    if(strtotime($book)>=strtotime($cur)){
                        echo "available";
                    }else{
                        DB::table('booking')->where('booking_id',$rows->booking_id)->where('booking_date',date('Y-m-d'))->update(array('status'=>6));
                        $user = \DB::table('users')->where('id', $rows->booking_id)->first();
                        $msg='Reject your job';
                        $type='3';
                        $title='Reject job request';
                        $this->push_Notification($user->remember_token,$rows->booking_id,$msg,$type,$title);
                        echo "update";

                    }
                }else{
                    echo "not available";
                }
            }
        }
    }

    public function distance(){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $setting=DB::table('setting')->get();
        if(count($setting)>0){
            return response()->json(['response' => true,'message' => 'success','data'=>$setting],200);
        }else{
            return response()->json(['response' => false,'message' => 'Something went wrong','data'=>array()],201);
        }
    }

    public function extratime(){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $setting=DB::table('extra_min_hours')->get();
        if(count($setting)>0){
            $data=array();
            foreach($setting as $rows){
                $data[]=array('id'=>$rows->id,'min_hours'=>$rows->min_hours,'extra_time'=>$rows->extra_time,'price'=>(int)$rows->price,'created_at'=>$rows->created_at,'updated_at'=>$rows->created_at);
            }

            return response()->json(['response' => true,'message' => 'success','data'=>$data],200);
        }else{
            return response()->json(['response' => false,'message' => 'Something went wrong','data'=>array()],201);
        }
    }

    public function service(){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $setting=DB::table('service')->first();
        if(!empty($setting)){
            return response()->json(['response' => true,'message' => 'success','data'=>$setting],200);
        }else{
            return response()->json(['response' => false,'message' => 'Something went wrong','data'=>array()],201);
        }
    }

    public function addCardDetails(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $card_number=$request->card_number;
        $holder_name=$request->holder_name;
        $expiry_month=$request->expiry_month;
        $expiry_year=$request->expiry_year;
        $cvv_no=$request->cvv_no;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(
            'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
        );

        // $create=$stripe->tokens->create([
        //   'bank_account' => [
        //     'country' => 'US',
        //     'currency' => 'usd',
        //     'account_holder_name' => 'Jenny Rosen',
        //     'account_holder_type' => 'individual',
        //     'routing_number' => '110000000',
        //     'account_number' => '000123456789',
        //   ],
        // ]);
        //   $customer = \Stripe\Customer::create(
        //              ['email'=>'sudstest1@gmail.com',"description" => "Make payment and chill."]
        //              );
        //  $stripe= $stripe->customers->createSource(
        //                 $customer->id,
        //               ['source' => 'tok_amex']
        //             );
        // $str=$stripe->customers->updateSource(
        //         $customer->id,
        //      $stripe->id,
        //       ['name' => 'Jenny Rosen','address_city'=>'indore','exp_month'=>10,'exp_year'=>2021]
        //     );

        $str= $stripe->tokens->create([
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 9,
                'exp_year' => 2022,
                'cvc' => '314',
            ],
        ]);

        $stripe->tokens->create([
            'bank_account' => [
                'country' => 'US',
                'currency' => 'usd',
                'account_holder_name' => 'Jenny Rosen',
                'account_holder_type' => 'individual',
                'routing_number' => '110000000',
                'account_number' => '000123456789',
            ],
        ]);
        return response()->json(['response' => true,'message' => 'success','data'=>$str],200);
    }

    public function getWasherCalendar(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'washer_id'=>'required',


        ]);
        $where=BookingModel::where(['washer_id'=>$request->input('washer_id')])->whereBetween('status', [1, 4])->get();
        if(!empty($where)){
            $data=array();
            foreach($where as $rows){
                $data=array('booking_id'=>$rows->booking_id,'user_id'=>$rows->user_id,'washer_id'=>$rows->washer_id,'booking_date'=>$rows->booking_date,'booking_time'=>$rows->booking_time,'status'=>$rows->status);
            }
        }
        return response()->json(['response' => true,'message' => 'success','data'=>$data],200);


    }

    public function getClientSecret(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }

        $id=$request->input('user_id');

        $user=$this->User->find($id);
        if(!empty($user)){

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripe = new \Stripe\StripeClient(
                'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
            );


            $setup_intent = \Stripe\SetupIntent::create([
                'customer' => $user->secretkey
            ]);
            $client_secret = $setup_intent->client_secret;

            return response()->json(['response' => true,'message' => 'success','key'=>$client_secret],200);
        }else{
            return response()->json(['response' => false,'message' => 'not found'],200);
        }
        return response()->json(['response' => false,'message' => 'Something went wrong','data'=>array()],201);
    }

    public function addReviewRating(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $user_id=$request->input('user_id');
        $washer_id=$request->input('washer_id');
        $review=($request->input('review')!='') ? $request->input('review') : '';
        $rating=($request->input('rating')!='') ? $request->input('rating') : '';
        $request_id=$request->input('request_id');
        $tip=$request->input('tip');

        $reviews=DB::table('review')->insert(array('from_id'=>$user_id,'to_id'=>$washer_id,'request_id'=>$request_id,'comment'=>$review,'rating'=>$rating,'created_date'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')));
        
        if($tip!='') {
        $booking = DB::table('booking')->where(array('booking_id' => $request_id))->update(array('booking_tip' => $tip));
        }

        $washer = DB::table('users')->where('id', '=', $washer_id)->first();

        $title = 'Review & Rate';
        $type = '12';
        $msg = $user->name . ' added the review & rate for your job.';

        $this->push_Notification($washer->remember_token, $request_id, $msg, $type, $title);
        if(!empty($reviews) || !empty($booking)){
            return response()->json(['response' => true,'message' => 'success'],200);
        }else{
            return response()->json(['response' => false,'message' => 'Something went wrong'],201);
        }
    }

    public function cancelRequestBill(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $booking_id=$request->input('booking_id');
        $user_id=$request->input('user_id');
        $amount=$request->input('amount');
        $booking=\DB::table('booking')->where('booking_id', $booking_id)->whereBetween('status', [1, 7])->first();

        if(!empty($booking)){
            $v=\DB::table('cancel_booking')->where(['booking_id'=>$booking_id])->get();
            if(count($v) > 0){
                return response()->json(['response' => false,'message' => 'Booking already cancelled'],201);
            }else{
                \DB::table('cancel_booking')->insert( array('booking_id'=>$booking_id, 'user_id'=>$user_id,'amount'=>$amount,'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')));
                DB::table('booking')->where('booking_id', $booking_id)->update(array('status' => 7));
                $user1 = \DB::table('users')->where('id',  $booking->washer_id)->first();
                $msg= $user->name. ' have cancel the job';
                $type='8';
                $title='Cancel job request';
                $this->push_Notification($user1->remember_token,$booking_id,$msg,$type,$title);
                $message = $user->name. ' have cancel the job';
                $to_name=$user1->name;
                $to_email=$user1->email;
                $mail_data=array('to_name'=>$to_name,'to_email'=>$to_email,'messages'=>$title,'title'=>'SUDS-2-U.COM');
                Mail::send('mail.usermessage',$mail_data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)
                        ->subject('Cancel job request');
                });

                return response()->json(['response' => true,'message' => 'Booking cancelled'],200);
            }
        }else{
            \DB::table('booking')->where(['booking_id'=>$booking_id])->update(array('status'=>7));
            return response()->json(['response' => false,'message' => 'Request has been cancelled by the customer.'],200);
        }
    }

    public function bookingNotificationBefore(Request $request) {
        $booking = $this->BookingModel->all();
        echo "<pre>";
        print_r($booking); exit;
    }

    public function getWasherSchedule(Request $request)
    {
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        if(empty($request->washer_id)){
            $request->washer_id = $user->id;
            $request->request->add(['washer_id' => $user->id]);
        }
        $validator = Validator::make($request->all(), [
            'washer_id'=>'required',
            'date'=>'required'
        ]);

        if ($validator->passes()) {

            $id = $request->input('washer_id');
            
            $date = $request->input('date');

            $washer = DB::table('users')->where('id', '=', $id)->where('onlinestatus', '=', 1)->get();
            if(count($washer) > 0) {
                $booking = DB::table('booking')->where('washer_id','=', $id)->whereDate('booking_date', '=', $date)->select('booking_time', 'package')->get();
                // $booking = DB::table('booking')->where('washer_id','=', $id)->join('user_packages', 'user_packages.id', '=', 'booking.package')->whereDate('booking_date', '=', $date)->select('booking.booking_time', 'user_packages.type')->get();
                
                if(count($booking) > 0) {
                    $bookingTime = array();
                    //$count = 0;
                    $time_v ='0';
                    foreach ($booking as $key => $value) {
                        $timeS = array();
                        if($value->package) {
                            $packageType = DB::table('user_packages')->where('id', '=', $value->package)->select('type','price')->first();
                            // if($packageType->type == 'Bronze') {
                            //     $time = '00:30';
                            // } else 
                            if ($packageType->type == 'Silver') {
                                // $time = '01:00';
                                $time_v = '60';
                                array_push($timeS, Carbon::parse($value->booking_time)->format('H:i'));
                                $time =Carbon::parse($value->booking_time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time);
                                $time1 = Carbon::parse($time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time1);
                            } 
                            else if ($packageType->type == 'Gold') {
                                // $time = '01:30';
                                $time_v = '90';
                                array_push($timeS, Carbon::parse($value->booking_time)->format('H:i'));
                                $time = Carbon::parse($value->booking_time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time);
                                $time1 = Carbon::parse($time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time1);
                                $time2 = Carbon::parse($time1)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time2);
                            } 
                            else if ($packageType->type == 'Diamond') {
                                // $time = '02:00';
                                $time_v = '180';
                                array_push($timeS, Carbon::parse($value->booking_time)->format('H:i'));
                                $time = Carbon::parse($value->booking_time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time);
                                $time1 = Carbon::parse($time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time1);
                                $time2 = Carbon::parse($time1)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time2);
                                $time3 = Carbon::parse($time2)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time3);
                                $time4 = Carbon::parse($time3)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time4);
                                $time5 = Carbon::parse($time4)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time5);

                            } 
                            else if ($packageType->type == 'Platinuim') {
                                // $time = '02:30';
                                $time_v = '120';
                                array_push($timeS, Carbon::parse($value->booking_time)->format('H:i'));
                                $time = Carbon::parse($value->booking_time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time);
                                $time1 = Carbon::parse($time)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time1);
                                $time2 = Carbon::parse($time1)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time2);
                                $time3 = Carbon::parse($time2)->addMinutes(30)->format('H:i');
                                array_push($timeS, $time3);
                            }
                            $timeSet['timeset'] = array('name'=>$packageType->type,'price'=>$packageType->price,'time'=>$time_v);
                        } else {
                            array_push($timeS, Carbon::parse($value->booking_time)->format('H:i'));
                        }
                        //$count++;
                        $timeSet['time']   = $timeS;
                        $bookingTime[$key] = $timeSet;
                    }
                    
                    return response()->json(['response' => true, 'message' => 'success' , 'data' => $bookingTime, 'available' => true] ,200);
                } 
                else {
                    return response()->json(['response' => true, 'message' => 'data not found!.', 'data' => array(), 'available' => true],200);
                }
            } else {
                return response()->json(['response' => true, 'message' => 'Today washer is not available.', 'available' => false],200);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }

    public function callingWasher(Request $request)
    {
        $message = "Call by vpn";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/ACcad39ba7d08eac53c181194c238d7824/Calls.json',
            // https://conversations.twilio.com/v1/Conversations
            // CURLOPT_URL => 'https://conversations.twilio.com/v1/Conversations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS => 'From=%2B15202145984&To=%2B919913448692&Url=https://suds-2-u.com/',
            CURLOPT_POSTFIELDS => 'From=%2B15202145984&To='.$request->to_id.'&Url=http://demo.twilio.com/docs/voice.xml',
            // FriendlyName=My First Conversation
            // CURLOPT_POSTFIELDS => 'FriendlyName=My First Conversation',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic QUNjYWQzOWJhN2QwOGVhYzUzYzE4MTE5NGMyMzhkNzgyNDoyNGUzZTNkNzIzNTc2NDEzNWVjZjlhZDcxN2EyZDdkYQ==',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        return $response;
    }
    
    public function wahserPayouthistory(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [

            'user_id'=>'required',
        ]);
        if ($validator->passes()) {
            $id=$request->input('user_id');
            $offset = $request->pagecount;
            $limit = 10;

            $payment = \DB::table('payment')->where('to_id', $id)->where('payout_status', 1)->orderBy('id', 'DESC')->offset($offset*$limit)->limit($limit)->get();
            if(!empty($payment)){
                $paymentdetails=array();
                foreach($payment as $b){
                    $paymentdetails[]= $this->getWasherPayoutdetails($b);
                }


                return response()->json(['response' => true,'message' => 'success','data'=>$paymentdetails],200);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            }
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }

    }

    public function getWasherPayoutdetails($b){
        $data['payment_id']=$b->id;
        $data['user_id']=$b->from_id;
        $users = \DB::table('users')->where('id', $b->from_id)->get();
        if(!empty($users)){
            $data['userdetails']=$users;
        }else{
            $data['userdetails']=(object)array();
        }
        $data['washer_amt']=$b->washer_amt;
        $data['payout_time']=$b->payout_time;
        $data['transfer_id']=$b->transfer_id;
        return $data;
    }

    public function cronBookingNotification(Request $request){
        date_default_timezone_set("Asia/Calcutta");
       $today=date('Y-m-d');
       $booking = \DB::table('booking')->where('type', 1)->where('booking_date', $today)->orderBy('booking_id','DESC')->get();
       if($booking){
        foreach ($booking as $key => $value) {
            $time=$value->booking_time;
            $currenttime=date('h:i A',strtotime($time . ' -2 hours'));
            if($currenttime==date('h:i A')){
                $msg='Remainter notification for job'.$value->booking_id.'need to start';
                $type='1';
                $title='Job Start Remainder';
                $user = \DB::table('users')->where('id', $value->washer_id)->first();
                if(!empty($user->remember_token)){

                    $notification=$this->push_Notification($user->remember_token,$value->booking_id,$msg,$type,$title);
                }
            }
        }
    }

    }
    public function reauth(Request $request,$id){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe = new \Stripe\StripeClient(
            'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
        );
        $response = $stripe->accountLinks->create([
        'account' => $id,
        'refresh_url' => 'https://suds-2-u.com/api/reauth/'.$id,
        'return_url' => 'https://suds-2-u.com/api/return',
        'type' => 'account_onboarding',
        ]);
        return $response;
    }
    public function returndata(Request $request,$id){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe = new \Stripe\StripeClient(
            'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
        );
        $response = $stripe->accountLinks->create([
        'account' => $id,
        'refresh_url' => 'https://suds-2-u.com/api/reauth/'.$id,
        'return_url' => 'https://suds-2-u.com/api/return',
        'type' => 'account_onboarding',
        ]);
        return $response;
    }
    public function payoutCron(Request $request){
        $payment=TransactionsModel::where('washer_amt', '!=' , '')->where('payout_status',0)->get();
        if(!empty($payment)){
            foreach ($payment as $key => $result) {
              
               $amount=$result->amount;
               $washer_amt=$result->washer_amt;
               $commmison=$result->commmison;
           
               
              $user=UserModel::where(['id'=>$result->to_id])->first();
            
        if($user && $user->washer_accountid !=''){
              $wallet_amount=$user->wallet_amount;//400  //320 washer 80 admn
          
              $ctotal=($wallet_amount*$result->commmison/100);
              
              $usertotal=$wallet_amount-$ctotal;
              $adc=  ($wallet_amount*$result->admin_comission)/100;
          
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new \Stripe\StripeClient(
            'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
            );

            $response = $stripe->transfers->create([
            'amount' => $washer_amt,
            'currency' => 'usd',
            'destination' => $user->washer_accountid,
            'transfer_group' => 'ORDER_'.$result->to_id,
            ]);
            if($response && $response->id!='') { 
            UserModel::where(['id'=>$result->to_id])->update([    
                        'wallet_amount' => \DB::raw('wallet_amount -'.$adc)
                        ]);
            UserModel::where(['id'=>1])->update([                   
                        'wallet_amount' => \DB::raw('wallet_amount +'.$adc)
                        ]);   
            TransactionsModel::where(['id'=>$result->id])->update([    
                        'payout_status' => 1,
                        'payout_time' => date('Y-m-d H:i:s',$response->created),
                        'transfer_id' => $response->id
                        ]);                   
            PayOutTransactionsModel::insert(array('washer_id'=>$result->to_id,'amount'=>$result->washer_amt));
            }
        }
        
          }    
           
        }

        //echo "<pre>";print_r($response);exit;
    }
    public function accountcreatewasher(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe = new \Stripe\StripeClient(
            'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
        );
       /* $response = $stripe->accounts->create([
            'type' => 'custom',
            'country' => 'US',
            'email' => 'demo@gmail.com',
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            //'individual'=> ['phone' => '804-222-1111'], 
        ]);*/
  /*   $response = $stripe->accounts->createLoginLink(
  'acct_1LBzoeRI6QRPPRxv',
  []
);*/
     /*$response = $stripe->accountLinks->create([
  'account' => 'acct_1LBzoeRI6QRPPRxv',
  'refresh_url' => 'http://localhost/dharma/suds/api/reauth/acct_1LBzoeRI6QRPPRxv',
  'return_url' => 'http://localhost/dharma/suds/api/return',
  'type' => 'account_onboarding',
]);*/
$response = $stripe->transfers->create([
  'amount' => 100,
  'currency' => 'usd',
  'destination' => 'acct_1LBzoeRI6QRPPRxv',
  'transfer_group' => 'ORDER_95',
]);
/*$response = $stripe->accounts->delete(
  'acct_1LBekSRJnmsbxncP',
  []
);*/
/*$response=Stripe\Charge::create ([
                "amount" => 10000,
                "currency" => "usd",
                "source" => "acct_1LBzoeRI6QRPPRxv",
                "description" => "Make payment and chill." 
        ]);*/
        echo "<pre>";print_r($response);exit;
    }
public function washerUnavailableSet(Request $request){
            $token = request()->header('App-Key');
            $user=$this->User->get_first_record($token,'api_token');
            if(empty($user)){
                return response()->json(['message'=>'App Key Not Found'],401);
            }
            $validator = Validator::make($request->all(), [
                'washer_id'=>'required',
                'unavailable_date'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ]);
            if ($validator->passes()) {
                $washer_id=$request->input('washer_id');
                $data['washer_id']=$request->input('washer_id');
                $data['unavailable_date']=$request->input('unavailable_date');
                $data['start_time']=$request->input('start_time');
                $data['end_time']=$request->input('end_time');
                $data['created_at']=date('Y-m-d');
                $data['updated_at']=date('Y-m-d');
        
                $result=DB::table('washer_schedule')->insert($data);
                if($result){
                        return response()->json(['response' => true,'message' => 'success'],200);
                }else{
                        return response()->json(['response' => false,'message' => 'Something went wrong'],400);
                }
            }
            else {
                return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
            }
    }   
public function getWasherUnavailable(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        if($request->date!=''){
        $setting=DB::table('washer_schedule')->where(['unavailable_date'=>$request->date])/*->groupBy('unavailable_date')*/->get();  
        } else {
        $setting=DB::table('washer_schedule')->get();   
        }
        if(!empty($setting)){
            return response()->json(['response' => true,'message' => 'success','data'=>$setting],200);
        }else{
            return response()->json(['response' => false,'message' => 'Something went wrong','data'=>array()],201);
        }
    }     
}