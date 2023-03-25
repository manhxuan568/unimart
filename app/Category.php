<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
   protected $fillable = ['cat_name','slug','parent_id','creator','status'];
   function categoreChiden(){
    return $this->hasMany(Category::class,'parent_id');
   }
}
