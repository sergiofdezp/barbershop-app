<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

use App\Models\Order;

class PDFController extends Controller
{
    public function today_orders(Request $request){
        $today = date('Y-m-d');

        $today_orders = DB::table('orders')
            ->where('order_date', '=', $today)
            ->orderBy('order_hour','asc')
            ->get();

        $today = date("d/m/Y", strtotime($today));

        $pdf = PDF::loadView('pdf/today_orders', compact('today_orders', 'today'));

        return $pdf->download('today_orders.pdf');
    }
}
