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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rm');
            $table->foreign('rm')->references('id')->on('users');
            $table->unsignedBigInteger('id_revistas');
            $table->foreign('id_revistas')->references('id')->on('revistas');
            $table->date('dt_pegar');
            $table->date('dt_devolver');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
