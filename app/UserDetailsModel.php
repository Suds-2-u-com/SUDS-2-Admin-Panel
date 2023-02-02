<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetailsModel extends Model
{
    protected $table = 'user_details';

    protected $fillable = ['user_id','phone_number','preferred_method_of_contact','city','state','country','language','suds_account','company'];

    protected  $primaryKey = 'user_details_id';

}    