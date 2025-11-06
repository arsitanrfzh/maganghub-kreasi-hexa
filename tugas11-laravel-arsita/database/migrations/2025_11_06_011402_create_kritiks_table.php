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
        Schema::create('kritiks', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->integer('point');

            // Foreign Key ke tabel users (siapa yg memberi kritik)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Foreign Key ke tabel films (film apa yg dikritik)
            $table->unsignedBigInteger('film_id');
            $table->foreign('film_id')->references('id')->on('films');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kritiks');
    }
};
