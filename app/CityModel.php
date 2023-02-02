<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
     protected $table = 'cities';
    
    protected $fillable = [
        'name','state_id', 'status'
    ];
    protected $primaryKey = 'id';
}
