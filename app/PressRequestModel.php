<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PressRequestModel extends Model
{
    protected $table = 'press_request';

    //protected $fillable = ['email','name','message'];
    protected $fillable = ['first_name','last_name','company_name','email','phone_number','city','state','status','zip_code','address','payment_method','how_many','property_type'];

    
}
