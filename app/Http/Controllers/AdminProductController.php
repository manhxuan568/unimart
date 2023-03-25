<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use LengthException;

use function GuzzleHttp\Promise\all;
use App\BrandProduct;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminProductController extends Controller
{
    //
    function __construct()
    {
      $this->middleware(function ($request, $next){
          session(['module_active'=>'product']);
          return $next($request);
      });
  }

public function add(){
    $list_brand = BrandProduct::all();
    $list_cat = Category::all();
    $list_cat = data_tree($list_cat,0,0);
    return view('admin.product.add', compact('list_brand','list_cat'));
}
public function store(Request $request){
     $request->validate(
        [
            'name'=>'required',
            'slug'=>'required',
            'price'=>'required',
            'avtar'=>'required|mimes:png,jpg,jpeg|max:2048',
            'file.*'=>'mimes:png,jpg,jpeg|max:2048',
            'content'=>'required',
            'desc'=>'required',
            'cat_id'=>'required',
        ],[
            'required'=>':attribute không được để trống trường này.',
            'mimes' => ':attribute phải có đuôi png, jpg, jpeg',
            'max'=> ':attribute kích thước ảnh không quá 2048'
        ],[
            'name'=>'Tiêu đề sản phẩm',
            'slug'=>'Link slug',
            'price'=>'Giá sản phẩm',
            'avtar'=>'Ảnh đại điện',
            'file'=>'File ảnh',
            'content'=>'Chi tiết sản phẩm',
            'cat_id'=>'Danh mục sản phẩm',
            'desc'=>'Mô tả sản phẩm'
        ]
    );
     $topWatch ='';
    $topSale ='';
    $thumbnail='';
    $list_thumb ='';
    if(session('files')){
        $list_thumb = json_encode(session('files'));
    }
    if(!empty($request->input('productTop'))){
         foreach($request->input('productTop') as $v){
            if($v == 'topWatch'){$topWatch = $v;}
            if($v == 'topSale'){$topSale = $v;}
         }
    }
    if($request->hasFile('avtar')){
        $file= $request->avtar;
        $filename = $request->avtar->getClientOriginalName();
        $thumbnail = 'public/uploads/'.$filename;
        $file->move('public/uploads', $file->getClientOriginalName());
    }
    // json_decode()
    // json_encode()
    Product::create([
        'name'=>$request->input('name'),
        'slug'=>$request->input('slug'),
        'price'=>$request->input('price'),
        'feature_img_path'=>$thumbnail,
        'content'=>$request->input('content'),
        'user_id'=> Auth::id(),
        'category_id'=>$request->input('cat_id'),
        'brand_id'=>$request->input('brand_id'),
        'status'=>$request->input('status'),
        'list_img_product'=>$list_thumb,
        'topwatch'=>$topWatch,
        'topsale'=>$topSale,
        'desc'=>$request->input('desc'),
        'num'=>$request->input('num'),
    ]);
    return redirect('admin/product/list')->with('status','Thêm danh sản phẩm mới thành công.'); 
}

public function list(Request $request,$status=null){
    $list_act = ['pending' => 'Chờ duyệt', 'public' => 'Công khai', 'delete' => 'Cho vào thùng rác'];
    if(empty($status)){
        $keyWord = '';
        if($request->input('keyWord')){
           $keyWord = $request->input('keyWord');
        }
        $list_product = Product::join('categories','categories.id','=','products.category_id')->select('categories.cat_name','products.*')->where('name','LIKE',"%$keyWord%")->orderby('id','asc')
        ->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'page'
        );
    }else{
        //publish
        if($status=='publish'){
           $list_act = ['pending' => 'Chờ duyệt','topSale'=>'Bán chạy','topWatch'=>'Nổi bật','delete'=>'cho vào thùng rác'];
           $list_product = Product::join('categories','categories.id','=','products.category_id')->select('categories.cat_name','products.*')->where('products.status','1')->paginate(10);
        }
        //pending
        if($status=='pending'){
            $list_act = ['publish' => 'Công khai','delete'=>'cho vào thùng rác'];
            $list_product = Product::join('categories','categories.id','=','products.category_id')->select('categories.cat_name','products.*')->where('products.status','0')->paginate(10);
         }
        //trash
        if($status=='trash'){
            $list_act = ['restore' => 'Khôi phục','forceDelete'=>'Xóa vĩnh viễn'];
            $list_product = Product::join('categories','categories.id','=','products.category_id')->select('categories.cat_name','products.*')->onlyTrashed()->paginate(10);
         }
         //topSale
         if($status=='topSale'){
            $list_act = ['publish' => 'Công khai','pending' => 'Chờ duyệt','cancel_topSale'=>'Hủy trạng thái bán chạy','forceDelete'=>'Xóa vĩnh viễn'];
            $list_product = Product::join('categories','categories.id','=','products.category_id')->select('categories.cat_name','products.*')->where('topsale','topSale')->paginate(10);
         }
         //topWatch
         if($status=='topWatch'){
            $list_act = ['publish' => 'Công khai','pending' => 'Chờ duyệt','cancel_topWatch'=>'Hủy trạng thái nổi bật','forceDelete'=>'Xóa vĩnh viễn'];
            $list_product = Product::join('categories','categories.id','=','products.category_id')->select('categories.cat_name','products.*')->where('topwatch','topWatch')->paginate(10);
         }
    }
    $count_publish = Product::where('status','1')->count();
    $count_pending = Product::where('status','0')->count();
    $count_trash = Product::onlyTrashed()->count();
    $count_topWatch = Product::where('topwatch','topWatch')->count();
    $count_topSale = Product::where('topsale','topSale')->count();
    //  if(Gate::allows('is-admin')){
        return view('admin.product.list', compact(['list_product','list_act','count_publish','count_pending','count_trash','count_topWatch','count_topSale']));
    //  }else{
    //     abort(403);
    //  }
}

