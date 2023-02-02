<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
     protected $table = 'states';
    
    protected $fillable = [
        'name','country_id','state_name'
    ];
    protected $primaryKey = 'id';
}
