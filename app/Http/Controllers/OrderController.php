<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\OrderRequest;

use App\Models\Order;
use App\Models\Service;
use App\Models\Hour;
use App\Models\Log;
use App\Models\Card;

use Auth;
use DateTime;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('can:orders.index')->only('index');
        $this->middleware('can:orders.edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
    }

    public function user_orders(): View
    {
        $orders_in_progress = DB::table('orders')
            ->where('user_id', auth()->id())
            ->where('order_status_id', 1)
            ->get();

        $orders_completed = DB::table('orders')
            ->where('user_id', auth()->id())
            ->where('order_status_id', 2)
            ->orWhere('order_status_id', 3)
            ->orWhere('order_status_id', 4)
            ->get();

        // Información de la tarjeta de fidelización.
        $max_services = 8;
        $cards = DB::table('cards')
            ->where('user_id', auth()->id())
            ->get();

        return view('admin.orders.user_orders', compact('orders_in_progress', 'orders_completed', 'max_services', 'cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {        
        $user = Auth::user();
        $services = Service::all();
        $hours = Hour::all();

        // Para la futura implementación del pago con tarjeta de fidelización para clientes en el front
        // $fid_card = Card::where('user_id', '=', $user->id)->where('available', '=', 1)->where('used', '=', 0)->count();

        return view('admin.orders.create', compact('user', 'services', 'hours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $order = $request->all();
        Order::create($order);

        if($user->id == 1 || $user->id == 2){
            return redirect()->route('orders.index')->banner('Reserva añadida correctamente.');
        } else{
            // Implementación de sistema de fidelización.
            $card_controller = new CardController;
    
            // Obtenemos la tarjeta en curso.
            $num_services = Card::where('user_id', '=', $request->user_id)->where('available', '=', 0)->first();
    
            // Update de tarjeta en curso o creación de nueva tarjeta.
            // Si la tarjeta no ha completado los 8 servicios se seguirán incrementando hasta ser 8.
            if($num_services->num_services < 8) {
                $card_controller->update_num_services($request->user_id);
            }
            // En el caso de que la tarjeta tenga 8 servicios, se cambiará su estado 'available' a 1 y se generará una nueva.
            else{
                $card_controller->update_available_card($request->user_id);
                $card_controller->store($request->user_id);
            }
        }

        if($user->id == 1){
            return redirect()->route('orders.index')->banner('Reserva añadida correctamente.');
        }
        else{
            return redirect()->route('user_orders')->banner('Reserva añadida correctamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): View
    {
        $logs = DB::table('logs')
            ->where('order_id', $order->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.orders.show', compact('order', 'logs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        $user = Auth::user();
        $services = Service::all();
        $hours = Hour::all();

        return view('admin.orders.edit', compact('order', 'user', 'services', 'hours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        // Creación de logs al hacer el update.
        $new_log = new LogController;
        $new_log->store($request, $order);

        $new_order = $request->all();
        $order->update($new_order);
        
        return redirect()->route('orders.index')->banner('Reserva editada correctamente.');
    }

    public function cancel_order(Request $request, Order $order): RedirectResponse
    {
        $user = Auth::user();

        // Obtenemos la fecha y hora actual y la fecha y hora de la reserva.
        $hora_actual = new DateTime();//fecha inicial
        $hora_reserva = new DateTime($order->order_date . $order->order_hour);//fecha de cierre

        // Calculamos la diferencia y la formateamos.
        $diff_horas = $hora_actual->diff($hora_reserva);
        $diff_horas = $diff_horas->format('%d día %H horas');

        // Verificamos que el resultado sea menos de 1 dia y 24 horas.
        if($diff_horas < '1 día' && $diff_horas < '24 horas') {
            $message = 'No se puede cancelar esta reserva porque faltan menos de 24h.';

            return redirect()->route('user_orders')->with('error', $message);
        } else{
            if($user->id == 1 || $user->id == 2){
                $new_order = $request->all();
                $order->update($new_order);
                
                return redirect()->route('user_orders')->banner('Reserva "' . $request->order_ref . '" cancelada.');
            } else{
                $new_order = $request->all();
                $order->update($new_order);
            
                $card_controller = new CardController;
                $card_controller->cancel_order_update_num_services($request->user_id);
                
                return redirect()->route('user_orders')->banner('Reserva "' . $request->order_ref . '" cancelada.');
            }
        }
    }

    /**
     * Genera un código compuesto por letras y números de una longitud determinada
     *
     * @param [type] $longitud
     * @return void
     */
    public function generarCodigo($longitud){
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
    
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
    
        return $codigo;
    }

    /**
     * Verifica que el código generado en la función generarCodigo() sea único
     *
     * @param [type] $order_ref
     * @return void
     */
    public function verificarOrderRefUnica($order_ref){
        $ref_dispo = DB::table('orders')
            ->where('order_ref', '=', $order_ref)
            ->count(); // Contar el número de registros con el mismo order_ref

        return $ref_dispo > 0;
    }
    /**
     * Genera un código de referencia único para cada reserva del sistema
     * Es llamada por un ajax desde la vista de creación de una nueva reserva
     *
     * @return void
     */
    public function generarOrderRef(){
        do {
            $long_ref = 10;
            $order_ref = $this->generarCodigo($long_ref);
        } while ($this->verificarOrderRefUnica($order_ref));

        return response()->json([
            'order_ref'=>$order_ref,
        ]);
    }

    /**
     * Esta función es llamada por un ajax de la vista crear reserva. Bloquea las horas del dia seleccionado que ya están reservadas.
     *
     * @param Request $order_date
     * @return void
     */
    public function bloqueosHoras(Request $order_date){
        $order_date = $order_date->get('order_date');

        $orders = DB::table('orders')
            ->where('order_date', '=', $order_date)
            ->get();

        $hours = Hour::all();

        return response()->json([
            'orders'=>$orders,
            'hours'=>$hours,
        ]);
    }

    public function checkDiscountCode(Request $request){
        $code = $request->coupon_code;
        $service_id = $request->service_id;
        $order_date = $request->order_date;

        // Verificar si llega id del servicio seleccionado
        if($service_id == null){
            return response()->json([
                'coupon'=>"noserviceid",
            ]);
        }

        // Verificar si llega la fecha seleccionada
        if($order_date == null){
            return response()->json([
                'coupon'=>"noorderdate",
            ]);
        }

        $coupon = DB::table('coupons')
            ->where('code', '=', $code)
            ->get();

        $coupon_service = DB::table('coupons')
            ->where('code', '=', $code)
            ->value('service');

        $coupon_dates = DB::table('coupons')
            ->where('code', '=', $code)
            ->where('start_date', '<=', $order_date)
            ->where('end_date', '>=', $order_date)
            ->get();

        // Verificación de existencia del cupón, si existe, pasamos a la siguiente comprobación, si no existe devolveremos 0
        if($coupon->count() > 0){
            // Verificamos si el cupon->service está en 0 o coincide, de esta manera sabremos si se puede aplicar al servicio elegido.
            if($coupon_service == 0 || $coupon_service == $service_id){
                if($coupon_dates->count() > 0){
                    return response()->json([
                        'coupon'=>$coupon,
                    ]);
                } else{
                    return response()->json([
                        'coupon'=>"nodates",
                    ]);
                }
            } else{
                return response()->json([
                    'coupon'=>"noservice",
                ]);
            }
        } else { 
            return response()->json([
                'coupon'=>0,
            ]);
        }
    }
}
