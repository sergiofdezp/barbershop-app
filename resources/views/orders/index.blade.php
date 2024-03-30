<x-app-layout>
    <div class="container pt-5">
        <table class="table text-center" id="orders_table" class="display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Hora</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Servicio</th>
                    <th scope="col" class="text-center">Lugar de reserva</th>
                    <th scope="col" class="text-center">Estado de la reserva</th>
                    <th scope="col" class="text-center">Precio</th>
                    <th scope="col" class="text-center">Estado del pago</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($orders as $order)
                <tr>
                    <th scope="row">1</th>
                    <td class="text-center">{{$order->order_date}}</td>
                    <td class="text-center">{{$order->order_session}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->service->type}}</td>
                    <td>
                        @if($order->is_online == 0) Barbería 

                        @else Web
                        
                        @endif
                    </td>
                    <td class="order_status rounded" value="{{$order->order_status}}">
                        @if($order->order_status == 0) Próxima

                        @elseif($order->order_status == 1) Terminada

                        @elseif($order->order_status == 2) Cancelada

                        @elseif($order->order_status == 3) No asistido

                        @endif
                    </td>
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