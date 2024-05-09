@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12">
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
            <div class="col-sm-2">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text text-muted text-sm">Reservas</p>
                        <h5 class="card-title">
                            <p class="mb-0">{{$count_last_month_orders}} | <span class="text-{{$order_text_color}}">{{$count_month_orders}} <i class="fas {{$order_ico}}"></i></span></p>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text text-muted text-sm">Dinero</p>
                        <h5 class="card-title">
                            <p class="mb-0">{{$last_month_money}}€ | <span class="text-{{$money_text_color}}">{{$month_money}}€ <i class="fas {{$money_ico}}"></i></span></p>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text text-muted text-sm">Cupones</p>
                        <h5 class="card-title">
                            <p class="mb-0">{{$count_last_month_coupons}} | <span class="text-{{$coupon_text_color}}">{{$count_month_coupons}} <i class="fas {{$coupon_ico}}"></i></span></p>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text text-muted text-sm">Servicio más demandado</p>
                        <h5 class="card-title">{{$service_month_type}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text text-muted text-sm">Cupón más utilizado</p>
                        <h5 class="card-title">{{$coupon_month_code}}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row o-scroll">
            <div class="col-12">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text fw-bold">Reservas de hoy</p>
                        <?php
                            if(!$today_orders->isEmpty()){
                        ?>
                                <table class="table" id="orders_table" class="display">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-sm text-muted">Hora de reserva</th>
                                            <th scope="col" class="text-sm text-muted">Servicio</th>
                                            <th scope="col" class="text-sm text-muted">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($today_orders as $order)
                                        <tr>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->service->type}}</td>
                                            <td>{{$order->order_date}} {{$order->order_hour}}</td>
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
    </div>
@stop

@section('css')
    @livewireStyles
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stop
