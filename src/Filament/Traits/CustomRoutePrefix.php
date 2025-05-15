<?php

namespace MedanWeb\Tools\Filament\Traits;

trait CustomRoutePrefix
{
    public static function getRoutePrefix(): string
    {
        return 'mw_' . static::getSlug();
    }
}
