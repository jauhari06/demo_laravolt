<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class NewsPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }
    public function viewAny(User $user): bool
    {
        return $user->can(Permission::NEWS_VIEW);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, News $news): bool
    {
        return $user->can(Permission::NEWS_VIEW);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(Permission::NEWS_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, News $news): bool
{

    if ($user->hasRole('Contributor')) {
        return $user->can(Permission::NEWS_EDIT) && ($news->author_id === $user->id);
    }
    return $user->can(Permission::NEWS_EDIT);
}

    
    public function flag(User $user, News $news): bool
    {
        return $user->can(Permission::NEWS_FLAG);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, News $news): bool
    {
        return $user->can(Permission::NEWS_DELETE);
    }

    public function publish(User $user, News $news): bool
    {
        return $user->can(Permission::NEWS_PUBLISH);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, News $news): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, News $news): bool
    {
        return false;
    }

    public function approve(User $user, News $news): bool
    {
        return $news->status !== 'published' && $user->can(Permission::NEWS_PUBLISH);
    }
}
