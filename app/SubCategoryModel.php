<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    
    protected $table = 'subcategory';
    
    protected $fillable = [
        'category_id','subcategory_name'
    ];
}
