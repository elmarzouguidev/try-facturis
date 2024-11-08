<?php

declare(strict_types=1);

namespace App\Services;


class Randomizer
{
    public function getFloat(
        $min,
        $max,
    ): ?float {


        return mt_rand($min, $max) / mt_getrandmax();
    }
}
