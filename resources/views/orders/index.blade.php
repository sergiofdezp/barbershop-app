<x-app-layout>
    <div class="container pt-5">
        <h1>Reservas</h1>
        <hr>
        <div class="text-end pb-2">
            <a href="{{ route('orders.create')}}" class="btn btn-success" style="background-color: #11C163; border: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </a>
        </div>
        <table class="table text-center" id="orders_table" class="display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Hora</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Servicio</th>
                    <th scope="col" class="text-center">Precio</th>
                    <th scope="col" class="text-center">Estado del pago</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
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