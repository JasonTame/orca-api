<?php

namespace App\Traits;

trait EnumHelpers
{
    /**
     * Get all values from the enum.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get a random value from the enum.
     *
     * @return string
     */
    public static function random(): string
    {
        $values = self::values();
        return $values[array_rand($values)];
    }
}
