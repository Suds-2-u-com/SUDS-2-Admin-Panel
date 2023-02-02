<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\PackageModel;
use App\CategoryModel;
use App\SubCategoryModel;
use App\AddONSModel;
use DB;
use Auth;
use App\UserpackagesModel; 
use App\OnSiteRequest;
use App\PressRequestModel;
use App\UserModel;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $UserPackage;
    private $UserPackageModel;
    private $CategoryModel;
    private $SubCategory;
    private $Onsiterequest;
    private $UserpackagesModel;
    private $Pressrequest;
    
    public function __construct(UserModel $UserModel,OnSiteRequest $OnSiteRequest,PackageModel $PackageModel,CategoryModel $CategoryModel,SubCategoryModel $SubCategoryModel,AddONSModel $AddONSModel,UserpackagesModel $UserpackagesModel,PressRequestModel $PressRequestModel)
    {
        $this->UserPackage=new UserRepository($PackageModel);
        $this->UserPackageModel=$PackageModel;
        $this->CategoryModel=new UserRepository($CategoryModel);
        $this->SubCategory=new UserRepository($SubCategoryModel);
        $this->AddONS=new UserRepository($AddONSModel);
        $this->Onsiterequest=new UserRepository($OnSiteRequest);
        $this->Pressrequest=new UserRepository($PressRequestModel);
        $this->userpackage=new UserRepository($UserpackagesModel);
        $this->User=new UserRepository($UserModel);
    }


    public function index()
    {
        if(Auth::check()){
            
        $data=[
            'package'=> $this->UserPackage->all('package_id'),
            'category'=>$this->CategoryModel->all('category_id')
        ];
        return view('package.index')->with($data);
       
        }else{
            return redirect('/Admin-Login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
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
            'package_name' => 'required',
            'package_price' => 'required',
            'package_description' => 'required',
            'category_id' => 'required',
           
            'package_time'=>'required',
        ]);
        $data = $request->except([
            '_token',
            'add_ons'
          ]);
        $add_ons=$request->input('add_ons');
        if(!is_null($add_ons) or !empty($addons)){
        $data['addons_id']=implode(',', $add_ons);
        }
        if($this->UserPackage->create($data)){

        return redirect('Packages-List')->with('success', 'Package created successfully.');
        }else{

        return redirect('Packages-List')->with('error', 'Something went wrong');    
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
                'package'=>$this->UserPackage->get_first_record($id,'package_id'),
                'category'=>$this->CategoryModel->all('category_id'),
                'subcategory'=>$this->SubCategory->all('subcategory')
                
            ];
        return view('package.edit')->with($data);
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
            'package_name' => 'required',
            'package_price' => 'required',
            'package_description' => 'required',
            'category_id' => 'required',
           
             'package_time'=>'required'
        ]);
        $data = $request->except([
            '_token',
             'add_ons'
          ]);
        $add_ons=$request->input('add_ons');
        if(!is_null($add_ons) or !empty($addons)){
        $data['addons_id']=implode(',', $add_ons);
        }else{
            $data['addons_id']='';
        }
        $this->UserPackage->updateWithId($data,$id,'package_id');

        return redirect('Packages-List')->with('success', 'Package Updated successfully.');
       
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


    public function deleteEntry(Request $request){
        $id=decryption($request->input('id'));
        $table=$request->input('tablename');
        $idname=$request->input('idname');
        $this->UserPackageModel::deleteEntry($id,$table,$idname);
        echo json_encode(array('response'=>true));
        //return redirect('Packages-List')->with('success', 'Deleted successfully.');
    }
    
    public function acceptEntry(Request $request){
        $id=decryption($request->input('id'));
        $table=$request->input('tablename');
        $idname=$request->input('idname');
        //$this->Onsiterequest->updateWithId(array('status'=>1),$id,'id');
        $this->UserPackageModel::updateEntry($table,array('status'=>1),$id,'id');
        echo json_encode(array('response'=>true));
        
    }
    
    public function acceptReject(Request $request){
        $id=decryption($request->input('id'));
        $table=$request->input('tablename');
        $idname=$request->input('idname');
        //$this->Onsiterequest->updateWithId(array('status'=>2),$id,'id');
        $this->UserPackageModel::updateEntry($table,array('status'=>2),$id,'id');
        echo json_encode(array('response'=>true));
    }
    
    public function onDemandPackage(){
        // $data['package']=$this->userpackage->all();
        // $data['user']=$this->User->where(array('role_as'=>2));
        $data['user'] = DB::table('users')->where('role_as', '=', 2)->orderBy('id', 'DESC')->get();
        return view('userpackage.index')->with($data);
    }
    
    public function addUserPackage(Request $request){
        
        $request->validate([
            'user_id' => 'required',
            'price' => 'required',
            'package_time' => 'required',
            'type' => 'required',
            'description'=>'required',
           
        ]);
        $data = $request->except([
            '_token',       
           
          ]);
       
        if($this->userpackage->create($data)){

        return redirect('On-Demand-Packages-List')->with('success', 'Package created successfully.');
        }else{

        return redirect('On-Demand-Packages-List')->with('error', 'Something went wrong');    
        }
    }
    
    public function editUserPackage(Request $request){
        $id=$request->input('id');
        $data['package']=$this->userpackage->find($id);
        $data['user']=$this->User->where(array('role_as'=>2));
        return view('userpackage.edit')->with($data);
    }
    
    public function editUserPackageFrm(Request $request,$id){
        $request->validate([
            'user_id' => 'required',
            'price' => 'required',
            'package_time' => 'required',
            'type' => 'required',
            'description'=>'required',
           
        ]);
        $data = $request->except([
            '_token',
           
          ]);
       
        $this->userpackage->update($data,$id);

        return redirect('On-Demand-Packages-List')->with('success', 'Package created successfully.');
       
    }

    public function showPackages(Request $request)
    {
        $id=$request->input('id');
        $data['packages'] = DB::table('user_packages')->where('user_id', '=', $id)->get();
        return view('userpackage.show')->with($data);
    }
}
