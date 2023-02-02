<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PackageModel extends Model
{
    protected $table = 'packages';

    protected $fillable = ['package_name','package_price','package_description','category_id','subcategory_id','addons_id','package_time'];

    static function deleteEntry($id,$tablename,$idname){
    	return DB::table($tablename)->where($idname,$id)->delete();
    }
    static function updateEntry($tablename,array $data,$id,$idname){
        return DB::table($tablename)->where($idname,$id)->update($data);
    }
}