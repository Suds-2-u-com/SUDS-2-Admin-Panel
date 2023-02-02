<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PayOutTransactionsModel extends Model
{
    protected $table = 'transaction';
    
    
    
    protected $fillable = [
        'washer_id','amount'
    ];
    protected $primaryKey = 'id';

   
}