<?php

namespace MedanWeb\Tools\Filament\Traits;

use Filament\Panel;

trait MedanWebRoutePrefix
{
    protected static string $medanWebPrefix = 'mw_';

    public static function getRoutePrefix(Panel $panel): string
    {
        return self::$medanWebPrefix . static::getSlug();
    }
}
