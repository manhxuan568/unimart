<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();
        // Gate::define('is-admin',function($user){
        //      return $user->is_admin;
        // });
        //
        //user
        Gate::define('list-user', 'App\Policies\UserPolicy@view');
        Gate::define('add-user', 'App\Policies\UserPolicy@create');
        Gate::define('edit-user', 'App\Policies\UserPolicy@update');
        Gate::define('delete-user', 'App\Policies\UserPolicy@delete');
        //menu
        Gate::define('list-menu', 'App\Policies\MenuPolicy@view');
        Gate::define('add-menu', 'App\Policies\MenuPolicy@create');
        Gate::define('edit-menu', 'App\Policies\MenuPolicy@update');
        Gate::define('delete-menu', 'App\Policies\MenuPolicy@delete');
        //product
        Gate::define('list-product', 'App\Policies\ProductPolicy@view');
        Gate::define('add-product', 'App\Policies\ProductPolicy@create');
        Gate::define('edit-product', 'App\Policies\ProductPolicy@update');
        Gate::define('delete-product', 'App\Policies\ProductPolicy@delete');
        //Category Product
        Gate::define('list-category-product', 'App\Policies\CategoryProductPolicy@view');
        Gate::define('add-category-product', 'App\Policies\CategoryProductPolicy@create');
        Gate::define('edit-category-product', 'App\Policies\CategoryProductPolicy@update');
        Gate::define('delete-category-product', 'App\Policies\CategoryProductPolicy@delete');
        //brand-product
        Gate::define('list-brand-product', 'App\Policies\BrandProductPolicy@view');
        Gate::define('add-brand-product', 'App\Policies\BrandProductPolicy@create');
        Gate::define('edit-brand-product', 'App\Policies\BrandProductPolicy@update');
        Gate::define('delete-brand-product', 'App\Policies\BrandProductPolicy@delete');
        //role
        Gate::define('list-role', 'App\Policies\RolePolicy@view');
        Gate::define('add-role', 'App\Policies\RolePolicy@create');
        Gate::define('edit-role', 'App\Policies\RolePolicy@update');
        Gate::define('delete-role', 'App\Policies\RolePolicy@delete');
        //permission
        Gate::define('list-permission', 'App\Policies\PermissionPolicy@view');
        Gate::define('add-permission', 'App\Policies\PermissionPolicy@create');
        Gate::define('edit-permission', 'App\Policies\PermissionPolicy@update');
        Gate::define('delete-permission', 'App\Policies\PermissionPolicy@delete');
        //slider
        Gate::define('list-slider', 'App\Policies\SliderPolicy@view');
        Gate::define('add-slider', 'App\Policies\SliderPolicy@create');
        Gate::define('edit-slider', 'App\Policies\SliderPolicy@update');
        Gate::define('delete-slider', 'App\Policies\SliderPolicy@delete');
        //post
        Gate::define('list-post', 'App\Policies\PostPolicy@view');
        Gate::define('add-post', 'App\Policies\PostPolicy@create');
        Gate::define('edit-post', 'App\Policies\PostPolicy@update');
        Gate::define('delete-post', 'App\Policies\PostPolicy@delete');
        //post category
        Gate::define('list-category-post', 'App\Policies\CategoryPostPolicy@view');
        Gate::define('add-category-post', 'App\Policies\CategoryPostPolicy@create');
        Gate::define('edit-category-post', 'App\Policies\CategoryPostPolicy@update');
        Gate::define('delete-category-post', 'App\Policies\CategoryPostPolicy@delete');
        //page 
        Gate::define('list-page', 'App\Policies\PagePolicy@view');
        Gate::define('add-page', 'App\Policies\PagePolicy@create');
        Gate::define('edit-page', 'App\Policies\PagePolicy@update');
        Gate::define('delete-page', 'App\Policies\PagePolicy@delete');
        //order
        Gate::define('list-order', 'App\Policies\OrderPolicy@view');
        Gate::define('edit-order', 'App\Policies\OrderPolicy@update');
        Gate::define('delete-order', 'App\Policies\OrderPolicy@delete');
        // Gate::define('list-product', function ($user) {
        //     return $user->premissionCheck(config('permissions.access.list_category'));
        // });
        // Gate::define('list-menu', function ($user) {
        //     return $user->premissionCheck('list_menu');
        // });
        // Gate::define('add-menu', function ($user) {
        //     return $user->premissionCheck('add_menu');
        // });
        // Gate::define('edit-menu', function ($user) {
        //     return $user->premissionCheck('edit_menu');
        // });
        // Gate::define('delete-menu', function ($user) {
        //     return $user->premissionCheck('delete_menu');
        // });
    }
}
