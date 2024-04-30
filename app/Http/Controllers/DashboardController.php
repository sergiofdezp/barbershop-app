<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Manda a la vista la información de todas las reservas, el total de reservas en bd y el dinero total consguido.
     *
     * @return void
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        $total_orders = DB::table('orders')->count();
        $cards = DB::table('cards')
            ->where('user_id', auth()->id())
            ->get();

        $max_services = 8;
        $total_money = 0;

        foreach($orders as $order){
            $total_money+=$order->total_price;
        }

        return view('dashboard', compact('orders', 'total_orders', 'cards', 'max_services', 'total_money'));
    }
}
