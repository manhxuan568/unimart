<?php

namespace App\Http\Controllers;

use App\BrandProduct;
use App\Category;
use App\Menu;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function index(){
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get(); 
        $productTopSale = Product::where('topsale','=','topSale')->where('status','=','1')->get();
        $productTopWatch = Product::where('topwatch','=','topWatch')->where('status','=','1')->get();
        $sliders = Slider::where('status','=','1')->get();
        $list_Phone = Product::where('status','=','1')->where(function ($query){
            $query->where('category_id',2)->orWhere('category_id',3)->orWhere('category_id',4);
        })->get();
        $list_laptop = Product::where('status','=','1')->where('category_id',13)->get();
        $list_category = Category::all();
        return view("client.home",compact('menus','sliders','productTopSale','productTopWatch','list_Phone','list_laptop','list_category'));
    }

    public function productByCat(Request $request){
        $keyWord = '';
        $filter_paginate=[];
        //Tạo mảng và lấy id các bản ghi sau mỗi vòng lặp
        $data = [];
        $categoryParent = Category::where('slug',$request->slug)->first();
        $data[] = $categoryParent->id;
        $categoryParent->categoreChiden;
        foreach($categoryParent->categoreChiden as $item){
            $data[] = $item['id'];
            if(count($item->categoreChiden)>0){
                foreach($item->categoreChiden as $itemChi){
                    $data[] = $itemChi['id'];
                }
            }
        }
        if($request->key_word){
            $keyWord = $request->key_word;  
        }
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('name','LIKE',"%$keyWord%")->paginate(12);
        //price===**
        if($request->slug && $request->price && !$request->brand && !$request->sort){
            //Dưới 500000
            if($request->price == 500000){
                $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','<',500000)->paginate(20);                              
            }
            //500000-1000000
           if(1000000 == $request->price){
            $a = 500000;
            $b = 1000000;
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>',$a)->where('price','<',$b)->paginate(20);
           }
           //1000000-5000000
           if(5000000 == $request->price){
            $a = 1000000;
            $b = 5000000;
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>',$a)->Where('price','<',$b)->paginate(20);
            
           }
           //5000000-10000000
           if(10000000 == $request->price){
            $a = 5000000;
            $b = 10000000;
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>=',$a)->Where('price','<=',$b)->paginate(20);
            }
            //Trên 10000000
            if(10000001 == $request->price){
                $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>=',10000000)->paginate(12);
            }
            $filter_paginate['price'] = $request->price;
        }
        // brand
        if($request->slug && $request->brand && !$request->price && !$request->sort){
            $id = $request->brand;
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('brand_id',$id)->paginate(20); 
            $filter_paginate['brand'] = $request->brand;
        }
        //sort
        if($request->slug && !$request->price && !$request->brand && $request->sort && !$request->key_word){
            if($request->sort == 'az'){
               $products = Product::where('status','=','1')->whereIn('category_id',$data)->orderby('name','asc')->paginate(20); 
            }
            if($request->sort == 'za'){
               $products = Product::where('status','=','1')->whereIn('category_id',$data)->orderby('name','desc')->paginate(20); 
            }
            if($request->sort == 'hs'){              
               $products = Product::where('status','=','1')->whereIn('category_id',$data)->orderBy('price','desc')->paginate(20); 
            }
            if($request->sort == 'sh'){
               $products = Product::where('status','=','1')->whereIn('category_id',$data)->orderBy('price','asc')->paginate(20); 
            }
            $filter_paginate['sort'] = $request->sort;   
       }
       //price vs brand
       if($request->slug && $request->price && $request->brand && !$request->sort){
        $id = $request->brand;
        //Dưới 500000
        if($request->price == 500000 && $request->brand){
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','<',500000)->where('brand_id',$id)->paginate(20);                              
        }
        //500000-1000000
       if(1000000 == $request->price && $request->brand){
        $a = 500000;
        $b = 1000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>=',$a)->where('price','<=',$b)->where('brand_id',$id)->paginate(20);
       }
       //1000000-5000000
       if(5000000 == $request->price && $request->brand){
        $a = 1000000;
        $b = 5000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->paginate(20);
        
       }
       //5000000-10000000
       if(10000000 == $request->price && $request->brand){
        $a = 5000000;
        $b = 10000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->paginate(20);
        }
        //Trên 10000000
        if(10000001 == $request->price && $request->brand){
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>',10000000)->where('brand_id',$id)->paginate(20);
        }
        $filter_paginate['price'] = $request->price;
        $filter_paginate['brand'] = $request->brand;
    }
    //price vs sort
    if($request->slug && $request->price && $request->sort && !$request->brand){
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
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','<',500000)->orderBy($labelSort,$sort)->paginate(20);                              
        }
        //500000-1000000
       if((1000000 == $request->price) && $request->sort){
        $a = 500000;
        $b = 1000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>=',$a)->where('price','<=',$b)->orderBy($labelSort,$sort)->paginate(20);
       }
       //1000000-5000000
       if((5000000 == $request->price) && $request->sort){
        $a = 1000000;
        $b = 5000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>=',$a)->Where('price','<=',$b)->orderBy($labelSort,$sort)->paginate(20);
        
       }
       //5000000-10000000
       if((10000000 == $request->price) && $request->sort){
        $a = 5000000;
        $b = 10000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>=',$a)->Where('price','<=',$b)->orderBy($labelSort,$sort)->paginate(20);
        }
        //Trên 10000000
        if((10000001 == $request->price) && $request->sort){
         
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>',10000000)->orderBy($labelSort,$sort)->paginate(20);
        }
        $filter_paginate['price'] = $request->price;
        $filter_paginate['sort'] = $request->sort;    
    } 
    //brand vs sort
    if(!$request->price && $request->slug && $request->brand && $request->sort){
        $id = $request->brand;
        if($request->sort == 'az'){
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('brand_id',$id)->orderby('name','asc')->paginate(20); 
         }
         if($request->sort == 'za'){
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('brand_id',$id)->orderby('name','desc')->paginate(20); 
         }
         if($request->sort == 'hs'){              
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('brand_id',$id)->orderBy('price','desc')->paginate(20); 
         }
         if($request->sort == 'sh'){
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('brand_id',$id)->orderBy('price','asc')->paginate(20); 
         } 
         $filter_paginate['brand'] = $request->brand;
        $filter_paginate['sort'] = $request->sort;           
    }
    //price vs brand vs sort
    if($request->slug && $request->price && $request->brand && $request->sort){  
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
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','<',500000)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);                              
        }
        //500000-1000000
         if(1000000 == $request->price){
        $a = 500000;
        $b = 1000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>=',$a)->where('price','<=',$b)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
        }
         //1000000-5000000
        if(5000000 == $request->price){
        $a = 1000000;
        $b = 5000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
        
        }
        //5000000-10000000
        if(10000000 == $request->price){
        $a = 5000000;
        $b = 10000000;
        $products = Product::where('status','=','1')->whereIn('category_id',$data)->Where('price','>=',$a)->Where('price','<=',$b)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
        }
        //Trên 10000000
        if(10000001 == $request->price){
            $products = Product::where('status','=','1')->whereIn('category_id',$data)->where('price','>',10000000)->where('brand_id',$id)->orderBy($labelSort,$sort)->paginate(20);
        }
        $filter_paginate['price'] = $request->price;
        $filter_paginate['brand'] = $request->brand;
        $filter_paginate['sort'] = $request->sort;

    }

        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        $list_brand = BrandProduct::all();
        $count_all_product = Product::where('status','=','1')->count();
        $list_category = Category::all();
        
        return view('client.product.list',compact('products','list_brand','menus','count_all_product','list_category','filter_paginate'));
    }
}
