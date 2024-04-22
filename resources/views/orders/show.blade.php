<x-app-layout>
    <div class="container pt-5">
        <div class="row">
            <div class="d-flex justify-content-between align-items-end">
                <h1>Visualización de reserva</h1>
                <p><span class="fw-bold">Referencia:</span> {{$order->order_ref}}</p>
            </div>
        </div>
        <hr>
        <div class="row pb-3">
            <div class="text-end">
                <a href="{{ route('orders.edit', $order->id)}}" class="btn btn-success" style="background-color: #2019FF; border: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="row border p-4">
            <div class="col-6">
                <h5>Detalles de la reserva</h5>
                <hr>
                <p class="fw-bold">Servicio: <span class="fw-normal">{{$order->service->type}}.</span></p>
                <p class="fw-bold">Día de la reserva: <span class="fw-normal">{{$order->order_date}}.</span></p>
                <p class="fw-bold">Hora de la reserva: <span class="fw-normal">{{$order->order_hour}}h.</span></p>
                <p class="fw-bold">Estado de la reserva: 
                    <span class="fw-normal">
                        @if($order->order_status == 0) Próxima.

                        @elseif($order->order_status == 1) Terminada.

                        @elseif($order->order_status == 2) Cancelada.

                        @elseif($order->order_status == 3) No asistida.

                        @endif
                    </span>
                </p>
            </div>
            <div class="col-6">
                <h5>Detalles del cliente</h5>
                <hr>
                <p class="fw-bold">Nombre del cliente: <span class="fw-normal">{{$order->name}}.</span></p>
                <p class="fw-bold">Teléfono del cliente: <span class="fw-normal">{{$order->phone}}.</span></p>
            </div>
        </div>

        <div class="row border p-4 mt-3">
            <div class="col-6">
                <h5>Otros detalles</h5>
                <hr>
                <p class="fw-bold">Usuario que ha realizado la reserva: <span class="fw-normal">{{$order->user->name}}.</span></p>
                <p class="fw-bold">Lugar de reserva:
                    <span class="fw-normal">
                        @if($order->is_online == 0) Barbería.
    
                        @elseif($order->pay_status == 1) Web.
    
                        @endif
                    </span>
                </p>
                <p class="fw-bold">Fecha de creación de la reserva: <span class="fw-normal">{{$order->created_at}}.</span></p>
                <p class="fw-bold">Última actualización: <span class="fw-normal">{{$order->updated_at}}.</span></p>
                <p class="fw-bold">Cupón de descuento: <span class="fw-normal">{{$order->coupon->code}}.</span></p>
            </div>
            <div class="col-6">
                <h5>Detalles del pago</h5>
                <hr>
                <p class="fw-bold">Precio total: <span class="fw-normal">{{$order->total_price}}€.</span></p>
                <p class="fw-bold">Estado del pago:
                    <span class="fw-normal">
                        @if($order->pay_status == 0) Pendiente.
    
                        @elseif($order->pay_status == 1) Pagado.
    
                        @endif
                    </span>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>