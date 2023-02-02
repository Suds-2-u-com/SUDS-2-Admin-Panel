<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\CountryModel;
use Auth;
use DB;
use Mail;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $Country;
   

    public function __construct(CountryModel $CountryModel)
    {
        $this->Country=new UserRepository($CountryModel);
        
    }
    
    public function index(){
        $data['coupon']=DB::table('coupan')->get();
        $data['user'] = DB::table('users')->where('role_as', '=', 3)->orderBy('id', 'DESC')->get();
        return view('coupon.index')->with($data);
    }
    
    public function editCouponShow(Request $request){
        $id=$request->input('id');
        $data['coupon']=DB::table('coupan')->where(['id'=>$id])->first();
        $data['user'] = DB::table('users')->where('role_as', '=', 3)->orderBy('id', 'DESC')->get();
        return view('coupon.edit')->with($data);
        
    }
    
    public function updateCoupon(Request $request,$id){
         $request->validate([
            'coupan_code' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $coupan_code=$request->input('coupan_code');
        $amount=$request->input('amount');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $user_id = $request->input('user_id');
        $co=DB::table('coupan')->where(['coupan_code'=>$coupan_code])->where('id','!=',$id)->get();
         
        if(count($co)>0){
            return redirect('coupon')->with('error', 'Already exist');    
        
        } else {
            $coupan= DB::table('coupan')->where(['id'=>$id])->update(array('coupan_code'=>$coupan_code,'amount'=>$amount,'end_date'=>$end_date, 'start_date' => $start_date,'user_id' =>$user_id,'status'=>0));
            //$coupan= DB::table('coupan')->insert(array('coupan_code'=>$coupan_code,'amount'=>$amount,'status'=>0));
            // if($coupan){
                return redirect('coupon')->with('success', 'Coupon updated successfully.');
            //   }else{
            //       return redirect('coupon')->with('error', 'Something went wrong'); 
            //   }
        }
        
    }
    
    public function addCoupon(Request $request){
        $request->validate([
            'coupan_code' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $coupan_code = $request->input('coupan_code');
        $amount = $request->input('amount');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $user_id = $request->input('user_id');
        $co=DB::table('coupan')->where(['coupan_code'=>$coupan_code])->get();
        if(count($co)>0){
            return redirect('coupon')->with('error', 'Already exist');    
        }else{
            $coupan= DB::table('coupan')->insert(array('coupan_code'=>$coupan_code,'amount'=>$amount,'end_date'=>$end_date, 'start_date' => $start_date, 'user_id' =>$user_id, 'status'=>0));
            if($coupan){

                if($user_id!=''){
                  $users = DB::table('users')->where('id',$user_id)->where('role_as', '=', '3')->get();
                } else{
                  $users = DB::table('users')->where('role_as', '=', '3')->get();
                }
                foreach ($users as $key => $value) {
                    $useremail=$value->email;
                    $to = $useremail;
                    $to_name=$value->name;
                    $to_email=$value->email;
                    $mailData=array(
                        'to_name'=>$value->name,
                        'to_email'=>$value->email,
                        'messages'=>'You have received the discount coupon.',
                        'image'=>$value->image,
                        'title'=>'SUDS-2-U.COM',
                        'coupan_code' => $coupan_code,
                        'amount' => $amount
                    );
                    Mail::send('mail.coupon', $mailData, function($message)use($mailData) {
                        $message->to($mailData["to_email"], $mailData["to_email"])
                        ->subject($mailData["title"]);
                    });
                    $this->push_Notification($value->remember_token, 'Congratulations! You have received the discount coupon.Check Email!..', 'Received Coupon');
                }
                return redirect('coupon')->with('success', 'Coupon created successfully.');
            }else{
                return redirect('coupon')->with('error', 'Something went wrong'); 
            }
        }
    }

    public function push_Notification($token,$msg,$title){
        $device_id=$token;
        $title=$title;
        $message=$msg;
        $message_final = array(
            'title' => $title,
            'body' => $message,
            
            'sound' => 'Default',
            'image' => 'Notification Image',
        );
        
        $fields = array(
            'to' => $device_id,
            'notification' => $message_final,
            'data' => array (
                "type" => 0
            ),
            'android_channel_id'=>'suds2u',
            'priority' => 'high',
            'content_available' => true
        );
                    
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = 'AAAAinqmE8A:APA91bHRucjXF2cqL-meJy4TsN2QOYNZSUJ9eLrOd96dypwkxw5lfUyFCuirjK1EoR8jfqniLzOssyRzqwd_4tucj6wDpQOHd61_szKaYxE58MQHRa1O2ITXjnFHA2lZDj6sP6fA_dZY';
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
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        
        $result;    

        return;

    }
}

?>