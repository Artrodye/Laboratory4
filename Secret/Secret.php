<?php

namespace app\Secret;

class Secret
{
    public static function getSecret(): array
    {
        return [
            'p' => 23,
            'g' => 5,
            'b' => rand(1, 100)
        ];
    }
}