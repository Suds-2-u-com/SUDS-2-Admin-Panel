<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\UserModel;
use Illuminate\Support\Str;
//use App\Customer;
use App\ReviewModel;
use App\PromotionsModel;
use Hash;   
use Auth;
use Mail;
use Redirect;
use DB;
use Input;
use App\CountryModel; 
use App\UserDetailsModel;
use App\StateModel;
use App\CityModel;
use Carbon\Carbon;

class UserController extends Controller
{
    private $UserRepository;
    private $AllUser;
    private $Allreview;
    private $promotion;
    private $CountryModel;
    private $UserDetailsModel;
    private $City;

    public function __construct(UserModel $UserModel,ReviewModel $ReviewModel,PromotionsModel $PromotionsModel,CountryModel $CountryModel,UserDetailsModel $UserDetailsModel,CityModel $CityModel)
    {
        $this->UserRepository=new UserRepository($UserModel);
        $this->AllUser= new \App\UserModel();
        $this->Allreview= new UserRepository($ReviewModel);
        $this->promotion=new UserRepository($PromotionsModel);
        $this->CountryModel=new UserRepository($CountryModel);
        $this->UserModelDetails=new UserRepository($UserDetailsModel);
        $this->City=new UserRepository($CityModel);
    }

    public function userList(){

        if(Auth::check()){

            $data=['user'=>$this->UserRepository->where(array('role_as'=>2))];
            $currentDate = Carbon::now();

            foreach ($data['user'] as $key => $value) {
                $value->background_check = DB::table('background_check')->where(array('user_id'=>$value->id))->count();
                $value->vehicle_insurance = DB::table('vehicle_insurance')->where(array('user_id'=>$value->id))->count();
                $value->add_vehicle = DB::table('add_vehicle')->where(array('user_id'=>$value->id))->count();
                $value->expired_vehicle_insurance = DB::table('vehicle_insurance')->whereDate('expiration_date', '<', $currentDate)->where(array('user_id'=>$value->id))->count();
                $value->expired_vehicle_registeration = DB::table('add_vehicle')->whereDate('exp_date', '<', $currentDate)->where(array('user_id'=>$value->id))->count();
                $value->expired_user_license = DB::table('user_document')->whereDate('expiry_date', '<', $currentDate)->where(array('user_id'=>$value->id))->count();
            }

            // echo "<pre>";
            // print_r($data['user']);
            // exit;
            
        return view('user.index')->with($data);
        }else{
            return redirect('/Admin-Login');
        }
    }

    public function deleteUser(Request $request){
        $id=decryption($request->input('id'));
            if($this->UserRepository->delete($id)){
                echo json_encode(array('response'=>true));
            }else{
                echo json_encode(array('response'=>false));
            }
    }

    public function changestatus(Request $request){
    	$id=$request->input('id');
    	$status=$request->input('status');
    	if($status=='1'){
    		$save=$this->UserRepository->update(array('status'=>1),$id);
    	}else{
    		$save=$this->UserRepository->update(array('status'=>0),$id);
    	}
    	
    	$data['success']=true;
    	echo json_encode($data);

    }


    public function customerList(){
    	if(Auth::check()){
    		$data=[
   				'user'=>$this->UserRepository->where(array('role_as'=>3))
   				];
   
   	    return view('user.customer-index')->with($data);
    	}else{
    		return redirect('/Admin-Login');
    	}
    }
    
    public function showbasicDetails(Request $request){
        $id=$request->input('id');
    	$data=[
   				'user'=>$this->AllUser->find($id),'country'=>$this->CountryModel->all(),'id'=>$id
   				];
    	
    	return view('user.basic_view')->with($data);
    }
    

    public function user(){
    	$data=[
   				'user'=>$this->UserRepository->where(array('role_as'=>3))
   				];
   		return response()->json(['response' => trans('true'),'message' => 'success','data'=>$data]);
   		
    }


    public function showDetails(Request $request){
    	$id=$request->input('id');
    	$data=[
   				'user'=>$this->AllUser::getAllDetailsOfUser($id),'country'=>$this->CountryModel->all(),'state'=>StateModel::all(),'city'=>CityModel::all(),'id'=>$id
   				];
    	
    	return view('user.view')->with($data);
    }

