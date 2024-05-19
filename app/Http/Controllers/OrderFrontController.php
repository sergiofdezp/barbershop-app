<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Service;

class OrderFrontController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Creación de order_ref.
        $order_controller = new OrderController;
        $order_ref = $order_controller->generarOrderRef();

        // Verificación de fecha de la reserva
        $today = date('Y-m-d');

        if($today > $request->order_date){
            $message = 'La fecha de la reserva debe ser igual o posterior a la fecha de hoy.';
            return redirect()->route('home')->with('error', $message);
        }

        // Verificación de hora de la reserva
        $now = date('G:i:s');

        if($now > $request->order_hour){
            $message = 'La hora de la reserva debe ser posterior a la hora actual.';
            return redirect()->route('home')->with('error', $message);
        }

        // Verificación de selección de servicio
        $service_selected = $request->service_id;

        if($service_selected == 0){
            // Devolver el error de que no se ha seleccionado ningún servicio.
            $message = 'No se ha podido guardar la reserva porque no has seleccionado ningún servicio.';
            return redirect()->route('home')->with('error', $message);
        }

        // Verificación de existencia del servicio en la bd.
        $service_exists = Service::all()->where('id', $request->service_id)->count();
        
        if($service_exists == 0){
            // Devolver el error de que no existe el servicio
            $message = 'No se ha podido guardar la reserva porque has introducido un servicio que no existe.';
            return redirect()->route('home')->with('error', $message);
        }

        // Verificación del precio
        $service_total_price = Service::select('price')->where('id', $request->service_id)->first()->price;

        $order = [
            'order_ref' => $order_ref,
            'order_date' => $request->order_date,
            'order_hour' => $request->order_hour,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'service_id' => $service_selected,
            'is_online' => 1,
            'order_status_id' => 1,
            'total_price' => $service_total_price,
            'pay_status' => 0,
        ];

        Order::create($order);

        return redirect()->route('user_orders');
    }
}
