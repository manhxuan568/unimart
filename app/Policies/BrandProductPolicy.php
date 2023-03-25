<?php

namespace App\Policies;

use App\BrandProduct;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\BrandProduct  $brandProduct
     * @return mixed
     */
    public function view(User $user)
    {
        //
        return $user->premissionCheck('list_brand_product');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->premissionCheck('add_brand_product');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\BrandProduct  $brandProduct
     * @return mixed
     */
    public function update(User $user)
    {
        //
        return $user->premissionCheck('edit_brand_product');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\BrandProduct  $brandProduct
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        return $user->premissionCheck('delete_brand_product');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\BrandProduct  $brandProduct
     * @return mixed
     */
    public function restore(User $user, BrandProduct $brandProduct)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\BrandProduct  $brandProduct
     * @return mixed
     */
    public function forceDelete(User $user, BrandProduct $brandProduct)
    {
        //
    }
}
