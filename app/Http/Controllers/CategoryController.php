<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\CategoryModel;
use App\SubCategoryModel;
use Auth;
use DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $Category;
    private $SubCategoryModel;

    public function __construct(CategoryModel $CategoryModel,SubCategoryModel $SubCategoryModel)
    {
        $this->Category=new UserRepository($CategoryModel);
        $this->SubCategory= new UserRepository($SubCategoryModel);
    }
    public function index()
    {
        if(Auth::check()){
            
        $data=[
            'category'=> $this->Category->all('category_id')
        ];
        return view('category.index')->with($data);
        
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
            'category_name' => 'required',
            
            
        ]);
        $data = $request->except([
            '_token',
          ]);
        $dataArray['category_name']=$request->input('category_name');
        // $dataArray['comission']=$request->input('comission');
        $cat=$request->input('category_price');
        $result=$this->Category->create($dataArray);
        if($result){
          
            $category=array();
            if(!empty($cat)){
            foreach ($cat as $key => $value) {
                $category[]=array('category_id'=>$result->category_id,'subcategory_name'=>$value);
            } }
            $this->SubCategory->insert($category);
        return redirect('Category-List')->with('success', 'Category created successfully.');
        }else{

        return redirect('Category-List')->with('error', 'Something went wrong');    
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
                'category'=>$this->Category->get_first_record($id,'category_id'),
                'subcategory'=>$this->SubCategory->get_record($id,'category_id')
            ];
        return view('category.edit')->with($data);
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
            'category_name' => 'required',
            // 'category_price' => 'required',
           
        ]);
        if($this->SubCategory->deleteRecord($id,'category_id')){
            $dataArray['category_name']=$request->input('category_name');
            // $dataArray['comission']=$request->input('comission');
            $cat=$request->input('category_price');
            $result=$this->Category->updateWithId($dataArray,$id,'category_id');
             $category=array();
             if(!empty($cat)){
            foreach ($cat as $key => $value) {
                $category[]=array('category_id'=>$id,'subcategory_name'=>$value);
            } }
            $this->SubCategory->insert($category);
            return redirect('Category-List')->with('success', 'Category Updated successfully.');
        }else{
            $dataArray['category_name']=$request->input('category_name');
            // $dataArray['comission']=$request->input('comission');
            $cat=$request->input('category_price');
            $result=$this->Category->updateWithId($dataArray,$id,'category_id');
             $category=array();
             if(!empty($cat)){
            foreach ($cat as $key => $value) {
                $category[]=array('category_id'=>$id,'subcategory_name'=>$value);
            }
             }
            $this->SubCategory->insert($category);
            return redirect('Category-List')->with('success', 'Category Updated successfully.');
        } 
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

    public function getSubCategory(Request $request){
        $id=$request->input('category_id');
       
        $sub=$this->SubCategory->get_record($id,'category_id');
        return view('category.subcategory')->with(['sub'=>$sub]);
     


    }
}
