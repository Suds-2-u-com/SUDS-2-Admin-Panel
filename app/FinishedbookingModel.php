<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishedbookingModel extends Model
{
   
     protected $table = 'finished_booking';
    
    protected $fillable = ['user_id','booking_id','image','comment','status','image1','image2','image3'];
 protected  $primaryKey = 'id';
 

}
