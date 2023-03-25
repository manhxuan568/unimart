<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    function wards(){
        return $this->hasMany(Ward::class,'district_id');
    }
}
