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
use App\CardModel;
use App\PaymenttypeModel;
use App\PaypalModel;
use Auth;
use DB;
use Hash;
use Validator;
use Input;
use Image;
use Mail;
use Carbon\Carbon;
class ApicustomerController extends Controller
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
    private $CardModel;
    private $PaymenttypeModel;
    private $PaypalModel;  
      

    public function __construct(PaypalModel $PaypalModel,AddONSModel $AddONSModel,PackageModel $PackageModel,CategoryModel $CategoryModel,UserModel $UserModel,VehicleModel $VehicleModel,SubCategoryModel $SubCategoryModel,UserDetailsModel $UserDetailsModel,CityModel $CityModel,CountryModel $CountryModel,StateModel $StateModel,BankModel $BankModel,BookingModel $BookingModel,UserdocModel $UserdocModel,UserpackagesModel $UserpackagesModel,FinishedbookingModel $FinishedbookingModel,CardModel $CardModel,PaymenttypeModel $PaymenttypeModel)
    {
        $this->PaypalModel=new UserRepository($PaypalModel);
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
           $this->CardModel=new UserRepository($CardModel);
           $this->PaymenttypeModel=new UserRepository($PaymenttypeModel);
           
    }


    public function index()
    {   
   		return response()->json(['response' => trans('true'),'message' => 'success','data'=>array()]);
    }
    
  
   
   public function washerpackagesdetails(Request $request){
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
      
       $packages = \DB::table('user_packages')->where('user_id', $id)->get();
        if(!empty($packages)){
             
            return response()->json(['response' => true,'message' => 'success','data'=>$packages],200);
        }else{
            return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
        }
        }else{
             return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }    
    }      
   
    public function vendorlist(Request $request){
           $token = request()->header('App-Key');
           $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            
            'latitude'=>'required',
             'longitude'=>'required',
            ]);
        if ($validator->passes()) {
      $latitude=$request->input('latitude');
      $longitude=$request->input('longitude');
     // $type=$request->input('type');
       $raw = DB::raw('( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$latitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance , users.*');
    //   if($type==1){
     
      $washer = \DB::table('users')->addSelect($raw)->join('user_packages','users.id','=','user_packages.user_id')->where('role_as',2)->get();
    //   }else{
    //   $washer = \DB::table('users')->addSelect($raw)->where('role_as',2)->get();    
    //   }    
      
        if(!empty($washer)){
             $washerdetails=array();
            foreach($washer as $b){
                    $washerdetails[]= $this->getwasherdetails($b);
            }
            return response()->json(['response' => true,'message' => 'success','data'=>$washerdetails],200);
        }else{
            return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
        }
        }else{
             return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
        
       } 
       
          public function getwasherdetails($b){
           $data['id']=$b->id;
           $data['name']=$b->name;
           $data['image']=$b->image;
          $rating=\DB::table('review')->where('to_id',$b->id)->selectRaw('SUM(rating)/COUNT(from_id) AS avg_rating')->first()->avg_rating;
           $numberAsString = number_format($rating, 1);
             $data['rating']=$numberAsString;
           
       
           return $data;
       }
       
       
      public function customerbookinghistory(Request $request){
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

      $booking = \DB::table('booking')->where('user_id', $id)->orderBy('booking_id', 'DESC')->offset($offset*$limit)->limit($limit)->get();
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
           $data['type']=$b->type;
           $users = \DB::table('users')->where('id', $b->washer_id)->first();
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
       
        public function vendordetails(Request $request){
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
     
      $washer = \DB::table('users')->where('id', $user_id)->first();
        if(!empty($washer)){
             $washerdetails=(object)array();
          
                    $washerdetails= $this->getsinglewasherdetails($washer);
           
            return response()->json(['response' => true,'message' => 'success','data'=>$washerdetails],200);
        }else{
            return response()->json(['response' => false,'message' => 'No Results Founds','data'=>array()],400);
        }
        }else{
             return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
        
       } 
       
          public function getsinglewasherdetails($b){
           $data['id']=$b->id;
           $data['name']=$b->name;
            $data['image']=$b->image;
             $rating=\DB::table('review')->where('to_id',$b->id)->selectRaw('SUM(rating)/COUNT(from_id) AS avg_rating')->first()->avg_rating;
        $numberAsString = number_format($rating, 1);
             $data['rating']=$numberAsString;
             
                 $images = \DB::table('finished_booking')->select('image')->where('user_id', $b->id)->get();
          
        if(!empty($images)){
              $data['images']=$images;
        }else{
            $data['images']=array();
        }
           
       
           return $data;
       }
       
       
        public function viwvendorreview(Request $request){
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
                $offset = $request->pagecount; 
                $limit = 10;
                $review = \DB::table('review')->where('to_id', $id)->offset($offset*$limit)->limit($limit)->get();
                if(!empty($review)){
                    $reviewdetails=array();
                    foreach($review as $b){
                        $reviewdetails[]= $this->getreviewdetails($b);
                    }
                return response()->json(['response' => true,'message' => 'success','data'=>$reviewdetails],200);
                } else {
                    return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
                }
            }else{
                return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
            }
        }
       
         public function getreviewdetails($b){
            $data['id']=$b->id;
            $data['from_id']=$b->from_id;
            $data['comment']=$b->comment;
            $data['rating']=$b->rating;
            $data['created_date']=$b->created_date;
            
            $user = DB::table('users')->where('id', $b->from_id)->get();
          
            if(!empty($user)){
                $data['user_details']=$user;
            }else{
                $data['user_details']=(object)array();
            }
           return $data;
        }
       
        public function savebooking(Request $request){
            $token = request()->header('App-Key');
            $user=$this->User->get_first_record($token,'api_token');
            if(empty($user)){
                return response()->json(['message'=>'App Key Not Found'],401);
            }

            // return response()->json($request->all());
            // exit;
            $validator = Validator::make($request->all(), [
                'user_id'=>'required',
            ]);
            if ($validator->passes()) {
                $id=$request->input('user_id');
                $washer_id=$request->input('washer_id');
                $data['washer_id']=$request->input('washer_id');
                $data['user_id']=$request->input('user_id');
                $data['vehicle_id']=$request->input('vehicle_id');
                $data['booking_date']=$request->input('booking_date');
                $data['booking_time']=$request->input('booking_time');
                $data['package']=$request->input('package');
                $data['extra_add_ons']=$request->input('extra_add_ons');
                $data['wash_location']=$request->input('wash_location');
                $data['coupan_code']=$request->input('coupan_code');
                $data['status']='0';  
                $data['total']=$request->input('total');
                $data['vehicle_type']=$vehicle_type=$request->input('vehicle_type');
                $lat=$request->input('lat');
                $long=$request->input('long');
                $data['type']=$request->input('type');
                $data['wash_lat']=$request->input('lat');
                $data['wash_long']=$request->input('long');
                $type=$request->input('type');
                if($vehicle_type=='7') {
                    $data['length']=$request->input('length');
                    $data['width']=$request->input('width');
                } elseif ($vehicle_type=='6') {
                   $data['hours']=$request->input('hours');
                } elseif ($vehicle_type=='5') {
                    $data['feet']=$request->input('feet');  
                } elseif ($vehicle_type=='3') {
                    $data['feet']=$request->input('feet'); 
                }
                if($request->input('coupan_code')){
                    $datac['status'] = 1;
                    \DB::table('coupan')->where('coupan_code', $request->input('coupan_code'))->update($datac);
                }
                $booking = \DB::table('booking')->whereBetween('status', [0, 4])->where('washer_id', $washer_id)->where(['booking_date'=>$request->input('booking_date')])->get();
                if(count($booking) >0) {
                    /*$user1 = \DB::table('users')->where('id', $id)->first();
                    $user = \DB::table('users')->where('id', $washer_id)->first();
                    $msg=$user1->name. ' requested for new job';
                    $type='new job request';
                    $title='job request';
                    $this->push_Notification($user->remember_token,165,$msg,$type,$title);*/
                    return response()->json(['response' => false,'message' => 'Already Booked'],400);
                } else {
                    $bookinid= $this->BookingModel->create($data);
                    //$raw = DB::raw('( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians( users.latitude ) ) ) ) AS distance , users.*');
                    
                    // $washer = \DB::table('users')->addSelect($raw)->where('users.onlinestatus','=',1)->where('users.role_as',2)->where('users.latitude','!=','')->where('users.longitude','!=','')->orderBy('distance','asc')->get();    
            
                    $user = \DB::table('users')->where('id', $washer_id)->first();
          
                    if(!empty($user)){
                        \DB::table('users')->where('id', $washer_id)->update(['latitude'=>$lat,'longitude'=>$long]);
            
                        $user1 = \DB::table('users')->where('id', $id)->first();
                        if(!empty($user->remember_token)){ 
                            $msg=$user1->name. ' requested for new job';
                            $type='new job request';
                            $title='job request';
                            $typeid=$request->input('type');
                            if($typeid==0){
                                $msg=$user1->name. ' new ondemand job request';
                                $type='0';
                                $title='New Job request of ondemand';
                            }else{
                                $msg=$user1->name. ' new scheduled job request';
                                $type='1';
                                $title='New Job request';
                            }
                            $this->push_Notification($user->remember_token,$bookinid->booking_id,$msg,'new job request',$title);

                            //send confirmation notification to user
                            $msg1='Your job posted successfully. Once washer accepted, We will notify';
                            $this->push_Notification($user1->remember_token,$bookinid->booking_id,$msg1,$type,$title);
                        }
                    }
                    return response()->json(['response' => true,'message' => 'success','booking_id'=>$bookinid->booking_id],200);
                }
            }
            else {
                return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
            }
        }
       
       
   //----------testing------------------------------//
     public function savebookingnew(Request $request){
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
       $washer_id=$request->input('washer_id');
       
        $data['washer_id']=$request->input('washer_id');
        $data['user_id']=$request->input('user_id');
        $data['vehicle_id']=$request->input('vehicle_id');
        $data['booking_date']=$request->input('booking_date');
        $data['booking_time']=$request->input('booking_time');
        $data['package']=$request->input('package');
        $data['extra_add_ons']=$request->input('extra_add_ons');
        $data['wash_location']=$request->input('wash_location');
        $data['coupan_code']=$request->input('coupan_code');
        $data['status']='0';  
       $data['total']=$request->input('total');
       $data['vehicle_type']=$vehicle_type=$request->input('vehicle_type');
       $lat=$request->input('lat');
       $long=$request->input('long');
       $data['type']=$request->input('type');
       $data['wash_lat']=$request->input('lat');
       $data['wash_long']=$request->input('long');
       $type=$request->input('type');
       
        $raw = DB::raw('( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians( users.latitude ) ) ) ) AS distance , users.*');
         
        $washer = \DB::table('users')->addSelect($raw)->where('users.onlinestatus','=',1)->where('users.role_as',2)->where('users.latitude','!=','')->where('users.longitude','!=','')->orderBy('distance','asc')->get();
       
       
       
       if($vehicle_type=='7'){
           
           $data['length']=$request->input('length');
           $data['width']=$request->input('width');
           
       }elseif($vehicle_type=='6'){
           
           $data['hours']=$request->input('hours');
       }elseif($vehicle_type=='5'){
           
          $data['feet']=$request->input('feet');  
          
       }elseif($vehicle_type=='3'){
           $data['feet']=$request->input('feet'); 
       }
       
       if($request->input('coupan_code')){
           $datac['status'] = 1;
           \DB::table('coupan')->where('coupan_code', $request->input('coupan_code'))->update($datac);
       }
       
      $booking = \DB::table('booking')->whereBetween('status', [0, 4])->where('washer_id', $washer_id)->where(['booking_date'=>$request->input('booking_date')])->get();
      
        if(count($booking) >0){
        
            
            return response()->json(['response' => false,'message' => 'Already Booked'],400);
        }else{
            
            $bookinid= $this->BookingModel->create($data);
            
           
            
        $user = \DB::table('users')->where('id', $washer_id)->first();
          
        if(!empty($user)){
            \DB::table('users')->where('id', $washer_id)->update(['latitude'=>$lat,'longitude'=>$long]);
            
             $user1 = \DB::table('users')->where('id', $id)->first();
         if(!empty($user->remember_token)){ 
             
             
            $msg=$user1->name. ' requested for new job';
           $type='new job request';
            $title='job request';
             $typeid=$request->input('type');
            if($typeid==0){
                $msg=$user1->name. ' new ondemand job request';
               $type='0';
                $title='New Job request of ondemand';
             }else{
                 $msg=$user1->name. ' new scheduled job request';
                 $type='1';
                $title='New Job request';
             }
              $this->push_Notification($user->remember_token,$bookinid->booking_id,$msg,$type,$title);
         }
         
        }
            
            return response()->json(['response' => true,'message' => 'success'],200);
        }
        }else{
             return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
        
       }
       
       //-------------------end--------------------------------//
       
       
       
       
       
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

