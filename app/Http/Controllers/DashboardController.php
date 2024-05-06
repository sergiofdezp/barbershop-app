<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Coupon;

class DashboardController extends Controller
{
    /**
     * Manda a la vista la información de todas las reservas, el total de reservas en bd y el dinero total consguido.
     *
     * @return void
     */
    public function index()
    {
        // Reservas.
        $orders = Order::orderBy('created_at', 'desc')
            ->where('order_status_id', 0)
            ->get();
            
        // Número total de reservas
        $total_orders = DB::table('orders')
            ->where('order_status_id', 0)
            ->count();
    
        // Dinero total generado.
        $total_money = 0;
    
        foreach($orders as $order){
            $total_money+=$order->total_price;
        }

        // Información de la tarjeta de fidelización.
        $max_services = 8;
        $cards = DB::table('cards')
            ->where('user_id', auth()->id())
            ->get();

        // Servicio más demandado.
        $services = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->select('services.type')
            ->where('orders.order_status_id', 0)
            ->get();

        if(!$services->isEmpty()){
            foreach($services as $service){
                $service_type = $service->type;
            }
        } else{
            $service_type = 'Sin datos';
        }

        // Cupón más utilizado y número total de cupones utilizados.
        $total_coupons = Order::orderBy('coupon_id', 'desc')
            ->where('coupon_id', '!=', null)
            ->where('order_status_id', 0)
            ->groupBy('coupon_id')
            ->count();

        $coupons = DB::table('orders')
            ->join('coupons', 'orders.coupon_id', '=', 'coupons.id')
            ->select('coupons.code')
            ->where('orders.order_status_id', 0)
            ->get();

        if(!$coupons->isEmpty()){
            foreach($coupons as $coupon){
                $coupon_code = $coupon->code;
            }
        } else{
            $coupon_code = 'Sin datos';
        }


        return view('dashboard', compact('orders', 'total_orders', 'total_money', 'max_services', 'cards', 'service_type', 'total_coupons', 'coupon_code'));
    }
}
