<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    //
    protected $guarded = [];
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
