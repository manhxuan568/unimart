<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $fillable = ['name'];
    function districts(){
        return $this->hasMany(District::class,'province_id');
    }
}