    public function showBankDetails(Request $request){
    	$id=$request->input('id');
    	$data=[
   				'bank'=>$this->AllUser::getAllBankDetailsOfUser($id)
   				];
    	
    	return view('user.bank')->with($data);
    }

    public function showDocumentDetails(Request $request){
    	$id=$request->input('id');
    	$data=[
   				'doc'=>$this->AllUser::getAllDocOfUser($id)
   				];
    	
    	return view('user.document')->with($data);
    }


    public function showVehicleDetails(Request $request){
      
    	$id=$request->input('id');
    	$data=[
   				'vehicle'=>$this->AllUser::getAllVehicleOfUser($id)
   				];
    	
    	return view('user.vehicle')->with($data);
    }

     public function review($id){
      
     
      $data=['review'=>$this->Allreview->where(array('to_id'=>$id))];
      
      return view('user.Allreview')->with($data);
    }
    
    public function roles1(){
      
      
        if(Auth::check()){

       		$data=[
       				'user'=>$this->UserRepository->where(array('role_as'=>4))
       				];
       
       	   return view('roles.index')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
     public function roles(){
      
      
        if(Auth::check()){

       		$data=[
       				'user'=>$this->UserRepository->where(array('role_as'=>4))
       				];
       
       	   return view('roles.index1')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
    public function createRole(Request $request){
      
         $request->validate([
            'role_as' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            
        ]);
        $data = $request->except([
            '_token',
            'password',
          ]);
          
          $data['password']=Hash::make($request->input('password'));
        if(count($this->UserRepository->where(array('email'=>$request->input('email'))))>0){
            return redirect('Roles')->with('error', 'Email Id Already exist'); 
        }elseif(count($this->UserRepository->where(array('mobile'=>$request->input('mobile'))))>0){
            return redirect('Roles')->with('error', 'Mobile Number Already exist'); 
        }else{
        if($this->UserRepository->create($data)){

        return redirect('Roles')->with('success', 'Created successfully.');
        }else{

        return redirect('Roles')->with('error', 'Something went wrong');    
        }
        }
    }
    
    
    public function editrole(Request $request){
        $id=$request->input('id');
        $user=$this->UserRepository->where(array('id'=>$id));
        return view('roles.edirrole')->with(['user'=>$user]);   
    }
    
    
    public function editrolefrm(Request $request){
         $request->validate([
            'role_as' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
            'id',
          ]);
          $id=$request->input('id');
          
        if(count(UserModel::where(['email'=>$request->input('email')])->where('id', '!=' , $id)->get())>0){
            return redirect('Roles')->with('error', 'Email Id Already exist'); 
        }elseif(count(UserModel::where(['mobile'=>$request->input('mobile')])->where('id', '!=' , $id)->get())>0){
            return redirect('Roles')->with('error', 'Mobile Number Already exist'); 
        }else{
        $this->UserRepository->update($data,$id);

        return redirect('Roles')->with('success', 'Updated successfully.');
      
        }
    }
    
    
    public function sendMail(){
        if(Auth::check()){

       		$data=[
       				//'user'=>$this->UserRepository->where(array('role_as'=>2))
       				'user'=>$this->UserRepository->where(array('role_as'=>3))
       				];
       
       	   return view('main.index')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
     public function push_Notification($token,$msg,$title,$imagelink, $type){
        $device_id=$token;
        $title=$title;
        $message=$msg;
        
        $message_final = array(
            'title' => $title,
            'body' => $message,
            
            'sound' => 'Default',
            'image' => $imagelink,
        );
        
        // if($device_id)
        // {
            $fields = array(
                'to' => $device_id,
                'notification' => $message_final,
                
                'data' => array (
                    "type" => $type     
                ),
                'android_channel_id'=>'suds2u',
                'priority' => 'high',
                'content_available' => true
            );
        // }
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
    
    
    public function send_mail_frm(Request $request){
     if(isset($_POST['notification'])){
        
        $request->validate([
            
            'message' => 'required',
            'subject' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
          ]);
        //  $userid=$request->input('action_id');
         $types=$request->input('types');
         $message=strip_tags($request->input('message'));
         $title=$request->input('subject');
         $imagelink='';
          if ($request->hasFile('file')) {
        $image = $request->file('file');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/mail');
        $image->move($destinationPath, $name);
        $imagelink=url('public/mail/'.$name);
      }
      
         if($types=='all'){
              $result=$this->UserRepository->all();
              
          }elseif($types=='all_user'){
               $result=$this->UserRepository->where(array('role_as'=>3));
          }else{
                $result=$this->UserRepository->where(array('role_as'=>2));
          }
           if(count($result)>0){
             $dataap=array();   
              foreach($result as $rows){
                if(!empty($rows->remember_token)){
                  $this->push_Notification($rows->remember_token,$message,$title,$imagelink, '-1');
                }
              }
           }
          
    
    
          
        return Redirect::back()->with('success', 'Successfully Send Notification.');
            
        
     }else{
        $request->validate([
           
            'message' => 'required',
            'subject' => 'required',
        ]);
        $data = $request->except([
            '_token',
          ]);
          
        //   $userid=$request->input('action_id');
          $types=$request->input('types');
          $message=$request->input('message');
          $subject=$request->input('subject');
           $type=$request->input('type');
       $name='';   
       if ($request->hasFile('file')) {
        $image = $request->file('file');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/mail');
        $image->move($destinationPath, $name);
      }
      
      if($types=='all'){
          $result=$this->UserRepository->all();
          
      }elseif($types=='all_user'){
           $result=$this->UserRepository->where(array('role_as'=>3));
      }else{
            $result=$this->UserRepository->where(array('role_as'=>2));
      }
      
      
      if(count($result)>0){
             $dataap=array();   
          foreach($result as $rows){
                $useremail=$rows->email;
                $to = $useremail;
                $to_name=$rows->name;
                $to_email=$rows->email;
                $data=array('to_name'=>$rows->name,'to_email'=>$rows->email,'messages'=>$message,'image'=>$name,'title'=>'SUDS-2-U.COM');
                if ($request->hasFile('file')) {
                $files=public_path('/mail/'.$name);
                 Mail::send('mail.usermessage', $data, function($message)use($data, $files) {
                    $message->to($data["to_email"], $data["to_email"])
                            ->subject($data["title"]);
                           
                               $message->attach($files);
                            
                });
                }else{
                   Mail::send('mail.usermessage', $data, function($message)use($to_name, $to_email,$subject) {
                    $message->to($to_email, $to_email)
                            ->subject($subject);
                           
                            
                   });
                }
                
                $dataap[]=array('user_id'=>$rows->id,'message'=>$message,'subject'=>$subject,'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d'),'type'=>$type);
          }
           \DB::table('mail')->insert($dataap);
      }
      
        return Redirect::back()->with('success', 'Successfully Send Mail.');

      
     }
    }
    
    public function sentMail(){
         if(Auth::check()){

       		$data=[ 'user'=> \DB::table('mail')->where(['type'=>3])->get()->toArray(),'title'=>'Sent mail to user'
       				];
         
       	   return view('main.sentindex')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
    public function sentMailWasher(){
          if(Auth::check()){

       		$data=[ 'user'=> \DB::table('mail')->where(['type'=>2])->get()->toArray(),'title'=>'Sent mail to washer'
       				];
       
       	   return view('main.sentindex')->with($data);
        }else{
        	return redirect('/Admin-Login');
        } 
    }
    
    
    public function mailingList(){
         if(Auth::check()){

       		$data=[ 'mail'=> \DB::table('mailing')->orderBy('id', 'DESC')->get()
       				];
       
       	   return view('mail.mailinglist')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
    
    public function washerMalingList(){
        
        if(Auth::check()){

       		$data=[ 'mail'=> \DB::table('mail')->where(array('type'=>2))->orderBy('id', 'DESC')->get()
       				];
       
       	   return view('mail.washermailing')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
    
    public function promotions(){
         if(Auth::check()){

       		$data=[ 'promotions'=> \DB::table('promotions')->orderBy('id', 'DESC')->get()
       				];
       
       	   return view('promotions.index')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
    
    public function createPromotions(Request $request){
        $request->validate([
            'name' => 'required',  
            'start_date' => 'required', 
            'end_date' => 'required', 
            'discount_amount' => 'required',
            'type' => 'required',
        ]);

        $data = $request->except([
            '_token',
        ]);  
        // echo "<pre>";
        // print_r($data);
        // exit;
        $typp=$request->input('type');
        $users = DB::table('users')->where('role_as', '=', '3')->get();
        if($typp=='free'){
           
            $free=$this->promotion->where(array('type'=>'free'));
          
            if(count($free)>0){
                return redirect('Promotions')->with('error', 'Free Promotions Already Exists');   
            }
            else{
                if($this->promotion->create($data)){
                    foreach ($users as $key => $value) {
                        $useremail=$value->email;
                        $to = $useremail;
                        $to_name=$value->name;
                        $to_email=$value->email;
                        $mailData=array(
                            'to_name'=>$value->name,
                            'to_email'=>$value->email,
                            'messages'=>'You have received Promotions.',
                            'image'=>$value->image,
                            'title'=>'SUDS-2-U.COM',
                            'name' => $data['name'],
                            'type' => $data['type'],
                            'discount_amount'=>$data['discount_amount'],
                            'start_date'=>$data['start_date'],
                            'end_date'=>$data['end_date']
                        );
                        Mail::send('mail.promotion', $mailData, function($message)use($mailData) {
                            $message->to($mailData["to_email"], $mailData["to_email"])
                            ->subject($mailData["title"]);
                        });
                        $this->push_Notification($value->remember_token, 'You have received promotion.', 'Received promotion', "null", '9');
                    }
                    
                    return redirect('Promotions')->with('success', 'Created successfully.');
                }   
                else {
                    return redirect('Promotions')->with('error', 'Something went wrong');    
                }
            }
        }
        else {
            if($this->promotion->create($data)){
                foreach ($users as $key => $value) {
                    $useremail=$value->email;
                    $to = $useremail;
                    $to_name=$value->name;
                    $to_email=$value->email;
                    $mailData=array(
                        'to_name'=>$value->name,
                        'to_email'=>$value->email,
                        'messages'=>'You have received Promotions.',
                        'image'=>$value->image,
                        'title'=>'SUDS-2-U.COM',
                        'name' => $data['name'],
                        'type' => $data['type'],
                        'discount_amount'=>$data['discount_amount'],
                        'start_date'=>$data['start_date'],
                        'end_date'=>$data['end_date']
                    );
                        Mail::send('mail.promotion', $mailData, function($message)use($mailData) {
                        $message->to($mailData["to_email"], $mailData["to_email"])
                        ->subject($mailData["title"]);
                    });
                    $this->push_Notification($value->remember_token, 'You have received promotion.', 'Received promotion', "null", '9');
                }

                return redirect('Promotions')->with('success', 'Created successfully.');
            }else{
                return redirect('Promotions')->with('error', 'Something went wrong');    
            }  
       }
    }
    
    
    public function editPromotions(Request $request){
        if(Auth::check()){
        $id=$request->input('id');
       
        
       		$data=[ 'promotions'=> \DB::table('promotions')->where('id',$id)->orderBy('id', 'DESC')->first()
       				];
       
       	   return view('promotions.edit')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
    public function updatePromotions(Request $request){
          $request->validate([
         
            'name' => 'required',
            'start_date' => 'required', 
            'end_date' => 'required',
            'discount_amount' => 'required',
        ]);
        $data = $request->except([
            '_token',
          ]);   
        $id=$request->input('id');
         $typp=$request->input('type');
       if($typp=='free'){
          $free=PromotionsModel::where(['type'=>'free'])->where('id','!=',$id)->get(); 
      
          if(count($free)>0){
              return redirect('Promotions')->with('error', 'Free Promotions Already Exists');   
          }else{
              $this->promotion->update($data,$id);

              return redirect('Promotions')->with('success', 'Updated successfully.');
          }
       }else{
        $this->promotion->update($data,$id);

        return redirect('Promotions')->with('success', 'Updated successfully.');
       }
    }
    
    
    public function freeWashes(){
          
        if(Auth::check()){
            
       		$data=['reward'=>DB::table('reward')
                 ->select('user_id','reward.created_at','users.name', DB::raw('count(*) as total'))
                 ->join('users', 'users.id', '=', 'reward.user_id')
                 ->groupBy('user_id')
                 ->get()];
       
       	   return view('booking.freewasheruser')->with($data);
        }else{
        	return redirect('/Admin-Login');
        }
    }
    
    public function drag(){
        return view('drag');
    }
    
    
    public function createCustomer(Request $request){
         $request->validate([
         
            'name' => 'required',
            'email' => 'required', 
            'mobile' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
          ]);
          
          $data['role_as']=3;
          
        if (Input::hasFile('image')){

           $file = Input::file('image');
           $name = $file->getClientOriginalName();
    
    
           $image = Image::make(Input::file('image')->getRealPath());
           $image->save(public_path() . '/profile/' . $file->getClientOriginalName());
    
           $data['image'] = $name;   
          }  
          $data['password']=Hash::make($request->input('password'));
        if($this->UserRepository->create($data)){
            
             return redirect('Customer-List')->with('success', 'Created successfully.');
        }else{
             return redirect('Customer-List')->with('error', 'Something went wrong'); 
        }  
    }
    
    public function updateCustomerDetails(Request $request){
 
         $request->validate([
            'phone_number' => 'required', 
            'preferred_method_of_contact' => 'required',
            'complete_address' => 'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
           
           
        ]);
        $data = $request->except([
            '_token',
          
          ]);
        $user_id=$request->input('user_id');

        $user=$this->UserModelDetails->get_record($user_id,'user_id');

        if(count($user)>0){
            $this->UserModelDetails->updateWithId($data,$user_id,'user_id');
              return redirect('Customer-List')->with('success', 'Updated successfully.'); 
        }else{
        if($this->UserModelDetails->insert($data)){
            return redirect('Customer-List')->with('success', 'Updated successfully.'); 
        }else{
            return redirect('Customer-List')->with('success', 'Updated successfully.'); 
        }
        }
             
    }
    
    public function editUser(Request $request){
        $id=$request->input('id');
        $data['alluser']=$this->AllUser::where('id',$id)->first();
        return view('user.edituser')->with($data);    
    }
    
    public function editUserfrm(Request $request,$id){
        $request->validate([
         
            'name' => 'required',
            'email' => 'required', 
            'mobile' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
          ]);
          
          $data['role_as']=3;
          
        if (Input::hasFile('image')){

           $file = Input::file('image');
           $name = $file->getClientOriginalName();
    
    
           $image = Image::make(Input::file('image')->getRealPath());
           $image->save(public_path() . '/profile/' . $file->getClientOriginalName());
    
           $data['image'] = $name;   
          }  
        
            $this->UserRepository->update($data,$id);
           return redirect('Customer-List')->with('success', 'Updated successfully.');
         
    }
    public function editWasher(Request $request){
        $id=$request->input('id');
        $data['alluser']=$this->AllUser::where('id',$id)->first();
        return view('user.editwasher')->with($data);    
    }
    public function editWasherfrm(Request $request,$id){
        $request->validate([
         
            'name' => 'required',
            'email' => 'required', 
            'mobile' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
          ]);
          
          $data['role_as']=2;
          
        if (Input::hasFile('image')){

           $file = Input::file('image');
           $name = $file->getClientOriginalName();
    
    
           $image = Image::make(Input::file('image')->getRealPath());
           $image->save(public_path() . '/profile/' . $file->getClientOriginalName());
    
           $data['image'] = $name;   
          }  
        
            $this->UserRepository->update($data,$id);
           return redirect('Washer-List')->with('success', 'Updated successfully.');
         
    }
    
    public function showBackground(Request $request){
        $id=$request->input('id');
        $data['background']= DB::table('background_check')->where(array('user_id'=>$id))->first();
        return view('background.index')->with($data);
       
        
    }
    
    public function showVehicleInsurance(Request $request){
         $id=$request->input('id');
       $data['vehicle']= DB::table('vehicle_insurance')->where(array('user_id'=>$id))->first();
       return view('vehicleinsurance.index')->with($data);
    }
    
    public function showVehicleRegistration(Request $request){
        $id=$request->input('id');
       $data['vehicle']= DB::table('add_vehicle')->where(array('user_id'=>$id))->first();
       return view('vehicleregistration.index')->with($data);
    }
    
    public function editShowPermission(Request $request){
       $id=$request->input('id');
       $data['id']=$id;
       $data['permission']=$this->AllUser::where(['id'=>$id])->first();
       return view('permission.index')->with($data);
        
    }
    
    public function permissionSettings(Request $request){
        $setting= $request->input('setting');
       $id= $request->input('id');
       $permi=json_encode($setting);

      $result=$this->AllUser::where(['id'=>$id])->get();
      if(count($result)>0){
  
          UserModel::where('id', $id)->update(['permission_settings' => $permi]);
      }
        return redirect('Roles1')->with('success', 'Created successfully.');

    }

    public function chnageBackgroupStatus(Request $request) {
        $id=$request->input('id');
    	$status=$request->input('status');
        $save=DB::table('background_check')->where(array('id'=>$id))->update(['status'=>$status]);
    	$data['success']=true;
    	echo json_encode($data);
    }

    public function changeVehicleInsurStatus(Request $request) {
        $id=$request->input('id');
    	$status=$request->input('status');
        $save=DB::table('vehicle_insurance')->where(array('id'=>$id))->update(['status'=>$status]);
    	$data['success']=true;
    	echo json_encode($data);
    }

    // changeVehicleRegStatus
    public function changeVehicleRegStatus(Request $request) {
        $id=$request->input('id');
    	$status=$request->input('status');
        $save=DB::table('add_vehicle')->where(array('id'=>$id))->update(['status'=>$status]);
    	$data['success']=true;
    	echo json_encode($data);
    }

    public function checkExpDateDocument(Request $request) {
        $currentDate = Carbon::now();

        $data = array();

        $vehicle_insurance  =   DB::table('vehicle_insurance')
                                ->whereDate('expiration_date', '<', $currentDate)
                                ->join('users', 'users.id', '=', 'vehicle_insurance.user_id')
                                ->get();

        if(count($vehicle_insurance)) {
            foreach ($vehicle_insurance as $key => $value) {
                $value->title = 'Vehicle Insurance expired.';
                array_push($data, $value);
            }
        }

        $vehicle_register  =   DB::table('add_vehicle')
                                ->whereDate('exp_date', '<', $currentDate)
                                ->join('users', 'users.id', '=', 'add_vehicle.user_id')
                                ->get();
        if(count($vehicle_register)) {
            foreach ($vehicle_register as $key => $value) {
                $value->title = 'Vehicle Registraion Date expired.';
                array_push($data, $value);
            }
        }

        $user_document  =   DB::table('user_document')
                                ->whereDate('expiry_date', '<', $currentDate)
                                ->join('users', 'users.id', '=', 'user_document.user_id')
                                ->get();

        if(count($user_document)) {
            foreach ($user_document as $key => $value) {
                $value->title = 'License Date expired.';
                array_push($data, $value);
            }
        }

        if(count($data) > 0) {
            foreach ($data as $key => $value) {

                if(!empty($value->remember_token)) {
                    $this->push_Notification($value->remember_token,$value->title,$value->title,$value->image, '11');
                }

                $useremail=$value->email;
                $to = $useremail;
                $to_name=$value->name;
                $to_email=$value->email;
                $mailData=array('to_name'=>$value->name,'to_email'=>$value->email,'messages'=>$value->title,'image'=>$value->image,'title'=>'SUDS-2-U.COM');
                 Mail::send('mail.usermessage', $mailData, function($message)use($mailData) {
                    $message->to($mailData["to_email"], $mailData["to_email"])
                    ->subject($mailData["title"]);
                });
            }
        }

        echo "<pre>";
        print_r($data);
        exit;

    }

    public function washerEarning(Request $request) {
        if(Auth::check()){
            $data['user'] = DB::table('users')->where('role_as', '=', 2)->orderBy('id', 'DESC')->get();

            // foreach ($data['user'] as $key => $value) {
            //     // SELECT booking_date, count(booking_id), SUM(total), SUM(totaltime) FROM `booking` WHERE washer_id = 161 GROUP BY booking_date
            //     $value->bookings = DB::table('booking')->where('washer_id', '=', $value->id)->select('booking_date', DB::raw('count(booking_id) as booking_count'), DB::raw('sum(total) as total_amt'))->groupBy('booking_date')->get();
            // }

            // echo "<pre>";
            // print_r($data['user']);
            // exit;

            return view('earning.index')->with($data);
        } else {
            return redirect('/Admin-Login');
        }
    }

    public function showBookingDetails(Request $request)
    {
        
        $id=$request->input('id');
        $data['bookings'] = DB::table('booking')->where('washer_id', '=', $id)->select('booking_date', DB::raw('count(booking_id) as booking_count'), DB::raw('sum(total) as total_amt'))->groupBy('booking_date')->get();
        return view('earning.show')->with($data);
    }
}