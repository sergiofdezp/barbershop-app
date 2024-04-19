<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Hour;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        $user = Auth::user();
        $services = Service::all();
        $hours = Hour::all();

        return view('orders.create', compact('user', 'services', 'hours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_ref' => 'required | string',
            'order_date' => 'required | date',
            'order_hour' => 'required | string',
            'user_id' => 'required',
            'name' => 'required | string',
            'phone' => 'required | integer',
            'service_id' => 'required',
            'is_online' => 'required',
            'order_status' => 'required',
            'total_price' => 'required',
            'pay_status' => 'required',
        ]);

        $order = $request->all();
        Order::create($order);

        return redirect()->route('orders.index')->banner('Reserva añadida correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $user = Auth::user();
        $services = Service::all();
        $hours = Hour::all();

        return view('orders.edit', compact('order', 'user', 'services', 'hours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_ref' => 'required | string',
            'order_date' => 'required | date',
            'order_hour' => 'required | string',
            'user_id' => 'required',
            'name' => 'required | string',
            'phone' => 'required | integer',
            'service_id' => 'required',
            'is_online' => 'required',
            'order_status' => 'required',
            'total_price' => 'required',
            'pay_status' => 'required',
        ]);

        $new_order = $request->all();
        $order->update($new_order);
        
        return redirect()->route('orders.index')->banner('Reserva editada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
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
}
