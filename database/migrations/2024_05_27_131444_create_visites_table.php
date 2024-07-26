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
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('immobilier_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('immobilier_id')->references('id')->on('immobiliers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date_demander');
            $table->time('time_demander');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
