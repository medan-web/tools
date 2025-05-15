<?php

namespace MedanWeb\Tools\Filament\Traits;

use Illuminate\Database\Eloquent\Model;

trait Irremovable
{
    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canForceDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function canForceDeleteAny(): bool
    {
        return false;
    }
}
