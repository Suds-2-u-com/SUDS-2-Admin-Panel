<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PromotionsModel extends Model
{
    protected $table = 'promotions';

    protected $fillable = ['name','id','start_date','end_date','discount_amount','type'];

    
}