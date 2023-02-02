<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardModel extends Model
{
    protected $table = 'payment_card';
    protected $fillable = ['user_id','card_number','holder_name','expiry_year','cvv_no','paypal_id','card_id','lat','longi','expiry_month','brand','postalcode'];

 protected  $primaryKey = 'id';
  
}