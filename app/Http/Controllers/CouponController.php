<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Coupon;
use App\Models\Service;


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
    public function index(): View
    {
        $coupons = Coupon::all();

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $services = Service::all();
        return view('admin.coupons.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon): View
    {
        $services = Service::all();
        return view('admin.coupons.edit', compact('coupon', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon): RedirectResponse
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
     * Genera un código aleatorio.
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
     * Verifica si el código que recibe existe en la bd.
     *
     * @param [type] $coupon_code
     * @return void
     */
    public function verificarCodUnico($coupon_code){
        $cod_dispo = DB::table('coupons')
            ->where('code', '=', $coupon_code)
            ->count(); // Contar el número de registros con el mismo order_ref

        return $cod_dispo > 0;
    }

    /**
     * Genera un código aleatorio y único, en caso de que el código generado ya exista en la bd, generará otro hasta devolver uno único.
     *
     * @return void
     */
    public function generarDiscountCode(){
        do {
            $long_ref = 7;
            $coupon_code = $this->generarCodigo($long_ref);
        } while ($this->verificarCodUnico($coupon_code));

        return response()->json([
            'coupon_code'=>$coupon_code,
        ]);
    }

    /**
     * Comprueba si el código introducido existe en la bd, en caso de que exista devolverá un error tratado en la vista.
     *
     * @param Request $code
     * @return void
     */
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
