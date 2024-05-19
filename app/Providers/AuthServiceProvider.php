<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        Gate::define('comment-delete', function($user, $comment) {
            return $user->id == $comment->user_id;
        });
        Gate::define('article-delete', function($user, $article) {
            return $user->id == $article->user_id;
        });
        Gate::define('article-edit', function($user, $article) {
            return $user->id == $article->user_id;
        });
        Gate::define('like', function($user, $like) {
            return $user->id == $like->user_id;
        });
        Gate::define('edit-bio', function($currentUser, $profileUser) {
            return $currentUser->id == $profileUser->id;
        });
        Gate::define('edit-rs', function($currentUser, $profileUser) {
            return $currentUser->id == $profileUser->id;
        });
        // insert into `reacts` (`user_id`, `article_id`, `updated_at`, `created_at`) values (1, 24, 2024-05-15 12:04:24, 2024-05-15 12:04:24)
    }
}
