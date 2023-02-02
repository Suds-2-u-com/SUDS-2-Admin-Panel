<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use DB;
use App\Http\Requests;
use App\UserModel;
use Input;
use App\OnSiteRequest;
use Image;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $model;

     public function __construct(UserModel $UserModel)
    {
        $this->UserRepository=new UserRepository($UserModel);
    }


    public function index(){
   
       return view('login');
    }

    public function login(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required',
      // 'g-recaptcha-response' => 'required|captcha',
      'role_as'  => 'required',
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password'),
      'role_as' => $request->get('role_as')
     );
   
     if(Auth::attempt($user_data))
     {
      if($request->get('role_as')=='1'){
          return redirect('Dashboard');
      }else{
          return redirect('Profile');
      }
       
      //print_r(Auth::user()->email);
     }
     else
     {
      return redirect('Admin-Login')->with('error', 'Wrong Login Details');
     }
     
    
    }

    public function dashboard(){
      if(Auth::check()){
         
           return view('dashboard.index');
         
      }else{
        return redirect('/Admin-Login');
      }
      
    }

    public function logout(){
       Auth::logout();
       return redirect('/Admin-Login');
    }

    public function profile(){
      if(Auth::check())
      {
        $user=$this->UserRepository->show(Auth::id());
        return view('dashboard.profile')->with(['result'=>$user]);
      }else{
        return redirect('/Admin-Login');
      }
    }


    public function updateAccountSetting(Request $request,$id){

       $data = $request->except([
            '_token',
          ]);
     
      // $allRequest=$request->only($this->UserRepository->getModel()->fillable);
      // $this->UserRepository->find($id);
      if (Input::hasFile('image')){

       $file = Input::file('image');
       $name = $file->getClientOriginalName();


       $image = Image::make(Input::file('image')->getRealPath())->resize(200, 200);
       $image->save(public_path() . '/profile/' . $data['image']->getClientOriginalName());

       $data['image'] = $name;
      }
      

      $this->UserRepository->update($data,$id);
     
      return redirect('Profile');
      
     }

     public function changePassword(){
       $user=$this->UserRepository->show(Auth::id());
      return view('dashboard.changepassword')->with(['result'=>$user]);

     }


     public function ChangePasswordFrm(Request $request,$id){
         $this->validate($request, [
          'old_password'   => 'required',
          'password'  => 'required',
          'confirm_password'  => 'required',
         ]);
         $password=$request->input('password');
         $confirm_password=$request->input('confirm_password');
         $data = $request->all();
         if(!\Hash::check($data['old_password'], auth()->user()->password)){

             return back()->with('error','You have entered wrong password');

         }elseif($password!=$confirm_password){
           return redirect('Change-Password')->with('error', 'Passwords do not match');
         }else{
          $datas = $request->except([
            '_token',
            'old_password',
            'confirm_password'
          ]);
          $dataUpdate['password']=Hash::make($datas['password']);
          $this->UserRepository->update($dataUpdate,$id);
     
          return redirect('Change-Password');
        }
     }


   
}
?>