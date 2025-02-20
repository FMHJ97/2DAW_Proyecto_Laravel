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
        Schema::create('relato_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relato_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_favorite')->default(false);
            $table->boolean('is_like')->default(false);
            $table->timestamps();
            /* Foreign keys */
            $table->foreign('relato_id')->references('id')->on('relatos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relato_user');
    }
};
