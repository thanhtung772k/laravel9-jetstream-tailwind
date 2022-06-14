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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\User\UserRepository::class, \App\Repositories\User\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Timesheet\TimesheetRepository::class, \App\Repositories\Timesheet\TimesheetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AddTimesheet\AddTimesheetRepository::class, \App\Repositories\AddTimesheet\AddTimesheetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Project\ProjectRepository::class, \App\Repositories\Project\ProjectRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Role\RoleRepository::class, \App\Repositories\Role\RoleRepositoryEloquent::class);
        //:end-bindings:
    }
}
