<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mayor_name')->nullable;
            $table->string('city_hall_street')->nullable;
            $table->string('city_hall_street_number')->nullable;
            $table->string('city_hall_zip')->nullable;
            $table->string('city_hall_post')->nullable;
            $table->string('phone')->nullable;
            $table->string('fax')->nullable;
            $table->string('email')->nullable;
            $table->string('web_address')->nullable;
            $table->string('coat_of_arms_path')->nullable;
            $table->double('latitude')->nullable;
            $table->double('longitude')->nullable;
            $table->integer('timezone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
