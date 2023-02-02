<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\AddONSModel;
use App\PackageModel;
use App\CategoryModel;
use Auth;
use DB;
class AddONSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $AddONS;
    private $Package;
    private $Category;


    public function __construct(AddONSModel $AddONSModel,PackageModel $PackageModel,CategoryModel $CategoryModel)
    {
        $this->AddONS=new UserRepository($AddONSModel);
        $this->Package=new UserRepository($PackageModel);
        $this->Category=new UserRepository($CategoryModel);
    }


    public function index()
    {
        if(Auth::check()){
           
        $data=[
            // 'addons'=> $this->AddONS->all('id'),
            // 'package'=>$this->Package->all('package_id'),
            'category'=>$this->Category->all()
            // 'category'=>$this->Category->all('category_id')
        ];
        // echo "<pre>";
        // print_r($data);exit;
        return view('addons.index')->with($data);
       
        }else{
            return redirect('/Admin-Login');
        }
    }

    public function viewAddOns(Request $request) {
        $id=$request->input('id');
        $data['addons']= DB::table('add_ons')->where(array('package_id'=>$id))->get();
        
        return view('addons.showaddons')->with($data);
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
            'add_ons_name' => 'required',
            'add_ons_price' => 'required',
            'package_id'=>'required'
            
        ]);

        if($this->AddONS->create($request->all())){

        return redirect('Add-ONS-List')->with('success', 'Add-ONS created successfully.');
        }else{

        return redirect('Add-ONS-List')->with('error', 'Something went wrong');    
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
                'addons'=>$this->AddONS->get_first_record($id,'id'),
                'package'=>$this->Package->all('package_id'),
                'category'=>$this->Category->all('category_id')
            ];
        return view('addons.edit')->with($data);
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
            'add_ons_name' => 'required',
            'add_ons_price' => 'required',
            'package_id'=>'required'
           
        ]);
         $data = $request->except([
            '_token',
          ]); 

        $this->AddONS->updateWithId($data,$id,'id');

        return redirect('Add-ONS-List')->with('success', 'Add ONS Updated successfully.');
        
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

    public function addons(Request $request){
        $id=$request->input('category_id');
        // if($id!='1'){
        $addons=$this->AddONS->get_record($id,'package_id');
        return view('addons.alladdons')->with(['addons'=>$addons]);
       // }
    }
}
