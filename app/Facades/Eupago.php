<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Eupago extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'eupago';
    }
}