<?php
use App\UserModel;
use App\VehicleModel;
use App\PackageModel;
use App\CategoryModel;
use App\SubCategoryModel;
use App\AddONSModel;
use App\BookingModel;
use App\TransactionsModel;
use App\ReviewModel;
use App\OnSiteRequest;
use Illuminate\Support\Facades\Crypt;


	 function userDetails(){
	 $user=UserModel::where('id',Auth::id())->first();
     
	  return $user;

	}


    function encryption($id)
    {
      return  $encrypted = Crypt::encryptString($id);
        
    }

   function decryption($id)
    {
        return $decrypt= Crypt::decryptString($id);
        
    }

    function country($id){
    	$country=DB::table('countries')->where('id',$id)->first();
    	if(!empty($country)){
    		return $country->name;
    	}
    	return false;
    }
    function state($id){
    	$states=DB::table('states')->where('id',$id)->first();
    	if(!empty($states)){
    		return $states->name;
    	}
    	return false;
    }
    function city($id){
    	$cities=DB::table('cities')->where('id',$id)->first();
    	if(!empty($cities)){
    		return $cities->name;
    	}
    	return false;
    }

    function userName($id){
        $user=UserModel::where('id',$id)->first();
        if(!empty($user)){
          return $user->name;
        }else{
         return false;
        }
    }
    
     function userEmail($id){
        $user=UserModel::where('id',$id)->first();
        if(!empty($user)){
          return $user->email;
        }else{
         return false;
        }
    }
    
      function userMobile($id){
        $user=UserModel::where('id',$id)->first();
        if(!empty($user)){
          return $user->mobile;
        }else{
         return false;
        }
    }
    
     function userEmails($id){
        $user=UserModel::where('id',$id)->first();
        if(!empty($user)){
          return $user->email;
        }else{
         return false;
        }
    }
    
    function cityUserid($id){
        
        $city=\DB::table('user_details')->where('user_id',$id)->first();
        if(!empty($city)){
        return $city->city;
      }else{
        return false;
      }
    }


    function vehicleName($id){
        $vehicle=VehicleModel::where('vehicle_id',$id)->first();
        if(!empty($vehicle)){
        return $vehicle->model;
       }else{
        return false;
       }
    }

    function packages($id){
        $vehicle=PackageModel::where('package_id',$id)->first();
        if(!empty($vehicle)){
        return $vehicle->package_name;
      }else{
        return false;
      }
    }


    function categoryname($id){
        $category=CategoryModel::where('category_id',$id)->first();
        if(!empty($category)){
        return $category->category_name;
       }else{
        return false;
       }
    }

    function subcategory($id){
        $subcategory=SubCategoryModel::where('category_id',$id)->get();
        if(!empty($subcategory)){
            $data=array();
            foreach ($subcategory as $key => $value) {
                $data[]=$value->subcategory_name;
            }
            $name=implode(',', $data);
          return $name;
        }else{
        return false;
         }
    }

    function subcategoryname($id){
        $subcategory=SubCategoryModel::where('subcategory_id',$id)->first();
        if(!empty($subcategory)){
            return $subcategory->subcategory_name;
        }else{
           return false;
        }
    }

  
    function userBankdetails($id){
        $user=UserModel::join('bank','bank.user_id','=','users.id')->where('users.id',$id)->first();
        if(!empty($user)){

            $html='<tr>
        <th>Name</th>
        <td>'.$user->bank_name.'</td>
    </tr>
    <tr>
        <th>Account Number</th>
        <td>'.$user->account_number.'</td>
    </tr>
    <tr>
        <th>Rounting Number</th>
        <td>'.$user->routing_number.'</td>
    </tr>
    <tr>
        <th>Bank Code</th>
        <td>'.$user->bank_code.'</td>
    </tr>
    
    <tr>
        <th>Branch Code</th>
        <td>'.$user->branch_code.'</td>
    </tr>';
          echo $html;
        }else{
         return false;
        }
    }
    
    function userBankdetailsWasher($id){
        $user=UserModel::join('bank','bank.user_id','=','users.id')->where('users.id',$id)->first();
        if(!empty($user)){
            return $user;
        }else{
            return false;
        }
    }
    
    function addonsname($id){
    $addons=AddONSModel::whereIn('id',$id)->get();
  
    if(!empty($addons)){
        $data='';
       foreach ($addons as $key => $value) {
           $data.= $value->add_ons_name.',';
       }
       return $data;
    }else{
        return false;
    }
   }
   
     function addons($id){
        $addons=AddONSModel::whereIn('id',$id)->get();
      
        if(!empty($addons)){
            
           return $addons;
        }else{
            return false;
        }
   }
   
   function todaywash(){
       $book=BookingModel::where('booking_date',date('Y-m-d'))->count();
       if($book>0){
       return $book;
       }else{
           return 0;
       }

   }
      function totalwash(){
       $wash=UserModel::where('role_as','2')->count();
       if($wash>0){
       return $wash;
       }else{
           return 0;
       }

   }
   
   function totalCustomer(){
       $customer=UserModel::where('role_as','3')->count();
       if($customer>0){
       return $customer;
       }else{
           return 0;
       }

   }
   
   function totalPaymentReceived(){
       $payment=TransactionsModel::where('status',1)->count();
       if($payment>0){
           return $payment;
       }else{
           return 0;
       }
   }
   
   function totalPendingPayment(){
       $payment=TransactionsModel::where('status',0)->count();
       if($payment>0){
           return $payment;
       }else{
           return 0;
       }
   }
   
   function totalPayOut(){
     $account=TransactionsModel::select(DB::raw('SUM(washer_amt) AS amount'))->where('status',1)->get();
       if($account[0]->amount >0){
           return $account[0]->amount;
       }else{
           return 0;
       }  
   }
   function totalRevenue(){
      $account=TransactionsModel::selectRaw('SUM(amount - washer_amt) as month_revenue')->where('status',1)->get();
     if($account[0]->month_revenue>0){
           return $account[0]->month_revenue;
       }else{
           return 0;
       }  
   }
   
   
    function totalOnsite(){
        
    $account=OnSiteRequest::count();
    if($account>0){
           return $account;
       }else{
           return 0;
       } 
   }
   
   
     function discount($id){
    return UserModel::getAllDocOfUser($id);
   }

   function bank($id){
    return UserModel::getAllBankDetailsOfUser($id);
   }

   function review($id){
   return ReviewModel::where('to_id',$id)->get();
   }
   
   function sendmail($to,$name,$message,$body='',$html=''){
        $to_name=$name;
        $to_email=$to;
        $data=array("name"=>$name,"body"=>$body);
        Mail::send($html,$data,function($message) use ($to_name,$to_email){
        	$message->to($to_email)->subject('Verification otp');
        });
   }
      function totalOnFreeWashes(){
     $rew= \DB::table('reward')
                 ->select('user_id','created_at', DB::raw('count(*) as total'))
                 ->having('total','>=',10)
                 ->groupBy('user_id')
                 ->get();
                 if(count($rew)>0){
                 
                     return count($rew);
                 }else{
                     return 0;
                 }
  }

    function permission($id){
       $permission=\DB::table('users')->where('id',$id)->first();
       if(!empty($permission)){
        return $permission->permission_settings;
       }else{
        return null;
       }
    }

 
?>