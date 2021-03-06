<?php

namespace App\Models\Policies;

use App\Models\Entity;
use App\Models\Filter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilterPolicy
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
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function view(User $user, Filter $filter)
    {
        return $user->can('manageApp') || $filter->entity_id == Entity::getCurrentEntity()->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $entity = Entity::getCurrentEntity();
        //se o user atual não tiver uma entidade associada
        if($entity == null){
            //não permite o acesso
            return false;
        }{
            //permite o acesso
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function update(User $user, Filter $filter)
    {
        $entity = Entity::getCurrentEntity();
        //se o user atual não tiver uma entidade associada
        if($entity == null){
            //não permite o acesso
            return false;
        }{
            //permite o acesso
            return $filter->entity_id == $entity->id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function delete(User $user, Filter $filter)
    {
        $entity = Entity::getCurrentEntity();
        //se o user atual não tiver uma entidade associada
        if($entity == null){
            //não permite o acesso
            return false;
        }{
            //permite o acesso
            return $filter->entity_id == $entity->id;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function restore(User $user, Filter $filter)
    {

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return mixed
     */
    public function forceDelete(User $user, Filter $filter)
    {

    }
}
