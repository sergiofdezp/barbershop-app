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
        Schema::create('orders', function (Blueprint $table) {
            // datos principales de la reserva (id y fecha de esta)
            $table->id();
            $table->date('order_date');
            // datos de la persona
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // tipo de servicio (si es pelo o barba)
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            // si la reserva fue hecha desde la peluqueria o desde la web
            $table->boolean('is_online')->default(false);
            // estado de la reserva (próxima - 0, terminada - 1, cancelada - 2, no asistido - 3)
            $table->integer('order_status');
            // precio y estado del pago de la reserva (sin pagar, pagada previamente, pagada)
            $table->string('total_price');
            $table->integer('pay_status');
            // informacion adicional de creacion y edicion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
