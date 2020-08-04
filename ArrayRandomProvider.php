<?php


namespace App\Packages\ArrayRandom;


use Illuminate\Support\ServiceProvider;

class ArrayRandomProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('ArrayRandom', function(){
            return $this->app->make(RandomInMinors::class);
        });
    }
}
