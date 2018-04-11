<?php
namespace laraveldes3;

use Illuminate\Support\Facades\Facade;
class Des3Facade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'des3';
    }
}