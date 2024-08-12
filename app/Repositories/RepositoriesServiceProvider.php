<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interface\BlogInterface',
            'App\Repositories\BlogRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\CategoryInterface',
            'App\Repositories\CategoryRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\AuthorInterface',
            'App\Repositories\AuthorRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\BookInterface',
            'App\Repositories\BookRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\MemberInterface',
            'App\Repositories\MemberRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\BorrowInterface',
            'App\Repositories\BorrowRepositories',
        );

    }
}
