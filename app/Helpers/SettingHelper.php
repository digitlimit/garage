<?php

namespace App\Helpers;

use Illuminate\Contracts\Config\Repository;

class SettingHelper
{
    public function __construct(  
        private readonly Repository $config
    ){}

    /**
     * Get all settings
     */
    public function all() : array
    {
        return $this
        ->config
        ->get("setting");
    }

    /**
     * Get setting value
     */
    public function get(string $key) : mixed
    {
        return $this
        ->config
        ->get("setting.$key");
    }

    /**
     * Get the admin email
     */
    public function adminEmail() : string
    {
        return $this
        ->config
        ->get('app.admin.email');
    }
}
