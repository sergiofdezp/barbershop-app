<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store($request, $order)
    {
        $request_keys = [
            'order_ref' => $request->order_ref,
            'order_date' => $request->order_date,
            'order_hour' => $request->order_hour,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'service_id' => $request->service_id,
            'is_online' => $request->is_online,
            'order_status_id' => $request->order_status_id,
            'total_price' => $request->total_price,
            'pay_status' => $request->pay_status,
        ];

        // Array de traducción de claves
        $translation_keys = [
            'order_date' => 'La fecha de la reserva',
            'order_hour' => 'La hora de la reserva',
            'name' => 'El nombre',
            'phone' => 'El teléfono',
            'service_id' => 'El servicio',
            'is_online' => 'El lugar de reserva',
            'order_status_id' => 'El estado',
            'total_price' => 'El precio',
            'pay_status' => 'El pago',
        ];

        foreach ($request_keys as $key => $value) {
            if ($order->$key != $value) {
                $translatedKey = $translation_keys[$key] ?? $key; // Obtener la traducción de la clave o usar la clave original si no hay traducción
                $message = "$translatedKey ha cambiado de '{$order->$key}' a '$value'. ";

                $log = array(
                    "order_id" => $order->id,
                    "message" => $message,
                    "user_id" => $order->user_id,
                );
         
                Log::create($log);
            }
        }
    }
}
