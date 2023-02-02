<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankModel extends Model
{
    protected $table = 'bank';
    protected $fillable = ['user_id','bank_name','account_number','routing_number','bank_code','branch_code'];

 protected  $primaryKey = 'id';
  
}