<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
     protected $table = 'request';

     protected $fillable = ['fname','lname','email','phone','service','city','state','status','zip_code','address','payment_method','how_many','property_type'];
   
}
