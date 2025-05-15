<?php

namespace MedanWeb\Tools\Filament\Traits;

trait CustomRoutePrefix
{
    public static function getRoutePrefix($prefix = 'mw_'): string
    {
        return $prefix . static::getSlug();
    }
}
