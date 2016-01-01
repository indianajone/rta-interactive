<?php

namespace App\Providers;

use Ravarin\Entities\Ceo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->injectCeoComponent();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function injectCeoComponent() 
    {
        view()->composer('components.ceo', function ($view) {
            $ceo = (new Ceo)->where('name', 'ceo')->with('translations')->first();
            $view->with('ceo', $ceo);
        });
    }
}
