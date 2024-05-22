<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Http\Requests\OrderFrontRequest;

use App\Models\Order;
use App\Models\Service;
use App\Models\Coupon;

class OrderFrontController extends Controller
{
    public function create(): View
    {
        $services = Service::all();
        return view('front.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderFrontRequest $request): RedirectResponse
    {
        try {
            // Llama a manual_order_validations y almacena el resultado en $order
            $order = $this->manual_order_validations($request);
    
            Order::create($order);
    
            return redirect()->route('user_orders')->with('success', 'Orden creada exitosamente.');
        } catch (\Exception $e) {
            // Maneja las excepciones y redirige con un mensaje de error
            return redirect()->route('front.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Comprueba y valida la correcta inserción de los datos antes de hacer un save en la bd.
     *
     * @param [type] $request
     * @return void
     */
    public function manual_order_validations($request)
    {
        // Creación de order_ref.
        $order_controller = new OrderController;
        $order_ref = $order_controller->generarOrderRef();

        $today = date('Y-m-d');
        $now = date('G:i:s');
        $service_selected = $request->service_id;
        $service_exists = Service::where('id', $request->service_id)->exists();

        // Obtener el precio del servicio seleccionado desde el front.
        $final_order_price = Service::where('id', $request->service_id)->value('price');

        // Verificación de fecha de la reserva
        if ($today > $request->order_date) {
            throw new \Exception('La fecha de la reserva debe ser igual o posterior a la fecha de hoy.');
        }

        // Verificación de hora de la reserva
        if ($now > $request->order_hour) {
            throw new \Exception('La hora de la reserva debe ser posterior a la hora actual.');
        }

        // Verificación de selección de servicio
        if ($service_selected == 0) {
            throw new \Exception('No se ha podido guardar la reserva porque no has seleccionado ningún servicio.');
        }

        // Verificación de existencia del servicio en la bd.
        if (!$service_exists) {
            throw new \Exception('No se ha podido guardar la reserva porque has introducido un servicio que no existe.');
        }

        // Verificación de cupón
        if ($request->coupon_id) {
            $coupon_exists = Coupon::where('id', $request->coupon_id)->exists();

            if (!$coupon_exists) {
                throw new \Exception('Este cupón no existe.');
            }

            // Verificación de aplicación para el servicio elegido
            $coupon_service = Coupon::where('id', $request->coupon_id)->value('service');

            if ($coupon_service != 0 && $coupon_service != $service_selected) {
                throw new \Exception('Este cupón no puede utilizarse con este servicio.');
            }

            $coupon_dates = Coupon::where('id', $request->coupon_id)
                ->where('start_date', '<=', $request->order_date)
                ->where('end_date', '>=', $request->order_date)
                ->exists();

            if (!$coupon_dates) {
                throw new \Exception('Este cupón no puede utilizarse en estas fechas.');
            }

            // Calculo del precio post cupón
            $coupon_discount = Coupon::where('id', $request->coupon_id)->value('discount');

            $discount = ($final_order_price * $coupon_discount) / 100;

            $final_order_price -= $discount;
        }

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
            'total_price' => $final_order_price,
            'pay_status' => 0,
            'coupon_id' => $request->coupon_id,
        ];

        return $order;
    }
}
