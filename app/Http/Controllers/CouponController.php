<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Service;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class CouponController extends Controller
{
    public function __construct(){
        $this->middleware('can:coupons.index')->only('index');
        $this->middleware('can:coupons.create')->only('create');
        $this->middleware('can:coupons.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();

        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('coupons.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required | string',
            'discount' => 'required | integer',
            'start_date' => 'required | date',
            'end_date' => 'required | date',
            'service' => 'required | integer',
        ]);

        $coupon = $request->all();
        Coupon::create($coupon);

        return redirect()->route('coupons.index')->banner('Cupón añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        $services = Service::all();
        return view('coupons.edit', compact('coupon', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required | string',
            'discount' => 'required | integer',
            'start_date' => 'required | date',
            'end_date' => 'required | date',
            'service' => 'required | integer',
        ]);
        
        $new_coupon = $request->all();
        $coupon->update($new_coupon);
        
        return redirect()->route('coupons.index')->banner('Cupón editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function generarCodigo($longitud){
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
    
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
    
        return $codigo;
    }

    public function verificarCodUnico($coupon_code){
        $cod_dispo = DB::table('coupons')
            ->where('code', '=', $coupon_code)
            ->count(); // Contar el número de registros con el mismo order_ref

        return $cod_dispo > 0;
    }

    public function generarDiscountCode(){
        do {
            $long_ref = 7;
            $coupon_code = $this->generarCodigo($long_ref);
        } while ($this->verificarCodUnico($coupon_code));

        return response()->json([
            'coupon_code'=>$coupon_code,
        ]);
    }

    public function verificarCodManualUnico(Request $code){
        $code = $code->get('code');

        $coupons = DB::table('coupons')
            ->where('code', '=', $code)
            ->count();

        if($coupons > 0){
            return response()->json([
                'result'=>1,
            ]);
        } else{
            return response()->json([
                'result'=>0,
            ]);
        }
    }
}
