<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool
    {
        error_log("mon post ici: " . $post);
        error_log("mon post est payant ou pas: " . $post->paid);

        error_log("valeur exacte de post->paid: " . var_export($post->paid, true));
        if ($post->paid) {
            if ($user) {
                error_log("user existe");
                error_log("user id: " . $user);
                if ($user->hasRole('admin')) {
                    error_log("user est admin");
                    return true;
                }

                if ($user->subscriptions()->wherePivot('active', true)->exists()) {
                    error_log("user a un abonnement actif");
                    return true;
                }
                else {
                    error_log("user n'a pas d'abonnement actif");
                    return false;
                }
            }
            else {
                error_log("user n'existe pas");
                return false;
            }
        }
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        //
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        //
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
        return $user->hasRole('admin');
    }
}
