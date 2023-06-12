<?php

namespace App\Helpers;

use Illuminate\Contracts\Config\Repository;

class SettingHelper
{
    public function __construct(  
        private readonly Repository $config
    ){}

    /**
     * Get setting value
     */
    public function get(string $key) : mixed
    {
        return $this
        ->config
        ->get("setting.$key");
    }
}
