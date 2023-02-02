<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionsModel extends Model
{
     protected $table = 'payment';
      protected $fillable = ['status','	washer_amt','amount','request_coupan'];

       protected  $primaryKey = 'id';

}
