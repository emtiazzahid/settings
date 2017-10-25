<?php

namespace Kodeeo\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Kodeeo\Settings\Traits\GetSettings;

class SettingsEloquent extends Model
{
    use GetSettings;

    protected $fillable = [ 'key', 'value' ];

    protected $table = 'kodeeo_settings';

    public $timestamps = false;

}
