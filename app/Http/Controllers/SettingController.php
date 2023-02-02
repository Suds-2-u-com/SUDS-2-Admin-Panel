<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\SettingModel;
use Auth;
use DB;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $Setting;


    public function __construct(SettingModel $SettingModel)
    {
        $this->Setting=new UserRepository($SettingModel);
    }

    public function index()
    {
        if(Auth::check()){
        
            $data=[
            'setting'=> $this->Setting->all('id')
        ];

        return view('setting.index')->with($data);
         
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
            'distance_fee' => 'required',
            'distance_price' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
          ]);

        if($this->Setting->create($data)){

        return redirect('Distance')->with('success', 'Distance created successfully.');
        }else{

        return redirect('Distance')->with('error', 'Something went wrong');    
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
                'setting'=>$this->Setting->get_first_record($id,'id'),
            ];
        return view('setting.edit')->with($data);
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
            'distance_fee' => 'required',
            'distance_price' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
          ]);

        $this->Setting->updateWithId($data,$id,'id');

        return redirect('Distance')->with('success', 'Distance Updated successfully.');
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

    public function radius()
    {
        if(Auth::check()){
        
            $data=[
            'radius'=> DB::table('radius')->get()
        ];

        return view('radius.index')->with($data);
         
        }else{
            return redirect('/Admin-Login');
        }
    }

    public function radiusAdd(Request $request)
    {
        $request->validate([
            'radius' => 'required',
           
        ]);
        $data = $request->except([
            '_token',
        ]);
        $insert= DB::table('radius')->insert(array('radius'=>$request->radius)); 
        if(!empty($insert)){
            return redirect('Radius')->with('success', 'Radius created successfully.');
        }else{
            return redirect('Radius')->with('error', 'Something went wrong');    
        }
    }

    public function radiusGet(Request $request)
    {
        $id = $request->id;
        $data['radius']=DB::table('radius')->find($id);
        return view('radius.edit')->with($data);
    }

    public function radiusUpdate(Request $request, $id)
    {
        $request->validate([
            'radius' => 'required',
        ]);
        $data = $request->except([
            '_token',
        ]);
        $insert= DB::table('radius')->where(array('id'=>$id))->update(array('radius'=>$request->radius));   
        return redirect('Radius')->with('success', 'Updated successfully.');
    }

}
