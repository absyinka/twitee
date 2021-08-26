<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\IAuthInterface',
            'App\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Interfaces\IPostInterface',
            'App\Repositories\PostRepository'
        );

        $this->app->bind(
            'App\Interfaces\ICommentInterface',
            'App\Repositories\CommentRepository'
        );
    }
}
