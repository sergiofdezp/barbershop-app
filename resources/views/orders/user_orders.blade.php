<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis reservas') }}
        </h2>
    </x-slot>
    <div class="container pt-5">
        @foreach ($orders as $order)
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
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('orders.show', $order->id)}}" class="card-title btn btn-dark btn-sm" style="background-color: #33BEFF; border: none;">
                                    Referencia: {{$order->order_ref}}
                                </a>
                                @if($order->order_status == 0)
                                    <p class="card-title btn btn-dark btn-sm" style="background-color: #33BEFF; border: none;">Próxima</p>
                                @elseif($order->order_status == 1)
                                    <p class="card-title btn btn-dark btn-sm" style="background-color: #72CA34; border: none;">Terminada</p>
                                @elseif($order->order_status == 2)
                                    <p class="card-title btn btn-dark btn-sm" style="background-color: #EC3431; border: none;">Cancelada</p>
                                @elseif($order->order_status == 3)
                                    <p class="card-title btn btn-dark btn-sm" style="background-color: #A9A9A9; border: none;">No asistida</p>
                                @endif
                            </div>
                            <p class="card-text m-0">Fecha de la reserva: {{$order->order_date}} | {{$order->order_hour}}h.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>