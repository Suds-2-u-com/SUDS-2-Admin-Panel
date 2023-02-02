<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class PayOutModel extends Model
{
    protected $table = 'payout';
    
   protected $fillable = [
          'bank_account','transaction_id','transaction_time','transaction_amount','transaction_date','user_id','payment_id'
    ];
    protected $primaryKey = 'id';

  
}