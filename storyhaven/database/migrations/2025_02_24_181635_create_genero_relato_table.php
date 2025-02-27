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
        Schema::create('genero_relato', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genero_id');
            $table->unsignedBigInteger('relato_id');
            // $table->timestamps(); // No es necesario porque no se requiere saber cuándo se creó o actualizó un género_relato
            // Foreign keys
            $table->foreign('genero_id')->references('id')->on('generos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('relato_id')->references('id')->on('relatos')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genero_relato');
    }
};
