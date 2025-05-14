<?php

use Database\Seeders\MusicSeeder;
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
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->string('album')->nullable();
            $table->integer('year')->nullable();
            $table->string('genre')->nullable();
            $table->string('duration', 8)->nullable();
            $table->timestamps();
        });

        $this->callSeeder();
    }

    private function callSeeder(): void
    {
        (new MusicSeeder)->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};