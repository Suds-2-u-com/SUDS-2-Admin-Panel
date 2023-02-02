<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppRequestModel extends Model
{
    protected $table = 'app_request';

    protected $fillable = ['mobile'];
}
