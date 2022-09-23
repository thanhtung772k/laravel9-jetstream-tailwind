<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Services\Category\CategoryService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

// add

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(CategoryService $categoryService)
    {
        Schema::defaultStringLength(191); // add: default varchar(191)
        View::composer(['client.layouts.header'], function ($view) use ($categoryService) {
            $categoryService = $categoryService->countCategory();
            $view->with([
                'categories' => $categoryService,
            ]);
        });
    }
}
