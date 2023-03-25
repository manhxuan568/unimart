<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TijsVerkoyen\CssToInlineStyles\Css\Property\Property;

class Menu extends Model
{
    //
   protected $fillable = ['name','slug','parent_id','position_num','status','user_id','link'];
   function user(){
    return $this->belongsTo(User::class,'user_id','id');
}
function menuChildren(){
    return $this->hasMany(Menu::class,'parent_id');
}
}
