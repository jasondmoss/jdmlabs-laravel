<?php

declare(strict_types=1);

namespace App\Shared\Traits;

use Illuminate\Support\Str;

trait EnumOptions
{

    /**
     * @return array
     */
    public static function options(): array
    {
        $cases = static::cases();
        $options = [];

        foreach ($cases as $case) {
            $label = $case->name;

            if (Str::contains($label, '_')) {
                $label = Str::replace('_', ' ', $label);
            }

            $options[] = [
                'value' => $case->value,
                'label' => Str::title($label)
            ];
        }

        return $options;
    }

}
