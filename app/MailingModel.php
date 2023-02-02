<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailingModel extends Model
{
    protected $table = 'mailing';
    
    protected $fillable = [
           'name','email','city','mobile'
    ];
    protected $primaryKey = 'id';
}