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
            $table->string('order_ref');
            $table->string('order_date');
            $table->string('order_hour');
            // datos de la persona
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            // tipo de servicio (si es pelo o barba)
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            // si la reserva fue hecha desde la peluqueria o desde la web
            $table->boolean('is_online')->default(false);
            // estado de la reserva (próxima - 0, terminada - 1, cancelada - 2, no asistido - 3)
            $table->foreignId('order_status_id')->constrained('order_status')->onDelete('cascade');
            // precio y estado del pago de la reserva (sin pagar, pagada)
            $table->string('total_price');
            $table->integer('pay_status')->nullable();
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('cascade');
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
