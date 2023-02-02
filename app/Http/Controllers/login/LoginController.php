<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use Auth;
use App\Http\Requests;
use App\UserModel;
class LoginControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        echo "hi";
    }

    public function login(Request $request)
    {
       
     
       $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
 
        if(!$request->input('username') && !$request->input('password')){
            $return = array('success'=>true,'msg'=>'validation errors');
            return redirect('/')->with('error','Username or Password required');
        }else{

                $data['UserName'] = $request->input('email');
                $data['Pwd'] = $request->input('password');
                

                $userData=UserModel::where($data)->get();
              
                 if(!empty($userData->UserID)){

                    $loggedIN['UserID'] = $userData->UserID;
                    $loggedIN['UserName'] = $userData->UserName;
                    
                    $request->session()->put('session_log',$loggedIN);
                    return redirect('/Dashboard');   

              }else{
                    return redirect('/Admin-Login')->with('error','Invalid Username or Password');
            }
    }
    }
}
?>