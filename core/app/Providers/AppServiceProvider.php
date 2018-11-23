<?php

namespace App\Providers;

use App\Social;
use App\General;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        $gnl = General::first();
        if(is_null($gnl))
        {
            $default = [
                'title' => 'THESOFTKING',
                'subtitle' => 'Subtitle',
                'color' => '009933',
                'cur' => 'BITCOIN',
                'cursym' => 'BTC',
                'decimal' => '2',
            ];
            General::create($default);
            $gnl = General::first();
        }
        $socials = Social::all();
        view()->share('gnl',  $gnl);
        view()->share('socials',  $socials);
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
