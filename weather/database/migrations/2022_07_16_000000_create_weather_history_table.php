<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('weather_history')) {
            Schema::create('weather_history', function (Blueprint $table) {
                $table->date('date')->unique();
                $table->double('temp_min', 4);
                $table->double('temp_max', 4);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_history');
    }
};
