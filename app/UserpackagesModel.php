<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserpackagesModel extends Model
{
   
     protected $table = 'user_packages';
     
       protected $fillable = ['price','package_time','description','user_id','type'];
    
 protected  $primaryKey = 'id';
 

}
