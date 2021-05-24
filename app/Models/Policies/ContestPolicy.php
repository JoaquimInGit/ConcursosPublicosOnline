<?php

namespace App\Models\Policies;

use App\Models\Contest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contest  $contest
     * @return mixed
     */
    public function view(User $user, Contest $contest)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('manageApp');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contest  $contest
     * @return mixed
     */
    public function update(User $user, Contest $contest)
    {
        return $user->can('manageApp');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contest  $contest
     * @return mixed
     */
    public function delete(User $user, Contest $contest)
    {
        return $user->can('manageApp');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contest  $contest
     * @return mixed
     */
    public function restore(User $user, Contest $contest)
    {
        return $user->can('manageApp');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contest  $contest
     * @return mixed
     */
    public function forceDelete(User $user, Contest $contest)
    {
        return $user->can('manageApp');
    }
}
