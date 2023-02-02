<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\StateModel;
use App\CountryModel;
use Auth;
use DB;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $State;
    private $Country;
   

    public function __construct(StateModel $StateModel,CountryModel $CountryModel)
    {
        $this->State=new UserRepository($StateModel);
        $this->Country=new UserRepository($CountryModel);
        
    }

    public function index()
    {
        if(Auth::check()){
           
            $data=[
                'state'=>$this->State->where(array('state_name'=>'us')),
                'country'=>$this->Country->all('id') 
            ];
            return view('state.index')->with($data);
           
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
            'country_id' => 'required',
        ]);

        if($this->State->create($request->all())){

        return redirect('State')->with('success', 'State created successfully.');
        }else{

        return redirect('State')->with('error', 'Something went wrong');    
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
                'state'=>$this->State->get_first_record($id,'id'),
                'country'=>$this->Country->all('id') 
            ];
        return view('state.edit')->with($data);
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
            'country_id' => 'required',
        ]);

         $data = $request->except([
            '_token',
          ]); 

        $this->State->updateWithId($data,$id,'id');

        return redirect('State')->with('success', 'State Updated successfully.');
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
