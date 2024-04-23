<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row pt-5">
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
            <div class="col-sm-6">
                <div class="card service-hover d-flex align-items-center text-center rounded h-100">
                    <div class="card-body d-flex align-items-center text-center">
                        <a href="{{ route('orders.index')}}" class="text-decoration-none link-dark">Todas las reservas</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-sm-6">
                <div class="card service-hover d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('user_orders')}}" class="text-decoration-none link-dark">Mis reservas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card service-hover d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('orders.create')}}" class="text-decoration-none link-dark">Nueva reserva</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-sm-6">
                <div class="card service-hover d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('services.index')}}" class="text-decoration-none link-dark">Servicios</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card service-hover d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('services.create')}}" class="text-decoration-none link-dark">Nuevo servicio</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-sm-6">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text text-sm">Reservas totales</p>
                        <h5 class="card-title">{{$total_orders}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text text-sm">Dinero total</p>
                        <h5 class="card-title">{{$total_money}}€</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-12">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text fw-bold">Últimas reservas</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <x-welcome /> -->
</x-app-layout>
