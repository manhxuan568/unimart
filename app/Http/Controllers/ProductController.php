<?php

namespace App\Http\Controllers;

use App\BrandProduct;
use App\Category;
use App\Product;
use App\Menu;
use Illuminate\Http\Request;
use Psy\Command\WhereamiCommand;

class ProductController extends Controller
{
    //kỉ niệm 2 điều kiện=====
    // if(500000 < $request->price){
    //     $a = 500000;
    //     $b = 1000000;
    //     $products = Product::where('status','=','1')
    //     ->where(function($query) use ($a){
    //      $query->orWhere('discount', '>=',$a)
    //       ->orWhere('price','>=',$a);
    //      })
    //     ->where(function($query) use ($b){
    //      $query->orWhere('discount', '<=',$b)
    //       ->orWhere('price','<=',$b);
    //      })
         
    //     ->paginate(20);
    //    }=============
    public function list(Request $request){
        //  
                
            $filter_paginate = [];           
            $keyWord = '';
            if($request->key_word){
                 $keyWord = $request->key_word;
             }
           $products = Product::where('status','1')->where('name','LIKE',"%$keyWord%")->paginate(12);
 
        //search vs sort
        if($request->key_word && $request->sort){
            $keyWord = $request->key_word;
            $labelSort = '';
            $sort = '';
            if($request->sort == 'az'){
                $labelSort = 'name'; $sort = 'asc';
            }
            if($request->sort == 'za'){
                $labelSort = 'name'; $sort = 'desc';
            }
            if($request->sort == 'hs'){
                $labelSort = 'price'; $sort = 'desc';
            }
            if($request->sort == 'sh'){
                $labelSort = 'price'; $sort = 'asc';
            }
            $products = Product::where('status','1')->where('name','LIKE',"%$keyWord%")->orderBy($labelSort,$sort)->paginate(12);
        }
        //price vs brand vs sort
        if($request->price && $request->brand && $request->sort){  
            $id = $request->brand;
            $labelSort = '';
            $sort = '';
            if($request->sort == 'az'){
                $labelSort = 'name'; $sort = 'asc';
            }
            if($request->sort == 'za'){
                $labelSort = 'name'; $sort = 'desc';
            }
            if($request->sort == 'hs'){
                $labelSort = 'price'; $sort = 'desc';
            }
            if($request->sort == 'sh'){
                $labelSort = 'price'; $sort = 'asc';
            }
            //Dưới 500000
            if($request->price == 500000){
                $products = Product::where('status','=','1')->where('price','<',500000)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);                              
            }
            //500000-1000000
             if(1000000 == $request->price){
            $a = 500000;
            $b = 1000000;
            $products = Product::where('status','=','1')->where('price','>=',$a)->where('price','<=',$b)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
            }
             //1000000-5000000
            if(5000000 == $request->price){
            $a = 1000000;
            $b = 5000000;
            $products = Product::where('status','=','1')->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
            
            }
            //5000000-10000000
            if(10000000 == $request->price){
            $a = 5000000;
            $b = 10000000;
            $products = Product::where('status','=','1')->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
            }
            //Trên 10000000
            if(10000001 == $request->price){
                $products = Product::where('status','=','1')->where('price','>',10000000)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
            }
            $filter_paginate['price'] = $request->price;
            $filter_paginate['brand'] = $request->brand;
            $filter_paginate['sort'] = $request->sort;

        } 
        //price
        if($request->price && !$request->brand && !$request->sort){
            //Dưới 500000
            if($request->price == 500000){
                $products = Product::where('status','=','1')->where('price','<',500000)->paginate(20);                              
            }
            //500000-1000000
           if(1000000 == $request->price){
            $a = 500000;
            $b = 1000000;
            $products = Product::where('status','=','1')->where('price','>',$a)->where('price','<',$b)->paginate(20);
           }
           //1000000-5000000
           if(5000000 == $request->price){
            $a = 1000000;
            $b = 5000000;
            $products = Product::where('status','=','1')->Where('price','>',$a)->Where('price','<',$b)->paginate(20);
            
           }
           //5000000-10000000
           if(10000000 == $request->price){
            $a = 5000000;
            $b = 10000000;
            $products = Product::where('status','=','1')->Where('price','>=',$a)->Where('price','<=',$b)->paginate(20);
            }
            //Trên 10000000
            if(10000001 == $request->price){
                $products = Product::where('status','=','1')->where('price','>=',10000000)->paginate(12);
            }
            $filter_paginate['price'] = $request->price;
        }
        //brand vs sort
        if(!$request->price && $request->brand && $request->sort){
            $id = $request->brand;
            if($request->sort == 'az'){
                $products = Product::where('status','=','1')->where('brand_id',$id)->orderby('name','asc')->paginate(20); 
             }
             if($request->sort == 'za'){
                $products = Product::where('status','=','1')->where('brand_id',$id)->orderby('name','desc')->paginate(20); 
             }
             if($request->sort == 'hs'){              
                $products = Product::where('status','=','1')->where('brand_id',$id)->orderBy('price','desc')->paginate(20); 
             }
             if($request->sort == 'sh'){
                $products = Product::where('status','=','1')->where('brand_id',$id)->orderBy('price','asc')->paginate(20); 
             } 
             $filter_paginate['brand'] = $request->brand;
            $filter_paginate['sort'] = $request->sort;           
        }
        // brand
        if($request->brand && !$request->price && !$request->sort){
            $id = $request->brand;
            $products = Product::where('status','=','1')->where('brand_id',$id)->paginate(20); 
            $filter_paginate['brand'] = $request->brand;
        }
        //price vs sort
        if(!$request->brand && $request->price && $request->sort){
            $labelSort = '';
            $sort = '';
            if($request->sort == 'az'){
                $labelSort = 'name'; $sort = 'asc';
            }
            if($request->sort == 'za'){
                $labelSort = 'name'; $sort = 'desc';
            }
            if($request->sort == 'hs'){
                $labelSort = 'price'; $sort = 'desc';
            }
            if($request->sort == 'sh'){
                $labelSort = 'price'; $sort = 'asc';
            }
            //Dưới 500000
            if(($request->price == 500000) && $request->sort){
                $products = Product::where('status','=','1')->where('price','<',500000)->orderBy($labelSort,$sort)->paginate(20);                              
            }
            //500000-1000000
           if((1000000 == $request->price) && $request->sort){
            $a = 500000;
            $b = 1000000;
            $products = Product::where('status','=','1')->where('price','>=',$a)->where('price','<=',$b)->orderBy($labelSort,$sort)->paginate(20);
           }
           //1000000-5000000
           if((5000000 == $request->price) && $request->sort){
            $a = 1000000;
            $b = 5000000;
            $products = Product::where('status','=','1')->Where('price','>=',$a)->Where('price','<=',$b)->orderBy($labelSort,$sort)->paginate(20);
            
           }
           //5000000-10000000
           if((10000000 == $request->price) && $request->sort){
            $a = 5000000;
            $b = 10000000;
            $products = Product::where('status','=','1')->Where('price','>=',$a)->Where('price','<=',$b)->orderBy($labelSort,$sort)->paginate(20);
            }
            //Trên 10000000
            if((10000001 == $request->price) && $request->sort){
             
                $products = Product::where('status','=','1')->where('price','>',10000000)->orderBy($labelSort,$sort)->paginate(20);
            }
            $filter_paginate['price'] = $request->price;
            $filter_paginate['sort'] = $request->sort;    
        }
        //sort
        if(!$request->price && !$request->brand && $request->sort && !$request->key_word){
             if($request->sort == 'az'){
                $products = Product::where('status','=','1')->orderby('name','asc')->paginate(20); 
             }
             if($request->sort == 'za'){
                $products = Product::where('status','=','1')->orderby('name','desc')->paginate(20); 
             }
             if($request->sort == 'hs'){              
                $products = Product::where('status','=','1')->orderBy('price','desc')->paginate(20); 
             }
             if($request->sort == 'sh'){
                $products = Product::where('status','=','1')->orderBy('price','asc')->paginate(20); 
             }
             $filter_paginate['sort'] = $request->sort;   
        }
        //price vs brand
        if($request->price && $request->brand && !$request->sort){
            $id = $request->brand;
            //Dưới 500000
            if($request->price == 500000 && $request->brand){
                $products = Product::where('status','=','1')->where('price','<',500000)->where('brand_id',$id)->paginate(20);                              
            }
            //500000-1000000
           if(1000000 == $request->price && $request->brand){
            $a = 500000;
            $b = 1000000;
            $products = Product::where('status','=','1')->where('price','>=',$a)->where('price','<=',$b)->where('brand_id',$id)->paginate(20);
           }
           //1000000-5000000
           if(5000000 == $request->price && $request->brand){
            $a = 1000000;
            $b = 5000000;
            $products = Product::where('status','=','1')->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->paginate(20);
            
           }
           //5000000-10000000
           if(10000000 == $request->price && $request->brand){
            $a = 5000000;
            $b = 10000000;
            $products = Product::where('status','=','1')->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->paginate(20);
            }
            //Trên 10000000
            if(10000001 == $request->price && $request->brand){
                $products = Product::where('status','=','1')->where('price','>',10000000)->where('brand_id',$id)->paginate(20);
            }
            $filter_paginate['price'] = $request->price;
            $filter_paginate['brand'] = $request->brand;
        }   
        
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        $list_brand = BrandProduct::all();
        $count_all_product = Product::where('status','=','1')->count();
        $list_category = Category::all();
        return view('client.product.list',compact('products','list_brand','menus','count_all_product','filter_paginate','list_category'));
    }

    public function search_ajax(Request $request){
        if(strlen($request->keyword) >= 1){
            $key_word = $request->keyword;
              $list_product_ajax = Product::where('status','=','1')->where('name','LIKE',"%$key_word%")->get();     
            return view('client.search_product_ajax',compact('list_product_ajax'));
        }
    }
    public function productDetail(Request $request){
        $productTopSale = Product::where('topsale','=','topSale','and')->where('status','=','1')->get();
        $item = Product::where('slug',$request->slug)->first();
        $list_category = Category::all();
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get(); 
        return view('client.product.detail',compact('menus','item','productTopSale','list_category'));
    }
}
