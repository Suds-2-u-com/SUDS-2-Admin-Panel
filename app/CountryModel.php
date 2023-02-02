<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = 'countries';
    
    protected $fillable = [
        'sortname','name','phonecode'
    ];
    protected $primaryKey = 'id';
}
