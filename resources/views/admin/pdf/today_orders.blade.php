<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
    <body>
        <h2>Reservas para hoy - <span>{{$today}}</span></h2>

        <table style="width: 100%; text-align: center;">
            <tr>
                <th>Hora de la reserva</th>
                <th>Servicio</th>
                <th>Cliente</th>
                <th>Estado del pago</th>
            </tr>
            @foreach($today_orders as $order)
                <tr>
                    <td>{{$order->order_hour}}</td>
                    <td>
                        @if($order->service_id == 1)
                            Corte de pelo
                        @elseif($order->service_id == 2)
                            Arreglo de barba
                        @else
                            Servicio sin determinar
                        @endif
                    </td>
                    <td>{{$order->name}}</td>
                    <td>
                        @if($order->pay_status == 0) Pendiente

                        @elseif($order->pay_status == 1) Pagado

                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </body>
</html>