<?php


namespace App\Packages\ArrayRandom;


use Illuminate\Support\Facades\Facade;

class ArrayRandomFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ArrayRandom';
    }

}
