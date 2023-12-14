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
        Schema::create('detallepagos', function (Blueprint $table) {
            $table->id();
            $table->date('fechadetallepago');
            $table->decimal('cantidaddetallepago');
            $table->decimal('saldodetallepago');
            $table->unsignedBigInteger('pagos_id');
            $table->foreign('pagos_id')->references('id')->on('pagos'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallepagos');
    }
};
