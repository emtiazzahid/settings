<?php

namespace Kodeeo\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Kodeeo\Settings\Traits\GetSettings;

class SettingsEloquent extends Model
{
    protected $table;
    protected $keyColumn;
    protected $valueColumn;


    function __construct()
    {
        $this->table = config('kodeeo-settings.table') ? config('kodeeo-settings.table') : 'kodeoo_settings';
        $this->keyColumn = config('kodeeo-settings.keyColumn') ? config('kodeeo-settings.keyColumn') : 'key';
        $this->valueColumn = config('kodeeo-settings.valueColumn') ? config('kodeeo-settings.valueColumn') : 'value';
        $this->fillable = [$this->keyColumn, $this->valueColumn];
    }
    
    use GetSettings;
    

    public $timestamps = false;

}
