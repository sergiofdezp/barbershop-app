<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\OrderFrontRequest;

use App\Models\Order;
use App\Models\Service;
use App\Models\Coupon;

class OrderFrontController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderFrontRequest $request): RedirectResponse
    {
        $order = $this->manual_order_validations($request);

        Order::create($order);

        return redirect()->route('user_orders');
    }

    /**
     * Comprueba y valida la correcta inserción de los datos antes de hacer un save en la bd.
     *
     * @param [type] $request
     * @return void
     */
    public function manual_order_validations($request){
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
        $final_order_price = Service::select('price')->where('id', $request->service_id)->first()->price;

        // Verifiación de cupón
        if($request->coupon_id){
            $coupon_exists = Coupon::where('id', $request->coupon_id)->count();

            if($coupon_exists <= 0){
                $message = 'Este cupón no existe.';
                return redirect()->route('home')->with('error', $message);
            }

            // Verificación de aplicación para el servicio elegido
            $coupon_service = Coupon::where('id', $request->coupon_id)->value('service');

            if($coupon_service != 0){
                if($coupon_service != $service_selected){
                    $message = 'Este cupón no puede utilizarse con este servicio.';
                    return redirect()->route('home')->with('error', $message);
                }
            }

            $coupon_dates = Coupon::where('id', $request->coupon_id)
                ->where('start_date', '<=', $request->order_date)
                ->where('end_date', '>=', $request->order_date)
                ->count();

            if($coupon_dates < 0){
                $message = 'Este cupón no puede utilizarse en estas fechas.';
                return redirect()->route('home')->with('error', $message);
            }

            // Calculo del precio post cupon
            $coupon_discount = Coupon::where('id', $request->coupon_id)->first()->discount;

            $discount = ($final_order_price * $coupon_discount) / 100;

            $final_order_price = $final_order_price - $discount;
        }

        return $order = [
            'order_ref' => $order_ref,
            'order_date' => $request->order_date,
            'order_hour' => $request->order_hour,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'service_id' => $service_selected,
            'is_online' => 1,
            'order_status_id' => 1,
            'total_price' => $final_order_price,
            'pay_status' => 0,
            'coupon_id' => $request->coupon_id,
        ];
    }
}
