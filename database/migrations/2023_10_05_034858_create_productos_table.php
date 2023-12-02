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
            $table->id();
            $table->string('fotoproducto')->nullable();
            $table->string('nombreproducto');
            $table->string('descripcionproducto')->nullable();
            $table->integer('cantidadproducto');
            $table->string('marcaproducto');
            $table->string('unidadmedidaproducto');
            $table->decimal('precioproducto');
            $table->integer('stockminimo');
            $table->boolean('estadoproducto')->default(true);
            $table->string('clasificacionproducto');
            $table->timestamps();
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categorias');
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
