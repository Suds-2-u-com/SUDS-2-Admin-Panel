<?php
namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlesZatloukal\GoogleSearchApi\GoogleSearchApi;
use Validator;
use Auth;
use App\Http\Requests;
use App\StateModel;
use App\CityModel;
use App\CountryModel;
use App\RequestModel;
use App\AppRequestModel;
use App\OnSiteRequest;
use App\UserModel;
use App\UserDetailsModel;
use App\PressRequestModel;
use App\CategoryModel;
use App\MailingModel;
use DB;
use Hash;
class HomeController extends Controller
{
	private $state;
	private $city;
	private $request;
	private $apprequest;
	private $country;
	private $OnSiteRequest;
	private $user;
	private $userdetails;
	private $pressrequest;
    private $category;
    private $mailing;
    
    public function __construct(StateModel $StateModel,CityModel $CityModel,RequestModel $RequestModel,AppRequestModel $AppRequestModel,CountryModel $CountryModel,OnSiteRequest $OnSiteRequest,UserModel $UserModel,UserDetailsModel $UserDetailsModel,PressRequestModel $PressRequestModel,CategoryModel $CategoryModel,MailingModel $MailingModel)
    {
        $this->state=new UserRepository($StateModel);
        $this->city=new UserRepository($CityModel);
        $this->request=new UserRepository($RequestModel);
        $this->Apprequest=new UserRepository($AppRequestModel);
        $this->country=new UserRepository($CountryModel);
        $this->OnSiteRequest=new UserRepository($OnSiteRequest);
        $this->user=new UserRepository($UserModel);
    	$this->userdetails=new UserRepository($UserDetailsModel);
    	$this->pressrequest=new UserRepository($PressRequestModel);
    	$this->category=new UserRepository($CategoryModel);
    	$this->mailing=new UserRepository($MailingModel);
    }

	public function index(){
		$data=['state'=>$this->state->where(array('country_id'=>231))->sortBy('name'),'category'=>$this->category->all()];
		return view('website.index',$data);
	}


	public function getAnApp(){
		return view('website.get_an_app');
	}

	public function orderOnSite(){
		$data=['country'=>$this->country->all(),'category'=>$this->category->all(),'state'=>$this->state->where(array('country_id'=>231))->sortBy('name')];
		return view('website.order_on_site',$data);
	}

	public function cities(){
	    $data['city']=DB::table('countries')->select('cities.id','cities.name')->join('states','states.country_id','=','countries.id')->join('cities','cities.state_id','=','states.id')->get();
	    $data=['state'=>$this->state->where(array('country_id'=>231))->sortBy('name')];
		return view('website.cities',$data);
	}

	public function faq(){
		return view('website.faq');
	}

	public function Blog(){
		return view('website.blog');
	}

	public function Press(){
		$data=['country'=>$this->country->all(),'category'=>$this->category->all(),'state'=>$this->state->where(array('country_id'=>231))->sortBy('name')];
		return view('website.press',$data);
	}

	public function blogDetails(){
		return view('website.blog-details');
	}

	public function newDetails(){
		return view('website.news-details');
	}

	public function becomeAWasher(){
		$data=['country'=>$this->country->all(),'city'=>DB::table('countries')->select('cities.id','cities.name')->join('states','states.country_id','=','countries.id')->join('cities','cities.state_id','=','states.id')->get()];
		return view('website.become-a-washer',$data);
	}

