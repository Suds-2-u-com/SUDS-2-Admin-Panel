<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\RequestModel;
use App\AppRequestModel;
use App\OnSiteRequest;
use App\PressRequestModel;
use App\CategoryModel;
use App\CityModel;
use App\StateModel;
use Auth;
use Validator;
use DB;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $Request;
    private $Apprequest;
    private $Onsiterequest;
    private $Pressrequest;


    public function __construct(OnSiteRequest $OnSiteRequest,RequestModel $RequestModel,AppRequestModel $AppRequestModel,PressRequestModel $PressRequestModel)
    {
        $this->Request=new UserRepository($RequestModel);
        $this->Apprequest=new UserRepository($AppRequestModel);
        $this->Onsiterequest=new UserRepository($OnSiteRequest);
        $this->Pressrequest=new UserRepository($PressRequestModel);
    }
    public function index()
    {
       if(Auth::check()){
        
        $data=[
            'request'=> $this->Request->all()
        ];

        return view('booking.request')->with($data);
        
        }else{
            return redirect('/Admin-Login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data       = RequestModel::find($request->id);
        $category   = CategoryModel::select('category_id','category_name')->get();
        $state      = StateModel::where('country_id',231)->get();
        $city       = CityModel::where('state_id',$data->state)->get();
        return view('booking.edit_request',compact('data','category','state','city'));
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|regex:/^[\pL\s\-]+$/u',
            'lname' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'service'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'zip_code'=>'required',
            'address'=>'required',
            'payment_method'=>'required',
            'how_many'=>'required',
            'property_type'=>'required',
        ]);
        if ($validator->passes()) {
            $data = RequestModel::find($request->id);
            $data->fname            = $request->fname;
            $data->lname            = $request->lname;
            $data->email            = $request->email;
            $data->phone            = $request->phone;
            $data->service          = $request->service;
            $data->state            = $request->state_id;
            $data->city             = $request->city_id;
            $data->zip_code         = $request->zip_code;
            $data->address          = $request->address;
            $data->payment_method   = $request->payment_method;
            $data->how_many          = $request->how_many;
            $data->property_type    = $request->property_type;
            $data->update();
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function appRequest(){
        if(Auth::check()){

        $data=[
            'apprequest'=> $this->Apprequest->all()
        ];

        return view('booking.app_request')->with($data);
        }else{
            return redirect('/Admin-Login');
        }
    }

    public function onSiteRequest(){
        if(Auth::check()){

        $data=[
            'onsiterequest'=> $this->Onsiterequest->all()
        ];

        return view('booking.on_site_request')->with($data);
        }else{
            return redirect('/Admin-Login');
        }
    }
    
    public function editOnSiteRequest(Request $request)
    {
        $data       = OnSiteRequest::find($request->id);
        $category   = CategoryModel::select('category_id','category_name')->get();
        $state      = StateModel::where('country_id',231)->get();
        $city       = CityModel::where('state_id',$data->state)->get();
        return view('booking.edit_on_site_request',compact('data','category','state','city'));
    }
    
    public function updateOnSiteRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u', 
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u', 
            'email' => 'required|email', 
            'phone_number' => 'required|numeric', 
            'property_type' => 'required', 
            'address' => 'required', 
            'state_id' => 'required',
            'city_id' => 'required',
            'zip_code' => 'required',
            'type_of_wash'=>'required',
            'how_many'=>'required',
            'payment_method'=>'required'
        ]);
        if ($validator->passes()) {
            $data = OnSiteRequest::find($request->id);
            $data->first_name       = $request->first_name;
            $data->last_name            = $request->last_name;
            $data->email            = $request->email;
            $data->phone_number            = $request->phone_number;
            $data->property_type          = $request->property_type;
            $data->address          = $request->address;
            $data->state            = $request->state_id;
            $data->city             = $request->city_id;
            $data->zip_code         = $request->zip_code;
            $data->payment_method   = $request->payment_method;
            $data->how_many          = $request->how_many;
            $data->update();
        }
        return redirect()->back();
    }

    public function pressRequest(){
        if(Auth::check()){

        $data=[
            'pressrequest'=> $this->Pressrequest->all()
        ];

        return view('booking.press_request')->with($data);
        }else{
            return redirect('/Admin-Login');
        }
    }
    
    public function editPressRequest(Request $request)
    {
        $data       = PressRequestModel::find($request->id);
        $category   = CategoryModel::select('category_id','category_name')->get();
        $state      = StateModel::where('country_id',231)->get();
        $city       = CityModel::where('state_id',$data->state)->get();
        return view('booking.edit_press_request',compact('data','category','state','city'));
    }
    
    public function updatePressRequest(Request $request)
    {
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
            'state_id'=>'required',
            'city_id'=>'required',
            'zip_code'=>'required',
            'address'=>'required',
            'payment_method'=>'required',
            'how_many'=>'required',
            'property_type'=>'required',
        ]);
        if ($validator->passes()) {
            $data = PressRequestModel::find($request->id);
            $data->first_name       = $request->first_name;
            $data->last_name        = $request->last_name;
            $data->company_name     = $request->company_name;
            $data->email            = $request->email;
            $data->phone_number     = $request->phone_number;
            $data->property_type    = $request->property_type;
            $data->address          = $request->address;
            $data->state            = $request->state_id;
            $data->city             = $request->city_id;
            $data->zip_code         = $request->zip_code;
            $data->payment_method   = $request->payment_method;
            $data->how_many         = $request->how_many;
            $data->update();
        }
        return redirect()->back();
    }
    
    public function viewDetailsOnSiteRequest(Request $request){
        if(Auth::check()){

        $data=[
            'pressrequest'=> $this->Onsiterequest->where(array('id'=>$request->input('id')))
        ];

        return view('booking.press_request_view')->with($data);
        }else{
            return redirect('/Admin-Login');
        }
    }
    
    
    public function viewRequest(Request $request){
        if(Auth::check()){

        $data=[
            'pressrequest'=> $this->Request->where(array('id'=>$request->input('id')))
        ];

        return view('booking.washer_request_view')->with($data);
        }else{
            return redirect('/Admin-Login');
        }
    }
    
    
    

   

}
