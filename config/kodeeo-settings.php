<?php

return [

    /*
    |--------------------------------------------------------------------------
    | For Cache Enable or Disable
    |--------------------------------------------------------------------------
    | Supported: "true", "false"
    |
    */

    'cache' => true,

    /*
    |--------------------------------------------------------------------------
    | Setting model name
    |--------------------------------------------------------------------------
    | Write your settings model name with namespace.
    |
    */

    'model' => Kodeeo\Settings\Models\SettingsEloquent::class,
    
    /*
     * ------------------------------------------------------------------------
     * Settings Table name
     * ------------------------------------------------------------------------
     * If you want to use custom table name in database you could set them 
     * in this configuration
     */
    
    'table' => 'kodeeo_settings',

    /*
    |--------------------------------------------------------------------------
    | Settings Key Column and Value Column
    |--------------------------------------------------------------------------
    | If you want to use custom column names in database store you could set
    | them in this configuration
    |
    */

    'keyColumn' => 'key',
    'valueColumn' => 'value'
];
