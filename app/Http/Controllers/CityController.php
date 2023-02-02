<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\CityModel;
use App\StateModel;
use Auth;
use DB;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $City;
    private $State;

    public function __construct(CityModel $CityModel,StateModel $StateModel)
    {
        $this->City=new UserRepository($CityModel);
        $this->State=new UserRepository($StateModel);
        
    }
    public function index()
    {
      if(Auth::check()){
          
            $data=[
                'city'=>$this->City->pagination(),
                'state'=>$this->State->where(array('state_name'=>'us'))
            ];
    
            return view('city.index')->with($data);
           
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
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
        ]);

        if($this->City->create($request->all())){

        return redirect('City')->with('success', 'City created successfully.');
        }else{

        return redirect('City')->with('error', 'Something went wrong');    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id=$request->input('id');
        $data=[
                'city'=>$this->City->get_first_record($id,'id'),
                 'state'=>$this->State->where(array('state_name'=>'us'))
               
            ];
        return view('city.edit')->with($data);
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
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
        ]);
        
         $data = $request->except([
            '_token',
          ]); 

        $this->City->updateWithId($data,$id,'id');

        return redirect('City')->with('success', 'City Updated successfully.');
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
    
    public function cities(Request $request){
         $request->validate([
            'search' => 'required',
        ]);
        
        $data = $request->except([
            '_token',
        ]); 
        $search = $request->input('search');
       
        $data= DB::table('countries')->select('cities.id','cities.name','cities.status')->join('states','states.country_id','=','countries.id')->join('cities','cities.state_id','=','states.id')->where(['countries.id'=>231])->where('cities.name', 'like', '%' . $search . '%')->get();
        echo json_encode(array('data'=>$data)); 
    }

    public function changeCitiesStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);
        
        $data = $request->except([
            '_token',
        ]);

        $status = $request->status == 1 ? 0 : 1;
        $id = $request->id;

        $insert= DB::table('cities')->where(array('id'=>$id))->update(array('status'=>$status)); 
        
        echo json_encode($insert);
    }

    public function washerCities(Request $request)
    {
        if(Auth::check()){
            $data=[
                'city'=>DB::table('washer_no_cities')->join('cities','city_id', '=', 'cities.id')->select('cities.*')->get(),
                'state'=>$this->State->where(array('state_name'=>'us'))
            ];
            return view('washerCities.index')->with($data);
        } else {
        return redirect('/Admin-Login');
       }
    }

    public function cityInquiry(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); exit;
        $city = DB::table('washer_no_cities')->insert(array('city_id'=>$request->input('id')));
        echo json_encode($city);
    }
}
