<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis reservas') }}
        </h2>
    </x-slot>
    <div class="container pt-5">
        <?php //dd($orders); ?>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
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
        <?php
            $today = date('Y-m-d');
        ?>
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
</x-app-layout>