<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Service;
use Illuminate\Http\Request;

class CouponController extends Controller
{
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
}
