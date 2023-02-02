<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $fillable = ['name','email','image','mobile','status','role_as','password','remember_token','latitude','longitude','api_token','permission_settings'];

    protected  $primaryKey = 'id';

    static function getAllDetailsOfUser($id){
    	return self::join('user_details','user_details.user_id','=','users.id')->where('users.id',$id)->first();
    }

    static function getAllBankDetailsOfUser($id){
    	return self::join('bank','bank.user_id','=','users.id')->where('users.id',$id)->first();
    }

    static function getAllDocOfUser($id){
    	return self::join('user_document','user_document.user_id','=','users.id')->where('users.id',$id)->first();
    }

    static function getAllVehicleOfUser($id){
        return self::join('vehicle','vehicle.user_id','=','users.id')->where('users.id',$id)->get();
    }
}


?>