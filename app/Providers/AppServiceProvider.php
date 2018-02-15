<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
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

        // All SQL queries that loads up for the given page.
        DB::listen(function ($query) {
            // echo '<h2>'. $query->sql .'</h2>';
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
