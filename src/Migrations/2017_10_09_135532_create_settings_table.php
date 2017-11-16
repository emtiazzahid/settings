<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    protected $table;
    protected $keyColumn;
    protected $valueColumn;


    function __construct()
    {
        $this->table = config('kodeeo-settings.table') ? config('kodeeo-settings.table') : 'kodeoo_settings';
        $this->keyColumn = config('kodeeo-settings.keyColumn') ? config('kodeeo-settings.keyColumn') : 'key';
        $this->valueColumn = config('kodeeo-settings.valueColumn') ? config('kodeeo-settings.valueColumn') : 'value';
    }
    
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->string($this->keyColumn)->index();
            $table->text($this->valueColumn);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
