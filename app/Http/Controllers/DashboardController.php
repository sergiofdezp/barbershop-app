<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

use App\Models\Order;
use App\Models\Coupon;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('can:dashboard.index')->only('index');
    }

    /**
     * Manda a la vista la información de todas las reservas, el total de reservas en bd y el dinero total consguido.
     *
     * @return void
     */
    public function index()
    {
        $user = Auth::user();
        $day = date('d');
        $month = date('m');
        $last_month = date('m') - 1;

        // Datos mes anterior

        // Numero de reservas realizadas el mes anterior
        $last_month_orders = DB::table('orders')
            ->whereMonth('order_date', '=', $last_month)
            ->get();

        $count_last_month_orders = DB::table('orders')
            ->whereMonth('order_date', '=', $last_month)
            ->count();

        // Dinero generado el mes anterior
        $last_month_money = 0;
    
        foreach($last_month_orders as $last_month_order){
            $last_month_money+=$last_month_order->total_price;
        }

        // Número de cupones utilizados este mes
        $count_last_month_coupons = Order::orderBy('coupon_id', 'desc')
            ->where('coupon_id', '!=', null)
            ->whereMonth('order_date', '=', $last_month)
            ->groupBy('coupon_id')
            ->count();

        // Datos actuales
        //
        // Reservas de hoy
        $today_orders = Order::orderBy('created_at', 'desc')->whereDay('created_at', $day)->get();

        // Número de reservas realizadas este mes
        $month_orders = DB::table('orders')
            ->whereMonth('order_date', '=', $month)
            ->get();

        $count_month_orders = DB::table('orders')
            ->whereMonth('order_date', '=', $month)
            ->count();

        // Dinero generado este mes
        $month_money = 0;
    
        foreach($month_orders as $m_order){
            $month_money+=$m_order->total_price;
        }

        // Número de cupones utilizados este mes
        $count_month_coupons = Order::orderBy('coupon_id', 'desc')
            ->where('coupon_id', '!=', null)
            ->whereMonth('order_date', '=', $month)
            ->groupBy('coupon_id')
            ->count();

        // Servicio más demandado.
        $services_month = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->select('services.type')
            ->get();

        if(!$services_month->isEmpty()){
            foreach($services_month as $service_month){
                $service_month_type = $service_month->type;
            }
        } else{
            $service_month_type = 'Sin datos';
        }

        // Cupón más utilizado
        $coupons_month = DB::table('orders')
            ->join('coupons', 'orders.coupon_id', '=', 'coupons.id')
            ->select('coupons.code')
            ->whereMonth('orders.order_date', '=', $month)
            ->get();

        if(!$coupons_month->isEmpty()){
            foreach($coupons_month as $coupon_month){
                $coupon_month_code = $coupon_month->code;
            }
        } else{
            $coupon_month_code = 'Sin datos';
        }

        // Calculos de diferencia para mandar a la vista el color del texto y el icono
        // Número de reservas
        if ($count_month_orders > $count_last_month_orders) {
            $order_text_color = 'green';
            $order_ico = 'fa-arrow-up';
        } elseif ($count_month_orders < $count_last_month_orders) {
            $order_text_color = 'red';
            $order_ico = 'fa-arrow-down';
        } else {
            $order_text_color = 'blue';
            $order_ico = 'fa-equals';
        }

        // Dinero
        if ($month_money > $last_month_money) {
            $money_text_color = 'green';
            $money_ico = 'fa-arrow-up';
        } elseif ($month_money < $last_month_money) {
            $money_text_color = 'red';
            $money_ico = 'fa-arrow-down';
        } else {
            $money_text_color = 'blue';
            $money_ico = 'fa-equals';
        }

        // Cupones
        if ($count_month_coupons > $count_last_month_coupons) {
            $coupon_text_color = 'green';
            $coupon_ico = 'fa-arrow-up';
        } elseif ($count_month_coupons < $count_last_month_coupons) {
            $coupon_text_color = 'red';
            $coupon_ico = 'fa-arrow-down';
        } else {
            $coupon_text_color = 'blue';
            $coupon_ico = 'fa-equals';
        }

    return view('dashboard', compact('today_orders', 'count_month_orders', 'count_last_month_orders', 'month_money', 'last_month_money', 'count_month_coupons', 'count_last_month_coupons', 'service_month_type', 'coupon_month_code', 'order_text_color', 'order_ico', 'money_text_color', 'money_ico', 'coupon_text_color', 'coupon_ico'));
    }
}
