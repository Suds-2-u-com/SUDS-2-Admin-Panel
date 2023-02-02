<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
     protected $table = 'vehicle';
     
    protected $fillable = ['user_id','category_id','make','year','model','engine','image'];

    protected  $primaryKey = 'vehicle_id';
   
}
