<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\ExtraMinHoursModel;
//use App\Customer;
use Auth;

class ExtraMinHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ExtraMinHours;
   
   

    public function __construct(ExtraMinHoursModel $ExtraMinHoursModel)
    {
        $this->ExtraMinHours=new UserRepository($ExtraMinHoursModel);
    
    }

    public function index()
    {
        if(Auth::check()){
        $data=[
            'extramin'=> $this->ExtraMinHours->all('id'),
           
        ];
        return view('extraminhours.index')->with($data);
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
            'min_hours' => 'required',
            'extra_time' => 'required',
            'price' => 'required',
            
        ]);
        $data = $request->except([
            '_token',
          ]);

        if($this->ExtraMinHours->create($data)){

        return redirect('Extra-Minutes-Hours')->with('success', 'Package created successfully.');
        }else{

        return redirect('Extra-Minutes-Hours')->with('error', 'Something went wrong');    
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
                'extra'=>$this->ExtraMinHours->get_first_record($id,'id'),
            
            ];
        return view('extraminhours.edit')->with($data);
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
            'min_hours' => 'required',
            'extra_time' => 'required',
            'price' => 'required',
        ]);
        $data = $request->except([
            '_token',
          ]);

        $this->ExtraMinHours->updateWithId($data,$id,'id');

        return redirect('Extra-Minutes-Hours')->with('success', 'Updated successfully.');
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
}
