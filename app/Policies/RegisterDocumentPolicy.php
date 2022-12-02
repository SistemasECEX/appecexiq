<?php

namespace App\Policies;

use App\Models\User;
use App\Models\register_document;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegisterDocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\register_document  $registerDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, register_document $registerDocument)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\register_document  $registerDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, register_document $registerDocument)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\register_document  $registerDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, register_document $registerDocument)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\register_document  $registerDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, register_document $registerDocument)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\register_document  $registerDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, register_document $registerDocument)
    {
        //
    }
}
