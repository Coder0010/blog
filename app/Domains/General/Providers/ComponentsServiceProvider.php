<?php

namespace App\Domains\General\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Core\Abstracts\ServiceProvider;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;

class ComponentsServiceProvider extends ServiceProvider
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
        View::composer([
            "settings::adminpanel.blogs._form.*", "settings::adminpanel.blogs.table",
        ], function ($view) {
            $view->with([
                "categories" => (new EloquentCategoryRepository)->eloquentAll()->ordered()->active()->get()
            ]);
        });
    }
}