	public function requestSend(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => 'required|regex:/^[\pL\s\-]+$/u',
            'lname' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'service'=>'required',
            'state'=>'required',
            'city'=>'required',
            'zip_code'=>'required',
            'address'=>'required',
            'payment_method'=>'required',
            'how_many'=>'required',
            'property_type'=>'required',
        ]);
        if ($validator->passes()) {

        	 $data = $request->except([
            '_token',
          ]);
	        $data['status']=0;
	        if($this->request->create($data)){
	            return response()->json(['success'=>'Added new records.']);
	        }else{
	        	return response()->json(['error'=>'Something Went Wrong']);
	        }
      }
        return response()->json(['error'=>$validator->errors()]);
	}


	public function city(Request $request){
		$id=$request->input('id');
		$data=['city'=>$this->city->get_record($id,'state_id')];
		return view('website.city',$data);
	}

	public function state(Request $request){
		$id=$request->input('id');

		$data=['city'=>$this->state->get_record($id,'country_id')];
		return view('website.city',$data);
	}
	


	public function appRequestSend(Request $request){
		$validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric', 
             'device' => 'required', 
        ]);
        if ($validator->passes()) {

        	 $data = $request->except([
            '_token',
          ]);
         $type=$this->type($request->input('mobile'));
        $device=   $request->input('device');
	        if($this->Apprequest->create($data)){
	            if($device==1){
	            $message='Download SUDS-2-U Android App- https://play.google.com/store/apps/details?id=com.suds_2_u';
	            }else{
	            $message='Download SUDS-2-U IOS App- https://play.google.com/store/apps/details?id=com.suds_2_u';    
	            }
	            $this->sms($message,$request->input('mobile'));
	            return response()->json(['success'=>'Added new records.']);
	        }else{
	        	return response()->json(['error'=>'Something Went Wrong']);
	        }
      }
        return response()->json(['error'=>$validator->errors()->all()]);
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
          //CURLOPT_POSTFIELDS => 'Body='.$message.'&From=%2B15202145984&To=%2B'.$mobile.'&Url=http://demo.twilio.com/docs/voice.xml',
          //CURLOPT_POSTFIELDS => 'Body='.$message.'&From=%2B15202145984&To='.$mobile->to_id.'&Url=http://demo.twilio.com/docs/voice.xml',
          CURLOPT_POSTFIELDS => 'Body='.$message.'&From=%2B15202145984&To=%2B'.'91'.$mobile,
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic QUNjYWQzOWJhN2QwOGVhYzUzYzE4MTE5NGMyMzhkNzgyNDoyNGUzZTNkNzIzNTc2NDEzNWVjZjlhZDcxN2EyZDdkYQ==',
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);
        return $response;
    }
    
    public function type($mobile){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://lookups.twilio.com/v1/PhoneNumbers/+'.$mobile.'?Type=carrier',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic QUNjYWQzOWJhN2QwOGVhYzUzYzE4MTE5NGMyMzhkNzgyNDoyNGUzZTNkNzIzNTc2NDEzNWVjZjlhZDcxN2EyZDdkYQ==',
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);
        return $response;
    }

	public function onSiteRequest(Request $request){
		$validator = Validator::make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u', 
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u', 
            'email' => 'required|email', 
            'phone_number' => 'required|numeric', 
            'property_type' => 'required', 
            'address' => 'required', 
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'type_of_wash'=>'required',
            'how_many'=>'required',
            'payment_method'=>'required'
        ]);
        if ($validator->passes()) {

        	 $data = $request->except([
            '_token',
          ]);
	        if($this->OnSiteRequest->create($data)){
	            return response()->json(['success'=>'Added new records.']);
	        }else{
	        	return response()->json(['error'=>'Something Went Wrong']);
	        }
      }
        return response()->json(['error'=>$validator->errors()]);
	}


	public function addBecomeAWasher(Request $request){
		$validator = Validator::make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u', 
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u', 
            'email' => 'required|email|unique:users,email', 
            'mobile' => 'required|numeric|exists:users', 
            'city' => 'required', 
            'state' => 'required', 
            'address' => 'required', 
            
            'suds_account'=>'required',
            'company'=>'required|regex:/^[\pL\s\-]+$/u',
            'password'=>'required|same:confirm_password',
            'confirm_password'=>'required',
        ]);
        if ($validator->passes()) {

        	 $data = $request->except([
            '_token',
            'first_name',
            'last_name',
            'city',
            'suds_account',
            'company',
            'password',
            'confirm_password',
            'address',
            'state'
          ]);
        	 $data['status']=0;
        	 $data['role_as']=2;
        	 $data['password']=Hash::make($request->input('password'));
        	 $data['name']=$request->input('first_name').' '.$request->input('last_name');
        	 $result=$this->user->create($data);
	        if($result){
	        	$this->userdetails->create(['user_id'=>$result->id,'preferred_method_of_contact'=>$request->input('mobile'),'city'=>$request->input('city'),'state'=>$request->input('state'),'address'=>$request->input('address'),'language'=>$request->input('language'),'suds_account'=>$request->input('suds_account'),'company'=>$request->input('company')]);

	            return response()->json(['success'=>'Added new records.']);
	        }else{
	        	return response()->json(['error'=>'Something Went Wrong']);
	        }
        }
        return response()->json(['error'=>$validator->errors()]);

	}

	public function addPressRequest(Request $request){
		/*$validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u', 
            'email' => 'required|email', 
            'message' => 'required', 
        ]);*/
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'company_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'state'=>'required',
            'city'=>'required',
            'zip_code'=>'required',
            'address'=>'required',
            'payment_method'=>'required',
            'how_many'=>'required',
            'property_type'=>'required',
        ]);
        if ($validator->passes()) {

        	 $data = $request->except([
            '_token',
          ]);
        	 
        	 $result=$this->pressrequest->create($data);
	        if($result){
	            return response()->json(['success'=>'Added new records.']);
	        }else{
	        	return response()->json(['error'=>'Something Went Wrong']);
	        }
        }
        return response()->json(['error'=>$validator->errors()]);
	}
	
      public function submitmail(Request $request){
          
            $validator = Validator::make($request->all(), [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email',
                'city'=>'required',
                'mobile'=>'required'
            ]);
            if ($validator->passes()) {
    
            	 $data = $request->except([
                '_token',
              ]);
    	      
    	        if($this->mailing->create($data)){
    	        
    	            return response()->json(['success'=>'Added new records.']);
    	        }else{
    	        	return response()->json(['error'=>'Something Went Wrong']);
    	        }
          }
            return response()->json(['error'=>$validator->errors()]);
    	}
    	
    	
    	function file_get_contents_curl($url) {
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
            curl_setopt($ch, CURLOPT_URL, $url);
        
            $data = curl_exec($ch);
            curl_close($ch);
        
            return $data;
        }
        
        
        public function search(Request $request){
        //   $query = "umeed";
        //     $url = 'http://www.google.co.in/search?q='.urlencode($query).'';
        //     $scrape = $this->file_get_contents_curl($url);
        //  echo $scrape;
            $googleSearch = new GoogleSearchApi(); // initialize
            $data['results'] =$data= $googleSearch->getResults($request->input('search'));
            
           	$google= view('website.googlesearch')->with($data)->render();
        
           	if(count($data['results'])>0){
           	echo json_encode(array('response'=>true,'html'=>$google));
           	}else{
           	   echo json_encode(array('response'=>false)); 
           	}
          
        }
}

?>