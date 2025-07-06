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
            $table->integer('rm');
            $table->foreign('rm')->references('rm')->on('users')->cascade('delete')->cascade('update');
            $table->unsignedBigInteger('id_revista');
            $table->foreign('id')->references('id')->on('revistas')->cascade('delete')->cascade('update');
            $table->date('dt_pegar');
            $table->date('dt_devolver');
            $table->boolean('state')->default(false);
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
