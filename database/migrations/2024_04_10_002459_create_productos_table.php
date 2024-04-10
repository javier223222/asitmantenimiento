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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id_producto');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('marca');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_usuario_tecnico')->nullable();
            $table->foreign('categoria_id')->references('id_categoria')->on('categorias');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_usuario_tecnico')->references('id_usuario')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
