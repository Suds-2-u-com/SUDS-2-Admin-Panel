<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\BookingModel;
use Auth;
use DB;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $Booking;


    public function __construct(BookingModel $BookingModel)
    {
        $this->Booking=new UserRepository($BookingModel);
       
     
    }
    public function index()
    {
       if(Auth::check()){
      
        $data=[
            'booking'=> $this->Booking->all('booking_id')
        ];

        return view('booking.index')->with($data);
      
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
       
       $id=$request->input('id');
        $data=[
            'booking'=> $this->Booking->get_first_record($id,'booking_id')
        ];

        return view('booking.view')->with($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

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
    
    public function percentageAdjustable(){
        $data['percentage']=DB::table('percentage')->where(['id'=>1])->first();
        return view('percentage.index')->with($data);
    }
    
    public function addPercentage(Request $request){
        	$request->validate([
            'vendor_percentage' => 'required',
            'admin_percentage' => 'required',
            'washer_id'=>'required'
        ]);
        $data = $request->except([
            '_token',
          ]);
         $ar=DB::table('percentage')->where(array('washer_id'=>$request->washer_id))->get();
         if(count($ar)>0){
         	DB::table('percentage')->where(array('washer_id'=>$request->washer_id))->update(array('vendor_percentage'=>$request->vendor_percentage,'admin_percentage'=>$request->admin_percentage));
         }else{
	 	DB::table('percentage')->insert(array('vendor_percentage'=>$request->vendor_percentage,'admin_percentage'=>$request->admin_percentage,'washer_id'=>$request->washer_id,'created_at'=>date('Y-m-d')));
         }
		return redirect('Washer-List')->with('success', 'Updated successfully.');
    }
    
    
     public function adjustpersentage(Request $request){
        $data['id']=$id=$request->input('id');
        $data['percentage']=DB::table('percentage')->where(['washer_id'=>$id])->first();
        return view('percentage.edit')->with($data);
    }
    
    public function service(){
         if(Auth::check()){
      
        $data=[
            'service'=> DB::table('service')->get()
        ];

        return view('service.index')->with($data);
      
        }else{
            return redirect('/Admin-Login');
        }
    }
    
    public function createService(Request $request){
        	$request->validate([
            'name' => 'required',
            'price' => 'required',
          
        ]);
        $data = $request->except([
            '_token',
          ]);
      $insert= DB::table('service')->insert(array('name'=>$request->name,'price'=>$request->price,'created_at'=>date('Y-m-d')));   
      if(!empty($insert)){
          return redirect('Service')->with('success', 'Add successfully.');
      }else{
          return redirect('Service')->with('success', 'Update successfully.');
      }
          
    }
    
    public function editservice(Request $request){
        $id=$request->input('id');
        $data['service']=DB::table('service')->find($id);
        return view('service.edit')->with($data);
        
    }
    
    public function editservicefrm(Request $request,$id){
        	$request->validate([
            'name' => 'required',
            'price' => 'required',
          
        ]);
        $data = $request->except([
            '_token',
          ]);
      $insert= DB::table('service')->where(array('id'=>$id))->update(array('name'=>$request->name,'price'=>$request->price));   
    
       return redirect('Service')->with('success', 'Updated successfully.');
     
    }
}
