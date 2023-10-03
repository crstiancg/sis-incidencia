<?php

namespace App\Policies;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EquipoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Equipo $equipo): bool
    {
        return $user->hasPermissionTo('equipo index') ? true : false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('equipo create') ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Equipo $equipo): bool
    {
        return $user->hasPermissionTo('equipo update') ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equipo $equipo): bool
    {
        return $user->hasPermissionTo('equipo delete') ? true : false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Equipo $equipo): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Equipo $equipo): bool
    {
        //
    }
}
