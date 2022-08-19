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
        $this->app->bind(\App\Repositories\ProjectType\ProjectTypeRepository::class, \App\Repositories\ProjectType\ProjectTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserHasProject\UserHasProjectRepository::class, \App\Repositories\UserHasProject\UserHasProjectRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Department\DepartmentRepository::class, \App\Repositories\Department\DepartmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Position\PositionRepository::class, \App\Repositories\Position\PositionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserDetail\UserDetailRepository::class, \App\Repositories\UserDetail\UserDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Timekeeping\TimekeepingRepository::class, \App\Repositories\Timekeeping\TimekeepingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Category\CategoryRepository::class, \App\Repositories\Category\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Comment\CommentRepository::class, \App\Repositories\Comment\CommentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Post\PostRepository::class, \App\Repositories\Post\PostRepositoryEloquent::class);
        //:end-bindings:
    }
}
