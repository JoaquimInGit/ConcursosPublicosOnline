<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Moloni extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'moloni';
    }
}