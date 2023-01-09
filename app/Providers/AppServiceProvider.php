<?php

namespace App\Providers;

use App\Http\Contracts\CategoryRepository;
use App\Http\Contracts\ProductRepository;
use App\Http\Repositories\CategoryDBFacade;
use App\Http\Repositories\ProductDBFacade;
use App\Models\Category;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryDBFacade::class);
        $this->app->bind(ProductRepository::class, ProductDBFacade::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