//action
function action(Request $request){

    $list_check = $request->input('list_check');
    if($list_check){
        if($request->input('act')){
            $act = $request->input('act');
        }else{
            return redirect('admin/product/list')->with('alert', 'Bạn chưa chọn tác vụ để thực hiện.');  
        }
        if($act == 'pending'){
            Product::whereIn('id', $list_check)->update(['status' => '0']);
            return redirect('admin/product/list')->with('status', 'Cập nhật thành công.');
        }
        if($act == 'publish'){
            Product::whereIn('id', $list_check)->update(['status' => '1']);
            return redirect('admin/product/list')->with('status', 'Cập nhật thành công.');
        }
        if($act == 'delete'){
            // Product::whereIn('id', $list_check);
            Product::destroy($list_check);
            return redirect('admin/product/list')->with('status', 'Đã chuyển những bản ghi trên vào thùng rác.');
        }
        if($act == 'restore'){
            Product::onlyTrashed()->whereIn('id', $list_check)->restore();
            return redirect('admin/product/list')->with('status', 'Khôi phục thành công.');
        }
        if($act == 'forceDelete'){
            Product::onlyTrashed()->whereIn('id', $list_check)->forceDelete();
            return redirect('admin/product/list')->with('status', 'Xóa vĩnh viễn thành công.');
        }
        if($act == 'cancel_topWatch'){
            Product::whereIn('id',$list_check)->update(['topwatch'=>'']);
            return redirect('admin/product/list')->with('status', 'Hủy trạng thái thành công.');
        }
        if($act == 'cancel_topSale'){
            Product::whereIn('id',$list_check)->update(['topsale'=>'']);
            return redirect('admin/product/list')->with('status', 'Hủy trạng thái thành công.');
        }
        if($act == 'topWatch'){
            Product::whereIn('id',$list_check)->update(['topwatch'=>'topWatch']);
            return redirect('admin/product/list')->with('status', 'Cập nhật trạng thái thành công.');
        }
        if($act == 'topSale'){
            Product::whereIn('id',$list_check)->update(['topsale'=>'topSale']);
            return redirect('admin/product/list')->with('status', 'Cập nhật trạng thái thành công.');
        }
    }else{
        return redirect('admin/product/list')->with('alert-check', 'Bạn chưa chọn phần tử nào để thực hiện.');
    }
}
public function deleteProduct($id){
    $product = Product::find($id);
    if($product === null){
        $product = Product::onlyTrashed()->find($id);
        $product->forceDelete();
        return redirect('admin/product/list')->with('status','Xóa vĩnh viễn sản phẩm thành công.');
     }
     $product->delete();
    return redirect('admin/product/list')->with('status','Đã chuyển sản phẩm vào thùng rác.');
}
public function editProduct($id){
    $list_cat = Category::all();
    $list_cat = data_tree($list_cat,0,0);
    $list_brand = BrandProduct::all();
    $product = Product::find($id);
    if($product === null){
        $product = Product::onlyTrashed()->find($id);
     }
    return view('admin.product.edit',compact('product','list_cat','list_brand'));
}
public function updateProduct(Request $request,$id){
    $topWatch ='';
    $topSale ='';
    $thumbnail='';
    // $list_thumb ='';
    // if(session('files')){
    //     $list_thumb = json_encode(session('files'));
    // }
    $data = [
        'name'=>$request->input('name'),
        'slug'=>$request->input('slug'),
        'price'=>$request->input('price'),
        'price_old'=>$request->input('price_old'),
        'content'=>$request->input('content'),
        'user_id'=> Auth::id(),
        'category_id'=>$request->input('cat_id'),
        'brand_id'=>$request->input('brand_id'),
        'status'=>$request->input('status'),
        // 'list_img_product'=>$list_thumb,
        // 'topsale'=>$topSale,
        'desc'=>$request->input('desc'),
        'num'=>$request->input('num'),
    ];
    if($request->input('productTop')){
         foreach($request->input('productTop') as $v){
            if($v == 'topWatch'){
                $topWatch = $v;
                $data['topwatch']=$topWatch;
            }else{$data['topwatch']='';}
         }
         foreach($request->input('productTop') as $v){
            if($v == 'topSale'){
                $topSale = $v;
                $data['topsale']=$topSale;
            }else{$data['topsale']='';}
         }

    }
    
    if($request->hasFile('avtar')){
        $file= $request->avtar;
        $filename = $request->avtar->getClientOriginalName();
        $thumbnail = 'public/uploads/'.$filename;
        $data['feature_img_path']=$thumbnail;
        $file->move('public/uploads', $file->getClientOriginalName());
    }
    $product = Product::find($id);
    if($product === null){
        $product = Product::onlyTrashed()->find($id);
     }
   $product->update($data);
   return redirect('admin/product/list')->with('status','Cập nhật sản phẩm thành công.');
}
public function createThumnail(Request $request){
 
    if($request->hasFile('file')){
        $request->validate([
            'file.*' => 'required|mimes:png,jpg,jpeg|max:2048'
        ],[
            'required'=> ':attribute chưa có file.',
            'mimes' => ':attribute phải có đuôi png, jpg, jpeg',
            'max'=> ':attribute kích thước ảnh không quá 2048'
        ],[
            'file'=> 'File'
        ]
    );
    $array = session()->get('files');
    foreach($request->file as $k){
        $id = rand(1,9999);
        $_file = [
         'id'=> $id,
         'name'=> 'public/uploads/'.$k->getClientOriginalName(),
        ];
        
        $k->move(public_path('uploads'), $k->getClientOriginalName()); 
        $array[$id] = $_file; 
        session()->put('files',$array); 
    }
    

    }
    // $list_files = session('files');
    // return view('admin.product.list_thumbnail_ajax',compact('list_files'));
            //  echo '<pre>';
            //  print_r(session('files'));
            // echo '<pre>';
    
   
} 
//delete thumnail
public function deleteThumnail(Request $request){
     $id = $request->id_thumb_delete;  
    //  dd($id);
    if(!empty($id)){
    $list_files = session('files');
    if($list_files[$id]['id'] == $id){
       unset($list_files[$id]);
       $data2 = session()->put('files',$list_files);
    }   
    //   $request->session()->forget($list_files[$id]);
    }
    return $data2;

}
// cat
public function addCat(Request $request){
   $request->validate(
    [
        'name'=> 'required|min:4|max:60'
    ],
    [
        'required'=> ':attribute không được để trống!',
        'min'=>':attribute phải có :min kí tự trở lên',
        'max'=>':attribute phải có số kí tự không quá :max kí tự.',
    ],['name'=>'Danh mục cha']
   );
    Category::create([
        'cat_name' => $request->input('name'),
        'slug'=> $request->input('slug'),
        'parent_id' => $request->input('parent_id'),
        'creator' => Auth::user()->name,
        'status'=> $request->input('status')
    ]);
    return redirect('admin/product/cat/list')->with('status','Thêm danh mục mới thành công.');
}
public function listCat(){
    $list_cat = Category::all();
    $list_cat = data_tree($list_cat,0,0);
    return view('admin.product.listCat',compact('list_cat'));
}
public function edit_cat($id){
    $cat = Category::find($id);
    return view('admin.product.edit_cat',compact('cat')); 
}
public function update_cat(Request $request,$id){
    $request->validate(
        [
            'name'=> 'required|min:4|max:60'
        ],
        [
            'required'=> ':attribute không được để trống!',
            'min'=>':attribute phải có :min kí tự trở lên',
            'max'=>':attribute phải có số kí tự không quá :max kí tự.',
        ],['name'=>'Danh mục cha']
       );
       Category::where('id',$id)->update([
        'cat_name'=> $request->input('name'),
        'slug'=> $request->input('slug'),
        'creator' => Auth::user()->name,
        'status'=> $request->input('status')
       ]);
       return redirect('admin/product/cat/list')->with('update','Cập nhật danh mục thành công.');  
}
public function delete_cat($id){
   Category::where('id',$id)->delete();
   return redirect('admin/product/cat/list')->with('delete','Xóa danh mục thành công.');
}
// brand
public function listBrand(){
    $list_brand = BrandProduct::all();
    return view('admin.product.listBrand', compact('list_brand'));
}
public function addBrand(Request $request){
    $request->validate(
        [
            'name'=> 'required|min:2|max:60'
        ],
        [
            'required'=> ':attribute không được để trống!',
            'min'=>':attribute phải có :min kí tự trở lên',
            'max'=>':attribute phải có số kí tự không quá :max kí tự.',
        ],['name'=>'Danh mục cha']
       );
       BrandProduct::create([
        'name'=> $request->input('name'),
        'slug'=> $request->input('slug'),
        'creator'=> Auth::user()->name,
       ]);
       return redirect('admin/product/brand/list')->with('status','Thêm hãng mới thành công.');  
}
public function delete_brand($id){
    BrandProduct::where('id',$id)->delete();
    return redirect('admin/product/brand/list')->with('delete','Xóa hãng thành công.');
 }
 public function edit_brand($id){
    $item = BrandProduct::find($id);
    return view('admin.product.edit_brand',compact('item')); 
} 
public function update_brand(Request $request,$id){
    $request->validate(
        [
            'name'=> 'required|min:2|max:60'
        ],
        [
            'required'=> ':attribute không được để trống!',
            'min'=>':attribute phải có :min kí tự trở lên',
            'max'=>':attribute phải có số kí tự không quá :max kí tự.',
        ],['name'=>'Danh mục cha']
       );
       BrandProduct::where('id',$id)->update([
        'name'=> $request->input('name'),
        'slug'=> $request->input('slug'),
        'creator'=> Auth::user()->name,
       ]);
       return redirect('admin/product/brand/list')->with('update','Cập nhật hãng thành công.');  
}
}
