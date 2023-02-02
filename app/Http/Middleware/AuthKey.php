<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       $token = request()->header('App-Key');
       if($token=='ABCDEFGHIJK'){
            return $next($request);
       }
       if(!empty($token)){
         $user = \App\UserModel::where('api_token', $token)->first();
         
        if(empty($user)){
            return response()->json(['message'=>'App Key Not Found'],401);
        }
        return $next($request);
       }else{
            return response()->json(['message'=>'App Key Not Found'],401);
       }
      
    
    }
}
