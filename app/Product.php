<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name','slug','price','price_old','feature_img_path','content','user_id','category_id','brand_id','status','list_img_product','topwatch','topsale','desc','num'];
}
