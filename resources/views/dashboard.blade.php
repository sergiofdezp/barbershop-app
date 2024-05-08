@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row pt-5 pb-4">
            <div class="col-sm-6">
                <div class="card rounded">
                    <div class="card-body d-flex align-items-center">
                        <div class="test">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @endif
                        </div>
                        <div class="px-3">
                            <h5 class="card-title mb-0 fw-bold">Bienvenido, {{ Auth::user()->name }}</h5>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="text-muted text-sm">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-4">
            <div class="col-6">
                <div class="row h-100">
                    <div class="col-12 pb-2">
                        <div class="card service-hover d-flex align-items-center text-center rounded h-100">
                            <div class="card-body d-flex align-items-center text-center">
                                <a href="{{ route('orders.create')}}" class="text-decoration-none link-dark">Nueva reserva</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @hasanyrole('Admin|Peluquero')
                            <div class="card service-hover d-flex align-items-center text-center rounded h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <a href="{{ route('orders.index')}}" class="text-decoration-none link-dark">Todas las reservas</a>
                                    <p class="card-text text-muted text-sm">Consulta el listado de las reservas del sistema.</p>
                                </div>
                            </div>
                        @else
                            <div class="card service-hover d-flex align-items-center text-center rounded h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <a href="{{ route('user_orders')}}" class="text-decoration-none link-dark">Mis reservas</a>
                                    <p class="card-text text-muted text-sm">Consulta el estado de tus reservas o cancela tu reserva.</p>
                                </div>
                            </div>
                        @endrole
                    </div>
                </div>
            </div>
            @hasanyrole('Admin|Peluquero')
                @else
                    <div class="col-6">
                        @foreach($cards as $card)
                            <div class="card col-12 p-2 mb-0">
                                <x-application-mark class="block h-9 w-auto"/>
                                <div class="card-body">
                                    <h5 class="text-center pb-2">¡Completa 8 reservas y recibe 1 gratis!</h5>
                                    <div class="row px-5 pb-3">
                                        @for ($i = 0; $i < $max_services; $i++)
                                            <div class="d-flex justify-content-center col-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="{{ $i < $card->num_services ? 'currentColor' : 'gray' }}" class="bi bi-scissors" viewBox="0 0 16 16">
                                                    <path d="M3.5 3.5c-.614-.884-.074-1.962.858-2.5L8 7.226 11.642 1c.932.538 1.472 1.616.858 2.5L8.81 8.61l1.556 2.661a2.5 2.5 0 1 1-.794.637L8 9.73l-1.572 2.177a2.5 2.5 0 1 1-.794-.637L7.19 8.61zm2.5 10a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0m7 0a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                                                </svg>
                                            </div>
                                        @endfor
                                    </div>
                                    <?php
                                        if($max_services == $card->num_services){
                                            echo '<p class="text-center">Has completado las 8 reservas. Ya puedes aplicar esta tarjeta en tu siguiente reserva.</p>';
                                        } else{
                                            echo '<p class="text-center text-muted">Faltan ' . ($max_services - $card->num_services) . ' reservas para poder utilizar esta tarjeta.</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        @endforeach
                    </div>
            @endrole
        </div>

        @hasanyrole('Admin|Peluquero')
            <div class="row">
                <div class="col-sm-2">
                    <div class="card rounded">
                        <div class="card-body">
                            <p class="card-text text-muted text-sm">Reservas totales</p>
                            <h5 class="card-title">{{$total_orders}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card rounded">
                        <div class="card-body">
                            <p class="card-text text-muted text-sm">Dinero total</p>
                            <h5 class="card-title">{{$total_money}}€</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card rounded">
                        <div class="card-body">
                            <p class="card-text text-muted text-sm">Cupones utilizados</p>
                            <h5 class="card-title">{{$total_coupons}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card rounded">
                        <div class="card-body">
                            <p class="card-text text-muted text-sm">Servicio más demandado</p>
                            <h5 class="card-title">{{$service_type}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card rounded">
                        <div class="card-body">
                            <p class="card-text text-muted text-sm">Cupón más utilizado</p>
                            <h5 class="card-title">{{$coupon_code}}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    <div class="card rounded">
                        <div class="card-body">
                            <p class="card-text fw-bold">Últimas reservas</p>
                            <?php
                                if(!$orders->isEmpty()){
                            ?>
                                    <table class="table" id="orders_table" class="display">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-sm text-muted">Hora de reserva</th>
                                                <th scope="col" class="text-sm text-muted">Servicio</th>
                                                <th scope="col" class="text-sm text-muted">Fecha</th>
                                                <th scope="col" class="text-sm text-muted">Estado del pago</th>
                                                <th scope="col" class="text-sm text-muted">Cliente</th>
                                                <th scope="col" class="text-sm text-muted">Teléfono</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$order->created_at}}</td>
                                                <td>{{$order->service->type}}</td>
                                                <td>{{$order->order_date}} {{$order->order_hour}}</td>
                                                <td>
                                                    @if($order->pay_status == 0) Pendiente

                                                    @elseif($order->pay_status == 1) Pagado

                                                    @endif
                                                </td>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->phone}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            <?php
                                } else{
                                    echo '<p class="text-muted text-sm">No hay reservas para mostrar.</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        @endhasanyrole
    </div>
@stop

@section('css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
@stop

@section('js')
    <!-- <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script> -->
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stop
