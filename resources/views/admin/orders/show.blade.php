@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><span class="fw-bold">Reserva:</span> {{$order->order_ref}}</h1>
@stop
@section('content')
    <div class="container pt-5">
        <div class="row pb-3">
            <div class="text-end p-0">
                <a href="{{ route('orders.edit', $order->id)}}" class="inline-flex items-center px-4 py-2 bg-navy-600 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-navy-700 focus:bg-navy-700 active:bg-navy-900
                                focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 no-underline">
                    Editar reserva
                </a>
            </div>
        </div>

        <div class="row border p-4">
            <div class="col-6">
                <h5>Detalles de la reserva</h5>
                <hr>
                <p class="fw-bold">Servicio: <span class="fw-normal">{{$order->service->type}}.</span></p>
                <p class="fw-bold">Día de la reserva: <span class="fw-normal">{{$order->order_date}}.</span></p>
                <p class="fw-bold">Hora de la reserva: <span class="fw-normal">{{$order->order_hour}}h.</span></p>
                <p class="fw-bold">Estado de la reserva: 
                    <span class="fw-normal">
                        @if($order->order_status_id == 1)
                            <p class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #33BEFF; border: none;">En curso</p>

                        @elseif($order->order_status_id == 2)
                            <p class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #72CA34; border: none;">Terminada</p>

                        @elseif($order->order_status_id == 3)
                            <p class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #EC3431; border: none;">Cancelada</p>

                        @elseif($order->order_status_id == 4)
                            <p class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #A9A9A9; border: none;">No asistida</p>
                        @endif
                    </span>
                </p>
            </div>
            <div class="col-6">
                <h5>Detalles del cliente</h5>
                <hr>
                <p class="fw-bold">Nombre del cliente: <span class="fw-normal">{{$order->name}}.</span></p>
                <p class="fw-bold">Teléfono del cliente: <span class="fw-normal">{{$order->phone}}.</span></p>
            </div>
        </div>

        <div class="row border p-4 mt-3">
            <div class="col-6">
                <h5>Otros detalles</h5>
                <hr>
                <p class="fw-bold">Usuario que ha realizado la reserva: <span class="fw-normal">{{$order->user->name}}.</span></p>
                <p class="fw-bold">Lugar de reserva:
                    <span class="fw-normal">
                        @if($order->is_online == 0) Barbería.
    
                        @elseif($order->is_online == 1) Web.
    
                        @endif
                    </span>
                </p>
                <p class="fw-bold">Fecha de creación de la reserva: <span class="fw-normal">{{$order->created_at}}.</span></p>
                <p class="fw-bold">Última actualización: <span class="fw-normal">{{$order->updated_at}}.</span></p>
                @if($order->coupon)
                    <p class="fw-bold">Cupón de descuento: <span class="fw-normal">{{$order->coupon->code}}.</span></p>
                @endif
            </div>
            <div class="col-6">
                <h5>Detalles del pago</h5>
                <hr>
                <p class="fw-bold">Precio total: <span class="fw-normal">{{$order->total_price}}€.</span></p>
                <p class="fw-bold">Estado del pago:
                    <span class="fw-normal">
                        @if($order->pay_status == 0) Pendiente.
    
                        @elseif($order->pay_status == 1) Pagado.
    
                        @endif
                    </span>
                </p>
            </div>
        </div>
        <div class="row border p-4 mt-3">
            <ul>
                <li>
                    @foreach($logs as $log)
                        <div class="d-flex justify-content-between">
                            <p>{{$log->message}}</p>
                            <p>{{$log->updated_at}}</p>
                        </div>
                    @endforeach  
                </li>
                <li>
                    <div class="d-flex justify-content-between">
                        <p>La reserva se ha creado.</p>
                        <p>{{$order->created_at}}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
@stop

@section('js')
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stop