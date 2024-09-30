<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ImgUrServiceFacade extends Facade{
    protected static function getFacadeAccessor(){
        return 'imgur';
    }
}