<?php

use App\Category;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','HomeController@index');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('home','HomeController@index')->name('home');
Route::group(['prefix' => 'laravel-filemanager',], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
//Client
Route::get('gioi-thieu.html','PageController@page1')->name('page');
Route::get('bai-viet.html', 'PostController@post');
Route::get('bai-viet/{slug}.html', 'PostController@postDetail')->name('postDetail');
Route::get('san-pham.html','ProductController@list');
Route::post('search','ProductController@search_ajax');
Route::get('search','ProductController@search_ajax');
Route::get('chi-tiet-san-pham/{slug}','ProductController@productDetail')->name('productDetail');
Route::get('san-pham.html/{slug?}','HomeController@productByCat')->name('productByCat');
//cart
Route::get('add', 'CartController@add')->name('addAjax');
Route::post('add', 'CartController@add')->name('addAjax');
Route::get('gio-hang', 'CartController@show');
Route::get('cart/remove/{rowId}','CartController@remove')->name('cart.remove');
Route::get('cart/removeall','CartController@removeAll');
Route::get('update-qty-ajax','CartController@updateQtyAjax')->name('updateQtyAjax');
Route::post('update-qty-ajax','CartController@updateQtyAjax')->name('updateQtyAjax');
Route::get('thanh-toan', 'CartController@checkout');
Route::get('district', 'CartController@districtAjax');
Route::post('district', 'CartController@districtAjax');
Route::get('wards', 'CartController@wardsAjax');
Route::post('wards', 'CartController@wardsAjax');
Route::post('add-order', 'CartController@add_order');
Route::get('buy-now/{id}', 'CartController@add_product_only')->name('buyNow');
Route::get('order-success',function(){
    $list_category = Category::all();
    return view('client.card.order_success',compact('list_category'));
});
Route::get('cv',function(){
   return view('client.cv');
});
Route::get('newspaper',function(){
   return view('client.project_cv.newspaper');
});
Route::get('project-fashion',function(){
   return view('client.project_cv.fashion');
});

//admin
Route::middleware('auth')->group(function(){
    Route::get('dashboard', 'DashboardController@show')->middleware('auth');
    Route::get('admin', 'DashboardController@show');

    Route::get('admin/user/list', 'AdminUserController@list')->middleware('can:list-user');
    Route::get('admin/user/add', 'AdminUserController@add')->middleware('can:add-user');
    Route::post('admin/user/store', 'AdminUserController@store');
    Route::post('admin/user/action', 'AdminUserController@action');
    Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->middleware('can:delete-user')->name('delete_user');
    Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->middleware('can:edit-user')->name('edit_user');
    Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('update_user');
    //menu
    Route::get('admin/menu/list', 'AdminMenuController@list')->middleware('can:list-menu');
    Route::get('admin/menu/add', 'AdminMenuController@add')->middleware('can:add-menu');
    Route::post('admin/menu/store', 'AdminMenuController@store');
    Route::get('admin/menu/delete/{id}', 'AdminMenuController@delete')->middleware('can:delete-menu')->name('delete_menu');
    Route::get('admin/menu/edit/{id}', 'AdminMenuController@edit')->middleware('can:edit-menu')->name('edit_menu');
    Route::post('admin/menu/update/{id}', 'AdminMenuController@update')->name('update_menu');

    //product
    Route::get('admin/product/list/{status?}', 'AdminProductController@list')->middleware('can:list-product')->name('get_status');
    Route::get('admin/product/add', 'AdminProductController@add')->middleware('can:add-product');
    Route::post('admin/product/store', 'AdminProductController@store');
    Route::post('admin/product/action', 'AdminProductController@action')->name('action');
    Route::get('admin/product/delete/{id}', 'AdminProductController@deleteProduct')->middleware('can:delete-product,id')->name('deleteProduct');
    Route::get('admin/product/edit/{id}', 'AdminProductController@editProduct')->middleware('can:edit-product,id')->name('editProduct');
    Route::post('admin/product/update/{id}', 'AdminProductController@updateProduct')->name('updateProduct');
    Route::get('admin/product/createThumnail', 'AdminProductController@createThumnail');
    Route::post('admin/product/createThumnail', 'AdminProductController@createThumnail')->name('createThumnail');
    Route::get('admin/product/deleteThumnail', 'AdminProductController@deleteThumnail');
    Route::post('admin/product/deleteThumnail', 'AdminProductController@deleteThumnail')->name('deleteThumnail');
    //cat-product
    Route::get('admin/product/cat/list', 'AdminProductController@listCat')->middleware('can:list-category-product');//middleware gate
    Route::post('admin/product/addcat', 'AdminProductController@addCat')->middleware('can:add-category-product');
    Route::get('admin/product/edit_cat/{id}', 'AdminProductController@edit_cat')->middleware('can:edit-category-product')->name('edit_cat');
    Route::post('admin/product/update_cat/{id}', 'AdminProductController@update_cat')->name('update_cat');
    Route::get('admin/product/delete_cat/{id}', 'AdminProductController@delete_cat')->middleware('can:delete-category-product')->name('delete_cat');
    //brand-product
    Route::get('admin/product/brand/list', 'AdminProductController@listBrand')->middleware('can:list-brand-product');
    Route::post('admin/product/brand/add', 'AdminProductController@addBrand')->middleware('can:add-brand-product');
    Route::get('admin/product/brand/edit_brand/{id}', 'AdminProductController@edit_brand')->middleware('can:edit-brand-product')->name('edit_brand');
    Route::get('admin/product/brand/delete_brand/{id}', 'AdminProductController@delete_brand')->middleware('can:delete-brand-product')->name('delete_brand');
    Route::post('admin/product/brand/update_brand/{id}', 'AdminProductController@update_brand')->name('update_brand');
    //role
    Route::get('admin/role/add', 'AdminRoleController@add')->middleware('can:add-role');
    Route::post('admin/role/store', 'AdminRoleController@store');
    Route::get('admin/role/list', 'AdminRoleController@list')->middleware('can:list-role');
    Route::get('admin/role/delete/{id}', 'AdminRoleController@delete')->middleware('can:delete-role')->name('delete_role');// chưa tạo
    Route::get('admin/role/edit/{id}', 'AdminRoleController@edit')->middleware('can:edit-role')->name('edit_role');
    Route::post('admin/role/update/{id}', 'AdminRoleController@update')->name('update_role');
    //Permission
    Route::get('admin/permission/create', 'AdminPermissionController@create')->middleware('can:add-permission');
    Route::get('admin/permission/list', 'AdminPermissionController@list')->middleware('can:list-permission');
    Route::get('admin/permission/edit/{id}', 'AdminPermissionController@edit')->middleware('can:edit-permission')->name('edit_permission');
    Route::get('admin/permission/delete/{id}', 'AdminPermissionController@delete')->middleware('can:delete-permission')->name('delete_permission');
    Route::post('admin/permission/store', 'AdminPermissionController@store');
    Route::post('admin/permission/update/{id}', 'AdminPermissionController@update')->name('update_permission');
    //slider
    Route::get('admin/slider/add', 'AdminSliderController@add')->middleware('can:add-slider');
    Route::post('admin/slider/store', 'AdminSliderController@store');
    Route::get('admin/slider/list', 'AdminSliderController@list')->middleware('can:list-slider');
    Route::get('admin/slider/delete/{id}', 'AdminSliderController@delete')->middleware('can:delete-slider')->name('delete_slider');
    Route::get('admin/slider/edit/{id}', 'AdminSliderController@edit')->middleware('can:edit-slider')->name('edit_slider');
    Route::post('admin/slider/update/{id}', 'AdminSliderController@update')->name('update_slider');
    //post
    Route::get('admin/post/add', 'AdminPostController@add')->middleware('can:add-post');
    Route::post('admin/post/store', 'AdminPostController@store');
    Route::get('admin/post/list/{status?}', 'AdminPostController@list')->middleware('can:list-post')->name('post_status');
    Route::get('admin/post/edit/{id}', 'AdminPostController@edit')->name('edit_post');
    Route::get('admin/post/delete/{id}', 'AdminPostController@delete')->middleware('can:delete-post')->name('delete_post');
    Route::post('admin/post/update/{id}', 'AdminPostController@update')->middleware('can:edit-post,id')->name('update_post');
    Route::post('admin/post/action', 'AdminPostController@action')->name('action_post');
    //categore pót
    Route::post('admin/post/cat/add', 'AdminPostController@addCat')->middleware('can:add-category-post');
    Route::get('admin/post/cat/list', 'AdminPostController@listCat')->middleware('can:list-category-post');
    Route::get('admin/post/cat/edit/{id}', 'AdminPostController@editCat')->middleware('can:edit-category-post')->name('edit_catPost');
    Route::get('admin/post/cat/delete/{id}', 'AdminPostController@deleteCat')->middleware('can:delete-category-post')->name('delete_catPost');
    Route::post('admin/post/cat/update/{id}', 'AdminPostController@updateCat')->name('update_catPost');
    //page
    Route::get('admin/page/add', 'AdminPageController@add')->middleware('can:add-page');
    Route::post('admin/page/store', 'AdminPageController@store');
    Route::get('admin/page/list/{status?}', 'AdminPageController@list')->middleware('can:list-page')->name('page_status');
    Route::get('admin/page/edit/{id}', 'AdminPageController@edit')->middleware('can:edit-page')->name('edit_page');
    Route::post('admin/page/update/{id}', 'AdminPageController@update')->name('update_page');
    Route::get('admin/page/delete/{id}', 'AdminPageController@delete')->middleware('can:delete-page')->name('delete_page');
    Route::post('admin/page/action', 'AdminPageController@action');
    //order
    Route::get('admin/order/detail/{id}', 'AdminOrderController@detail')->name('orderDetail');
    Route::post('admin/order/action-detail/{id}', 'AdminOrderController@actionDetail')->name('actionDetail');
    Route::get('admin/order/list/{status?}','AdminOrderController@list')->middleware('can:list-order')->name('list_oredr');
    Route::get('admin/order/edit/{id}', 'AdminOrderController@edit')->middleware('can:edit-order')->name('editOrder');
    Route::post('admin/order/update/{id}', 'AdminOrderController@update')->name('update_order');
    Route::get('admin/order/delete/{id}', 'AdminOrderController@delete')->middleware('can:delete-order')->name('deleteOrder');
    Route::post('admin/order/action', 'AdminOrderController@action');

});

Auth::routes();


