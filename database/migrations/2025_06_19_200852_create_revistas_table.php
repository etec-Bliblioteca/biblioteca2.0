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
        Schema::create('revistas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao',255);
            $table->string('tema');
            $table->integer('quantidade')->nullable();;
            $table->string('imagem');
            $table->string('edicao');
            $table->string('issn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revistas');
    }
};
