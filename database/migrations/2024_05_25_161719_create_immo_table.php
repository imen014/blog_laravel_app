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
        Schema::create('immobiliers', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->integer('pieces_number');
            $table->string('description');
            $table->string('city');
            $table->string('state');
            $table->float('price');
            $table->float('area');
            $table->string('real_state_type');
            $table->string('transaction_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immo');
    }
};
