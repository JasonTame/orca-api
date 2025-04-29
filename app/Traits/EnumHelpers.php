<?php

namespace App\Traits;

trait EnumHelpers
{
    /**
     * Get all values from the enum.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get a random value from the enum.
     */
    public static function random(): string
    {
        $values = self::values();

        return $values[array_rand($values)];
    }
}
