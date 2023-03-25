<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['title','thumb_post','slug','content','category_id','status','user_id'];
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    function category(){
        return $this->belongsTo(CategoryPost::class,'category_id','id');
    }
}
