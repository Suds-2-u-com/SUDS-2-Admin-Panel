<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnSiteRequest extends Model
{
    protected $table = 'on_site_request';
    
    protected $fillable = [
           'first_name','last_name','email','phone_number','property_type','country','state','city','address','type_of_wash','how_many','payment_method','zip_code'
    ];
    protected $primaryKey = 'id';
}
