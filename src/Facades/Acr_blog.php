<?php

namespace Acr\Acr_blog\Facades;

use Illuminate\Support\Facades\Facade;

class Acr_blog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Acr_blog';
    }

}