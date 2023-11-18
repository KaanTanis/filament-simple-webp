<?php

namespace KaanTanis\FilamentSimpleWebp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \KaanTanis\FilamentSimpleWebp\FilamentSimpleWebp
 */
class FilamentSimpleWebp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \KaanTanis\FilamentSimpleWebp\FilamentSimpleWebp::class;
    }
}
