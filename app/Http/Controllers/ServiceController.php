<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Service;
use App\Models\Card;

use Auth;

class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware('can:services.index')->only('index');
        $this->middleware('can:services.create')->only('create');
        $this->middleware('can:services.edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $services = Service::all();

        return view('admin.services.index', compact('services'));
    }

    public function services_prices(Request $service_id)
    {
        $service_id = $service_id->get('service_id');

        // Implementación de tarjeta de fidelización.
        $user = Auth::user();
        $available_card = Card::where('user_id', '=', $user->id)->where('available', '=', 1)->count();

        $services = DB::table('services')
            ->where('id', '=', $service_id)
            ->get();

        return response()->json([
            'services' => $services,
            'card'     => $available_card
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $service = $request->all();
        
        if($image = $request->file('image')) {
            $rutaGuardarImg = 'images/services/';
            $imagenService = $service['type']. "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imagenService);
            $service['image'] = "$imagenService";             
        }

        Service::create($service);

        return redirect()->route('services.index')->banner('Servicio añadido correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $serv = $request->all();

        if($imagen = $request->file('imagen')){
           $rutaGuardarImg = 'images/services/';
           $imagenService = $service['type']. "." . $imagen->getClientOriginalExtension(); 
           $imagen->move($rutaGuardarImg, $imagenService);
           $serv['image'] = "$imagenService";
        }else{
           unset($serv['image']);
        }

        $service->update($serv);
        
        return redirect()->route('services.index')->banner('Servicio editado correctamente.');
    }
}
