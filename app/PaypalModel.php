<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class PaypalModel extends Model
{
    protected $table = 'paypal';
    
   protected $fillable = [
          'user_id','paypal_id'
    ];
    protected $primaryKey = 'id';

  
}