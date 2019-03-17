<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->bookRepo();
        $this->adminrepo();
        $this->rolerepo();
        $this->maincategoryrepo();
        $this->subcategoryrepo();
        $this->minicategoryrepo();


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function bookRepo()
    {
        return $this->app->bind('App\Repositories\BookInterface', 'App\Repositories\BookRepository');
    }

    public function adminrepo()
    {
        return $this->app->bind('App\Repositories\AdminInterface', 'App\Repositories\AdminRepository');
    }

    public function rolerepo()
    {
        return $this->app->bind('App\Repositories\RoleInterface','App\Repositories\RoleRepository');
    }
    public  function maincategoryrepo()
    {
        return $this->app->bind('App\Repositories\MaincategoryInterface','App\Repositories\MaincategoryRepo');

    }
    public  function subcategoryrepo()
    {
        return $this->app->bind('App\Repositories\SubcategoryInterface','App\Repositories\SubcategoryRepo');

    }
    public function minicategoryrepo()
    {
        return $this->app->bind('App\Repositories\MinicategoryInterface','App\Repositories\MinicategoryRepo');

    }
}
