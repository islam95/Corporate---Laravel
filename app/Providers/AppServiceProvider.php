<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Blade;
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
        // To use variables in Blade templates like so: @set($var, 10)
        Blade::directive('set', function ($data) {
            list($name, $value) = explode(',', $data);
            return "<?php $name = $value ?>";
        });

        

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
}
