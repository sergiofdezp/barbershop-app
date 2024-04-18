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
                    <div class="card-body">
                        <h5 class="card-title">Bienvenido, Admin</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-sm-6">
                <div class="card d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('orders.index')}}">Reservas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('orders.create')}}">Nueva reserva</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-sm-6">
                <div class="card d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('services.index')}}">Servicios</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card d-flex align-items-center text-center rounded">
                    <div class="card-body">
                        <a href="{{ route('services.create')}}">Nuevo servicio</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-sm-6">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text">Reservas totales</p>
                        <h5 class="card-title">0</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="card-text">Dinero total</p>
                        <h5 class="card-title">0€</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <x-welcome /> -->
</x-app-layout>
