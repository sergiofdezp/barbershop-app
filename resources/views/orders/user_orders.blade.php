@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mis reservas</h1>
@stop

@section('content')
    <div class="container pt-5">
        <?php
            $today = date('Y-m-d');
        ?>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <div class="text-end pb-2">
                    <a href="{{ route('orders.create')}}" class="btn btn-success">
                        Nueva reserva
                    </a>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center pt-3">
            <div class="col-6">
                <h5>Reservas en curso</h5>
                <hr>
            </div>
        </div>
        @foreach ($orders as $order)
            @if($order->order_status == 0 && $order->order_date >= $today)
                <div class="row d-flex justify-content-center pt-1">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('orders.show', $order->id)}}" class="card-title btn btn-dark btn-sm" style="background-color: #33BEFF; border: none;">
                                        Referencia: {{$order->order_ref}}
                                    </a>
                                    <div class="order_status">
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
                                                <input type="number" name="order_status" id="order_status" class="form-control" value="1">
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
            @endif
        @endforeach

        <div class="row d-flex justify-content-center pt-4">
            <div class="col-6">
                <h5>Reservas finalizadas</h5>
                <hr>
            </div>
        </div>
        @foreach ($orders as $order)
            @if(($order->order_status == 0 && $order->order_date < $today) || $order->order_status == 1 || $order->order_status == 2)
                <div class="row d-flex justify-content-center pt-1">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('orders.show', $order->id)}}" class="card-title btn btn-dark btn-sm" style="background-color: #33BEFF; border: none;">
                                        Referencia: {{$order->order_ref}}
                                    </a>
                                    @if($order->order_status == 0 && $order->order_status < $today)
                                        <p class="card-title btn btn-dark btn-sm" style="background-color: #72CA34; border: none;">Terminada</p>
                                    @elseif($order->order_status == 1)
                                        <p class="card-title btn btn-dark btn-sm" style="background-color: #EC3431; border: none;">Cancelada</p>
                                    @elseif($order->order_status == 2)
                                        <p class="card-title btn btn-dark btn-sm" style="background-color: #A9A9A9; border: none;">No asistida</p>
                                    @endif
                                </div>
                                <p class="card-text m-0">Fecha de la reserva: {{$order->order_date}} | {{$order->order_hour}}h.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
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