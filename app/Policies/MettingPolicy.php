<?php

namespace App\Policies;

use App\Models\Metting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MettingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_metting');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Metting $metting): bool
    {
        return $user->can('view_metting');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_metting');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Metting $metting): bool
    {
        return $user->can('update_metting');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Metting $metting): bool
    {
        return $user->can('delete_metting');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Metting $model): bool
    {
        return $user->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Metting $metting): bool
    {
        return $user->can('{{ Restore }}');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Metting $model): bool
    {
        return $user->can('{{ Replicate }}');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }
}
