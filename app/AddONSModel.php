<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddONSModel extends Model
{
    protected $table = 'add_ons';

    protected $fillable = ['add_ons_name','add_ons_price','package_id'];
}
