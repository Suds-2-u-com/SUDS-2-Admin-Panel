<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
   
     protected $table = 'booking';
      protected $fillable = ['user_id','washer_id','vehicle_id','booking_date','booking_time','package','extra_add_ons','wash_location','total','status','vehicle_type','length','width','hours','feet','type','wash_lat','wash_long','start_job_date'];
 protected  $primaryKey = 'booking_id';
 

}
