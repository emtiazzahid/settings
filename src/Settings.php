<?php

namespace Kodeeo\Settings;

use Kodeeo\Settings\Services\SettingsService;

class Settings
{
    protected $settingsSettings;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsSettings = $settingsService;
    }

    public function get()
    {

    }

    public function set()
    {

    }

    public function all()
    {

    }
}