<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserdocModel extends Model
{
   
     protected $table = 'user_document';
     
       protected $fillable = ['user_id','license_number','license_classification','issued_on','expiry_date','term_condition','license_image'];
    
 protected  $primaryKey = 'doc_id';
 

}
