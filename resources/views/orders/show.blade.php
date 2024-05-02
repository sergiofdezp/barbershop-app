@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><span class="fw-bold">Reserva:</span> {{$order->order_ref}}</h1>
@stop
@section('content')
    <div class="container pt-5">
        <div class="row pb-3">
            <div class="text-end">
                <a href="{{ route('orders.edit', $order->id)}}" class="btn btn-success" style="background-color: #2019FF; border: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
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
                        <?php
                            $today = date('Y-m-d');
                        ?>
                        @if($order->order_status == 0)
                            @if($order->order_date > $today) 
                                <p class="btn btn-dark btn-sm mb-0" style="background-color: #33BEFF; border: none;">En curso</p>
                            @else 
                                <p class="btn btn-dark btn-sm mb-0" style="background-color: #72CA34; border: none;">Terminada</p>
                            @endif

                        @elseif($order->order_status == 1)
                            <p class="btn btn-dark btn-sm mb-0" style="background-color: #EC3431; border: none;">Cancelada</p>

                        @elseif($order->order_status == 2)
                            <p class="btn btn-dark btn-sm mb-0" style="background-color: #A9A9A9; border: none;">No asistida</p>

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
    
                        @elseif($order->pay_status == 1) Web.
    
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
            <div class="accordion" id="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Últimas Actualizaciones de la reserva
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            @foreach($logs as $log)
                                <div class="d-flex justify-content-between">
                                    <p>{{$log->message}}</p>
                                    <p>{{$log->updated_at}}</p>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between">
                                <p>La reserva se ha creado.</p>
                                <p>{{$order->created_at}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    @livewireStyles
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
@stop

@section('js')
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stop