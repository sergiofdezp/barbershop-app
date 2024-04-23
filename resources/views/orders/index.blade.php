<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservas') }}
        </h2>
    </x-slot>
    <div class="container pt-5">
        <div class="text-end pb-2">
            <a href="{{ route('orders.create')}}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </a>
        </div>
        <table class="table text-center" id="orders_table" class="display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-center">Referencia</th>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Hora</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Servicio</th>
                    <th scope="col" class="text-center">Precio</th>
                    <th scope="col" class="text-center">Estado del pago</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td class="text-center">{{$order->order_ref}}</td>
                    <td class="text-center">{{$order->order_date}}</td>
                    <td class="text-center">{{$order->order_hour}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->service->type}}</td>
                    <td class="text-center">{{$order->total_price}}€</td>
                    <td>
                        @if($order->pay_status == 0) Pendiente

                        @elseif($order->pay_status == 1) Pagado

                        @endif
                    </td>
                    <td class="">
                        <div class="flex justify-end">
                            <a href="{{ route('orders.show', $order->id)}}" class="btn btn-dark btn-sm mx-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </a>
                            <a href="{{ route('orders.edit', $order->id)}}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<!-- Datatables -->
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<script>
    let table = new DataTable('#orders_table', {
        responsive: true,
        language: {
            info: "Mostrando _START_ de _END_ de un total de _TOTAL_ registros.",
            zeroRecords: 'No se encontraron registros.',
            search: 'Buscar:',
            lengthMenu: 'Mostrando _MENU_ registros.',
            paginate: {
                first: 'Primera pág.',
                previous: 'Anterior',
                next: 'Siguiente',
                last: 'Última pág.'
            },
        },
    });

    document.body.onload = function() {
        order_status();
    }

    // esta funcion colorea de diferentes colores dependiendo del estado de la reserva
    function order_status(){
        var element = document.getElementsByClassName("order_status");

        for(var i = 0; i < element.length; i++){
            if(element[i].outerText == 'Cancelada')
                element[i].classList.add('cancelada');
        }
    }
</script>