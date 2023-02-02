<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'setting';

    protected $fillable = ['distance_fee','distance_price'];
}