// print_r($fields);
// die;
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
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

// Execute post
$result = curl_exec($ch);
if ($result === FALSE) {
    die('Curl failed: ' . curl_error($ch));
}

// Close connection
curl_close($ch);

$result;    
 
 return;
}


 public function customerrunningbooking(Request $request){
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
       
    //   $booking = \DB::table('booking')->where('user_id', $id)->where('status','!=', 5)->orderBy('booking_id','DESC')->first();
    $booking = \DB::table('booking')->where('user_id', $id)->where('status','=', 0)->orderBy('booking_id','DESC')->first();
        if(!empty($booking)){
             $bookingdetails=(object)array();
            
                    $bookingdetails= $this->getcustomerrunningjodetails($booking);
            
       
          
            return response()->json(['response' => true,'message' => 'success','data'=>$bookingdetails],200);
        }else{
            return response()->json(['response' => true,'message' => 'No Result Founds','data'=>(object)array()],200);
        }
        }else{
             return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
        
       }
       
        public function getcustomerrunningjodetails($b){
           $data['booking_id']=$b->booking_id;
           $users = \DB::table('users')->select('id','name','image','latitude','longitude')->where('id', $b->washer_id)->get();
        if(!empty($users)){
              $data['washerdetails']=$users;
        }else{
            $data['washerdetails']=(object)array();
        }
           $data['washer_id']=$b->washer_id;
          
           $data['booking_date']=$b->booking_date;
           $data['booking_time']=$b->booking_time;
         
           $data['wash_location']=$b->wash_location;
            $data['status']=$b->status;
        

           return $data;
       }
       
          public function addcard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'last4' => 'required',
            'expiryMonth'=>'required',
            'expiryYear'=>'required',
            'user_id'=>'required',
            'brand'=>'required',
            'postalCode'=>'required',   
            
        ]);
        if ($validator->passes()) {
        $data1 = $request->except([
            '_token'
          ]);
          
          $data['card_number']=substr($request->input('last4'), -4);
          
         
          $data['expiry_month']=$request->input('expiryMonth');
          $data['expiry_year']=$request->input('expiryYear');
        //   $data['cvv_no']=$request->input('cvv_no');
          $data['user_id']=$request->input('user_id');
          $data['brand']=$request->input('brand');
          $data['postalcode']=$request->input('postalCode');
     
        //   $data['paypal_id']=$request->input('paypal_id');
        //   $data['card_id']=$request->input('card_id');
        //   $data['lat']=$request->input('lat');
        //   $data['longi']=$request->input('long');
           $id=$request->input('user_id');
     
            $user= $this->CardModel->create($data);
     
           if($user){  
            return response()->json(['response' => true,'message' => 'success'],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            } 
        }else{
        return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }
    
    
    public function get_card_details(Request $request){
         $token = request()->header('App-Key');
           $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }else{
            $card=$this->CardModel->where(array('user_id'=>$request->input('user_id')));
            
           if($card){ 
               $data=array();
               foreach($card as $rows){
                   $data[]=array('id'=>$rows['id'],'user_id'=>$rows['user_id'],'last4'=>$rows['card_number'],'expiryMonth'=>$rows['expiry_month'],'expiryYear'=>$rows['expiry_year'],'brand'=>$rows['brand'],'postalCode'=>$rows['postalcode']);
               }
               
               
            return response()->json(['response' => true,'message' => 'success','data'=>$data],201);
            }else{
                return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
            } 
        }
    }
    
      public function updatecard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'card_number' => 'required',
            'holder_name' => 'required',
            'expiry_month'=>'required',
            'expiry_year'=>'required',
            'cvv_no'=>'required',
            'user_id'=>'required',
            
        ]);
        if ($validator->passes()) {
         $data1 = $request->except([
            '_token'
          ]);
          
          $data['card_number']=$request->input('card_number');
          $data['holder_name']=$request->input('holder_name');
          $data['expiry_month']=$request->input('expiry_month');
          $data['expiry_year']=$request->input('expiry_year');
          $data['cvv_no']=$request->input('cvv_no');
          $data['user_id']=$request->input('user_id');
        //   $data['paypal_id']=$request->input('paypal_id');
        //   $data['card_id']=$request->input('card_id');
        //   $data['lat']=$request->input('lat');
        //   $data['longi']=$request->input('long');
            $id=$request->input('id');
      //DB::enableQueryLog();
            $user= $this->CardModel->update($data, $id);
       //dd(DB::getQueryLog());
         
            return response()->json(['response' => true,'message' => 'success'],201);
           
        }else{
        return response()->json(['response' => false,'message' => 'required all field','data'=>array(),'error'=>$validator->errors()],400);
        }
    }
    
    public function addPaypalId(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $data['user_id']=$request->input('user_id');
        $data['paypal_id']=$request->input('paypal_id');
        $user= $this->PaypalModel->create($data);
     
        if($user){  
            return response()->json(['response' => true,'message' => 'success'],201);
            
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        } 
    }
    
     public function get_payment_type(){
        $token = request()->header('App-Key');
           $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $payment=$this->PaymenttypeModel->all();   
        if(!empty($payment)){
            return response()->json(['response' => true,'message' => 'success','data'=>$payment],200);
        }else{
            return response()->json(['response' => false,'message' => 'something went wrong','data'=>array()],400);
        }
    }
    
    public function applycoupan(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            'coupan_code'=>'required',
            ]);
        if ($validator->passes()) {

            $coupan_code=$request->input('coupan_code');
            $user_id=$request->input('user_id');

            $currentDate = Carbon::now();
            $couponData = DB::table('coupan')->where('coupan_code','=', $coupan_code)->whereDate('end_date', '>=', $currentDate)->count();

            // echo "<pre>";
            // print_r($coupan_code);
            // print_r($currentDate);
            // print_r($couponData);
            // exit;

            if($couponData == 1) {
                $cu=DB::table('used_coupons')->where(['coupan_code'=>$coupan_code,'user_id'=>$user_id])->get();
                if(count($cu)>0){
                   return response()->json(['response' => false,'message' => 'Coupan code already used','data'=>(object)array()],400);
                } else {
                    $coupan = \DB::table('coupan')->where('coupan_code',$coupan_code)->where(function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id)->orWhere('user_id', NULL);
                    })->where('status',0)->first();
                    if(!empty($coupan)){
                        \DB::table('coupan')->where('coupan_code',$coupan_code)->update(array('status'=>1));
                  
                        DB::table('used_coupons')->insert(
                            array('user_id'=>$request->input('user_id'),
                            'coupan_code'=>$coupan_code,
                            'created_at'=>date('Y-m-d'))
                            );
                         if( $coupan->user_id!=NULL){
                            $rewardresult=DB::table('reward')->where('user_id',$coupan->user_id)
                            ->select('user_id','created_at', DB::raw('count(*) as total'))
                            ->groupBy('user_id')
                            ->get();

                            if(count($rewardresult)>0 && $rewardresult[0]->total>=10){ 
                                DB::table('reward')->where('user_id', '=', $coupan->user_id)->delete();
                            }
                         }
                        return response()->json(['response' => true,'message' => 'success','data'=>$coupan],200);
                    } else {
                        return response()->json(['response' => false,'message' => 'Coupan code  is not vaild','data'=>(object)array()],400);
                    }
                }
            } else {
                return response()->json(['response' => false,'message' => 'Coupan code expired.','data'=>(object)array()],400);
            }
            
     
     
        }else{
             return response()->json(['response' => false,'message' => 'required all field','data'=>(object)array(),'error'=>$validator->errors()],400);
        }
        
       } 
       
        public function forget_password(Request $request){
        //   $token = request()->header('App-Key');
        //   $user=$this->User->get_first_record($token,'api_token');
        // if(empty($user)){
        //     return response()->json(['message'=>'App Key Not Found'],401);
        // }
        $emailid=$request->input('emailid');
        
        $users = \DB::table('users')->where('email',$emailid)->first();
        if(!empty($users)){
            $to_name=$users->name;
       $to_email=$emailid;
       
       
        $hashid=Str::random(40);
        
$link=url('forget-password/'.$hashid);

$dataf['forgetkey'] = $hashid;
$dataf['to_email'] = $to_email;
  \DB::table('fogetpassword')->where('to_email', '=', $to_email)->delete();
\DB::table('fogetpassword')->insert($dataf);

 $data = array('name'=>$users->name,'link'=>$link);
   
      
//       Mail::send('mail',$data,function($message) use ($to_name,$to_email){
// 	$message->to($to_email)
// 	->subject('Forget Password');
// });
 Mail::send('mail', $data, function($message)use($to_name, $to_email) {
                    $message->to($to_email, $to_email)
                            ->subject('Forget Password');
                           
                            
                   });
            return response()->json(['response' => true,'message' => 'success'],200);
        }else{
            return response()->json(['response' => false,'message' => 'Emailid Is wrong'],400);
        }
    }
    
     public function forgetpassword($id){
          $users = \DB::table('fogetpassword')->where('forgetkey',$id)->first();
        if(!empty($users)){
        
        $data['ftoken']=$id;
             return view('forgetpassword', $data);
        }else{
             return response()->json(['response' => false,'message' => 'Link Expaired'],400);
        }

     } 
     
     
     
    public function updateforgetpassword(Request $request)
    {
       
     
       $validation = Validator::make($request->all(), [
            'confirm_password' => 'required',
            'password' => 'required',
        ]);
        $forgetkey = $request->input('forgetkey');
 
        if($request->input('confirm_password') != $request->input('password')){
             return redirect('forget-password/'.$forgetkey)->with('error', 'New password and confirm password is not match');
        }else{
            $users = \DB::table('fogetpassword')->where('forgetkey',$forgetkey)->first();
        if(!empty($users)){

                $data['password'] = Hash::make($request->input('password'));
                 $id = $users->to_email;
                 
                   \DB::table('users')->where('email', $id)->update($data);

   \DB::table('fogetpassword')->where('to_email', '=', $id)->delete();
                return redirect('forget-password-success');
        }else{
            return redirect('forget-password/'.$forgetkey)->with('error', 'Link Expaired');
              }
    }
    }
    
     public function successmsg(){
        return view('forgetsuccess');
     } 
     
     
    public function addBackground(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
        
        'first_name'=>'required',
        'middle_name'=>'required',
        'last_name'=>'required',
        'dob'=>'required',
        'social_security_number'=>'required',
        'drivers_license_number'=>'required',
        'state_issuing_license'=>'required',
        'user_id'=>'required',
        'present_street_address'=>'required',
        'city_state_zip'=>'required'
        ]);
        if ($validator->passes()) {
            
        $data=array('first_name'=>$request->input('first_name'),'middle_name'=>$request->input('middle_name'),'last_name'=>$request->input('last_name'),'dob'=>$request->input('dob'),'social_security_number'=>$request->input('social_security_number'),'drivers_license_number'=>$request->input('drivers_license_number'),'state_issuing_license'=>$request->input('state_issuing_license'),'user_id'=>$request->input('user_id'),'present_street_address'=>$request->input('present_street_address'),'city_state_zip'=>$request->input('city_state_zip'),'present_street_address'=>$request->input('present_street_address'),'city_state_zip'=>$request->input('city_state_zip'),'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d'));    
        
        $result=DB::table('background_check')->insert($data);
        if($result){
                return response()->json(['response' => true,'message' => 'success'],200);
        }else{
                return response()->json(['response' => false,'message' => 'Something went wrong'],400);
        }
            
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>(object)array(),'error'=>$validator->errors()],400);
        }   
            
    }
     
    public function getBackground(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $background=DB::table('background_check')->get();
        if(count($background)>0){
            $data=array();
            foreach($background as $rows){
                $data[]=array('id'=>$rows->id,'first_name'=>$rows->first_name,'middle_name'=>$rows->middle_name,'last_name'=>$rows->last_name,'dob'=>$rows->dob,'social_security_number'=>$rows->social_security_number,'drivers_license_number'=>$rows->drivers_license_number,'state_issuing_license'=>$rows->state_issuing_license,'present_street_address'=>$rows->present_street_address,'city_state_zip'=>$rows->city_state_zip,'user_id'=>$rows->user_id);
            }
                return response()->json(['response' => true,'message' => 'success','data'=>$data],200);
        }else{
                return response()->json(['response' => true,'message' => 'success','data'=>array()],200);
        }   
    }
     
     
    public function addVehicleInsurance(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            
        'user_id'=>'required',
        
        ]);
        if ($validator->passes()) {
            
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/insurance');
            $image->move($destinationPath, $name);
        
            $data['image']=$name;
            
        }
        $data['user_id']=$request->input('user_id');
        $data['name']=$request->input('name');
        $data['carriers_name']=$request->input('carriers_name');
        $data['policy_number']=$request->input('policy_number');
        $data['expiration_date']=$request->input('expiration_date');
        
        $data['created_at']=date('Y-m-d');
        $data['updated_at']=date('Y-m-d');
        
        $result=DB::table('vehicle_insurance')->insert($data);
        if($result){
                return response()->json(['response' => true,'message' => 'success'],200);
        }else{
                return response()->json(['response' => false,'message' => 'Something went wrong'],400);
        }
            
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>(object)array(),'error'=>$validator->errors()],400);
        }   
    }
    
    public function getVehicleInsurance(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $background=DB::table('vehicle_insurance')->get();
        if(count($background)>0){
            $data=array();
            foreach($background as $rows){
                $data[]=array('id'=>$rows->id,'user_id'=>$rows->user_id,'name'=>$rows->name,'carriers_name'=>$rows->carriers_name,'policy_number'=>$rows->policy_number,'expiration_date'=>$rows->expiration_date,'image'=>url('public/insurance/'.$rows->image));
            }
                return response()->json(['response' => true,'message' => 'success','data'=>$data],200);
        }else{
                return response()->json(['response' => true,'message' => 'success','data'=>array()],200);
        }   
    }
    
    public function addVehicleRegistration(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            
        'user_id'=>'required',
        
        ]);
        if ($validator->passes()) {
            
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/vehicle');
            $image->move($destinationPath, $name);
        
            $data['image']=$name;
            
        }
        $data['user_id']=$request->input('user_id');
        $data['name']=$request->input('name');
        $data['issued_state']=$request->input('issued_state');
        $data['exp_date']=$request->input('exp_date');
        
        $data['created_at']=date('Y-m-d');
        $data['updated_at']=date('Y-m-d');
        
        $result=DB::table('add_vehicle')->insert($data);
        if($result){
                return response()->json(['response' => true,'message' => 'success'],200);
        }else{
                return response()->json(['response' => false,'message' => 'Something went wrong'],400);
        }
            
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>(object)array(),'error'=>$validator->errors()],400);
        }   
    }
    
    public function getVehicleRegistration(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $background=DB::table('add_vehicle')->get();
        if(count($background)>0){
            $data=array();
            foreach($background as $rows){
                $data[]=array('id'=>$rows->id,'user_id'=>$rows->user_id,'name'=>$rows->name,'issued_state'=>$rows->issued_state,'exp_date'=>$rows->exp_date,'image'=>url('public/vehicle/'.$rows->image));
            }
                return response()->json(['response' => true,'message' => 'success','data'=>$data],200);
        }else{
                return response()->json(['response' => true,'message' => 'success','data'=>array()],200);
        }   
        
    }
    
    public function checkDocument(Request $request){
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
            $bg=DB::table('background_check')->where('user_id',$user_id)->get();
            if(count($bg)>0){
                $background=true;
            }else{
                $background=false;
            }
            $vehicle_insurance=DB::table('vehicle_insurance')->where('user_id',$user_id)->get();
            if(count($vehicle_insurance)>0){
                $vehicle_insurance=true;
            }else{
                $vehicle_insurance=false;
            }
            $vehicleregist=DB::table('add_vehicle')->where('user_id',$user_id)->get();
            if(count($vehicleregist)>0){
                $vehicleregistion=true;
            }else{
                $vehicleregistion=false;
            }
            $user_document=DB::table('user_document')->where('user_id',$user_id)->get();
            if(count($user_document)>0){
                $userdocument=true;
            }else{
                $userdocument=false;
            }
            return response()->json(['background' =>$background,'vehicle_insurance' => $vehicle_insurance,'vehicle_registration'=>$vehicleregistion,'drivinglicense'=>$userdocument],200);
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>(object)array(),'error'=>$validator->errors()],400);
        }
    }
    
    public function createCoupons(Request $request){
        $token = request()->header('App-Key');
        $user=$this->User->get_first_record($token,'api_token');
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        $validator = Validator::make($request->all(), [
            
        'coupan_code'=>'required',
        
        ]);
        if ($validator->passes()) {
            $coupan_code=$request->input('coupan_code');
            $amount=$request->input('amount');
            $co=DB::table('coupan')->where(['coupan_code'=>$coupan_code])->get();
            if(count($co)>0){
                return response()->json(['response' => false,'message' => 'Already exist'],200);
            }else{
                    $coupan= DB::table('coupan')->insert(array('coupan_code'=>$coupan_code,'amount'=>$amount,'status'=>0));
                    if($coupan){
                        return response()->json(['response' => true,'message' => 'success'],200);
                    }else{
                        return response()->json(['response' => false,'message' => 'something went wrong'],200);
                    }
            }
        
        
            
        }else{
            return response()->json(['response' => false,'message' => 'required all field','data'=>(object)array(),'error'=>$validator->errors()],400);
        }
    } 
     
}
    ?>