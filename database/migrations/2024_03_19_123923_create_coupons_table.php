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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            // porcentaje de descuento
            $table->integer('discount');
            // fechas en las que estara activado el cupon
            $table->string('start_date');
            $table->string('end_date');
            // si es 0 se podrá aplicar a todos los servicios, 1 a pelo y 2 a barba
            $table->string('service')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
