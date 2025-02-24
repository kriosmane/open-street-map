<?php

namespace Kriosmane\OpenStreetMap\Facades;

use Illuminate\Support\Facades\Facade;
use Kriosmane\OpenStreetMap\OpenStreetMap as OpenStreetMapClass;

class OpenStreetMap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OpenStreetMapClass::class;
    }
}
