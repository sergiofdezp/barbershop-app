@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mis reservas</h1>
@stop

@section('content')
    <div class="container pt-5">
        @if (session()->has('error')) {{-- comprueba si existe el valor en sesión --}}
            <div class="error d-flex flex-row justify-content-center">
                <div class="col-6">
                    <p class="bg-danger text-white rounded p-2"> {{ session('error') }} </p> {{-- devuelve e imprime el valor de la sesión --}}
                </div>
            </div>

            {!! session()->forget('error') !!} {{-- borrar el error de sesión --}}
        @endif

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card rounded">
                            <div class="card-body d-flex align-items-center">
                                <div class="test">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="rounded-circle border border-white bg-transparent">
                                            <img class="img-fluid rounded-circle border border-white" width="50px" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @endif
                                </div>
                                <div class="px-3">
                                    <h5 class="card-title mb-0 fw-bold">Bienvenido, {{ Auth::user()->name }}</h5>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn text-muted text-sm p-0">Cerrar sesión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card service-hover d-flex align-items-center text-center rounded h-100 mb-0">
                            <div class="card-body  d-flex flex-column justify-content-center align-items-center">
                                <a href="{{ route('front.create')}}" class="text-decoration-none link-dark">Nueva reserva</a>
                                <p class="card-text text-muted text-sm">Añade una nueva reserva en el sistema.</p>
                            </div>
                        </div>
                    </div>
                    @hasanyrole('Admin|Peluquero')
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card service-hover d-flex align-items-center text-center rounded h-100 mb-0">
                                <div class="card-body  d-flex flex-column justify-content-center align-items-center">
                                    <a href="{{ route('orders.create')}}" class="text-decoration-none link-dark">Ver reservas</a>
                                    <p class="card-text text-muted text-sm">Consulta todas las reservas del sistema.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @foreach($cards as $card)
                                <div class="card col-12 p-2 mb-0">
                                    <!-- <x-application-mark class="block h-9 w-auto"/> -->
                                    <div class="card-body">
                                        <h5 class="text-center pb-2">¡Completa 8 reservas y recibe 1 gratis!</h5>
                                        <div class="row px-5 pb-3">
                                            @for ($i = 0; $i < $max_services; $i++)
                                                <div class="d-flex justify-content-center col-3 p-0">
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
                    @endhasanyrole
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="row d-flex justify-content-center pt-3">
                    <div class="col-12">
                        <h5>Reservas en curso</h5>
                        <hr>
                    </div>
                </div>
                <section class="uo-scroll p-lg-3">
                    @forelse($orders_in_progress as $order)
                        <div class="row d-flex justify-content-center pt-1">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('orders.show', $order->id)}}" class="card-title btn btn-dark btn-sm" style="background-color: #33BEFF; border: none;">
                                                Ver reserva
                                            </a>
                                            <div class="order_status_id">
                                                <form action="{{ route('orders.cancel_order', $order->id) }}" id="form_update" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div hidden>
                                                        <input type="text" name="order_ref" id="order_ref" class="form-control" value="{{$order->order_ref}}">
                                                        <input type="text" name="order_date" id="order_date" class="form-control" value="{{$order->order_date}}">
                                                        <input type="text" name="order_hour" id="order_hour" class="form-control" value="{{$order->order_hour}}">
                                                        <input type="number" name="user_id" id="user_id" class="form-control" value="{{$order->user_id}}">
                                                        <input type="text" name="name" id="name" class="form-control" value="{{$order->name}}">
                                                        <input type="text" name="phone" id="phone" class="form-control" value="{{$order->phone}}" placeholder="Introduce el teléfono del cliente">
                                                        <input type="number" name="service_id" id="service_id" class="form-control" value="{{$order->service_id}}">
                                                        <input type="number" name="is_online" id="is_online" class="form-control" value="{{$order->is_online}}">
                                                        <input type="number" name="order_status_id" id="order_status_id" class="form-control" value="3">
                                                        <input type="number" name="total_price" id="total_price" class="form-control" value="{{$order->total_price}}">
                                                        <input type="number" name="pay_status" id="pay_status" class="form-control" value="{{$order->pay_status}}">
                                                        <input type="number" name="coupon_id" id="coupon_id" class="form-control" value="{{$order->coupon_id}}">
                                                    </div>
                                                    <button type="submit" class="card-title btn btn-dark btn-sm" style="background-color: #33BEFF; border: none;">Cancelar reserva</button>
                                                </form>
                                            </div>
                                        </div>
                                        <p class="card-text m-0">Fecha de la reserva: {{$order->order_date}} | {{$order->order_hour}}h.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="row d-flex justify-content-center pt-1">
                            <div class="col-12">
                                <p>No hay reservas en curso.</p>
                            </div>
                        </div>
                    @endforelse
                </section>
                
                <div class="row d-flex justify-content-center pt-4">
                    <div class="col-12">
                        <h5>Reservas finalizadas</h5>
                        <hr>
                    </div>
                </div>
                <section class="uo-scroll p-lg-3">
                    @forelse($orders_completed as $order)
                            <div class="row d-flex justify-content-center pt-1">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('orders.show', $order->id)}}" class="card-title btn btn-dark btn-sm" style="background-color: #33BEFF; border: none;">
                                                    Ver reserva
                                                </a>
                                                @if($order->order_status_id == 2)
                                                    <p class="card-title btn btn-dark btn-sm" style="background-color: #72CA34; border: none;">Terminada</p>
                                                @elseif($order->order_status_id == 3)
                                                    <p class="card-title btn btn-dark btn-sm" style="background-color: #EC3431; border: none;">Cancelada</p>
                                                @elseif($order->order_status_id == 4)
                                                    <p class="card-title btn btn-dark btn-sm" style="background-color: #A9A9A9; border: none;">No asistida</p>
                                                @endif
                                            </div>
                                            <p class="card-text m-0">Fecha de la reserva: {{$order->order_date}} | {{$order->order_hour}}h.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @empty
                        <div class="row d-flex justify-content-center pt-1">
                            <div class="col-12">
                                <p>No hay reservas finalizadas.</p>
                            </div>
                        </div>         
                    @endforelse
                </section>
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
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
@stop

@section('js')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stop
