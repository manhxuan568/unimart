<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['order_code','count_qty','fullname','status_order','email','phone','province_id','district_id','ward_id','address','note','info_order','order_total','payment_method'];
    function ward(){
        return $this->belongsTo(Ward::class,'ward_id','id');
    }
    function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }
    function province(){
        return $this->belongsTo(Province::class,'province_id','id');
    }
}
