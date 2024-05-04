@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><span class="fw-bold">Reserva:</span> {{$order->order_ref}}</h1>
@stop
@section('content')
    <div class="container pt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-flex justify-content-center pt-5">
            <form action="{{ route('orders.update', $order->id) }}" id="form_update" class="col-10" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3" hidden>
                    <input type="text" name="total_price" id="total_price" class="form-control" value="{{$order->total_price}}">
                    <input type="text" name="is_online" id="is_online" class="form-control" value="{{$order->is_online}}">
                    <input type="text" name="order_status" id="order_status" class="form-control" value="{{$order->order_status}}">
                    <input type="text" name="user_id" id="user_id" value="{{$order->user_id}}" class="form-control">
                    <input type="text" name="order_ref" id="order_ref" value="{{$order->order_ref}}" class="form-control">
                </div>

                <!-- Informacion del cliente -->
                <h2>Información del cliente</h2>
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$order->name}}" placeholder="Introduce el nombre del cliente">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="phone" class="form-label">Teléfono de contacto</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{$order->phone}}" placeholder="Introduce el teléfono del cliente">
                        </div>
                    </div>
                </div>
    
                <!-- Información de la reserva -->
                <h2>Información de la reserva</h2>
                <div class="row gx-4 mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="order_date" class="form-label">Día de la reserva</label>
                            <input type="date" name="order_date" id="order_date" value="{{$order->order_date}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="order_hour" class="form-label">Hora de la reserva</label>
                            <select name="order_hour" id="order_hour" class="form-control">
                                @foreach ($hours as $hour)
                                    <option value="{{$hour->order_hour}}" @if($order->order_hour == $hour->order_hour)selected @endif>{{$hour->order_hour}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
    
                <div class="row gx-4">
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <label for="service_id" class="form-label">Servicio</label>
                            <select name="service_id" id="service_id" class="form-control">
                                @foreach ($services as $service)
                                    <option value="{{$service->id}}" @if($order->service_id == $service->id)selected @endif>{{$service->type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                </div>

                <!-- Información del pago -->
                <h2>Información del pago</h2>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay_status" id="flexRadioDefault1" value="0" @if($order->pay_status == 0)checked @endif>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Sin pagar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay_status" id="flexRadioDefault2" value="1" @if($order->pay_status == 1)checked @endif>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Pago realizado
                            </label>
                        </div>
                    </div>
                    <div class="col-6 mb-3 d-flex justify-content-end align-items-end bg-dark text-white rounded">
                        <div class="text-end">
                            <span class="total_price h1">0€</span>
                            <h5>Precio total</h5>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
@stop

@section('js')
    <script>
        $(document).ready(function(){
            // Ejecutamos la función nada más cargar la página para mostrar el precio del servicio elegido anteriormente.
            servicesPrices();
            // Volvemos a ejecutar la función si se decide editar el servicio y así obtener el precio del nuevo servicio.
            $('#service_id').click(function(){
                servicesPrices();
            });
            // Obtener los bloqueos de las horas que ya se han reservado.
            $('#order_date').change(function(){
                bloqueosHoras();
            });
        });

        /**
         * Esta función obtiene el precio del servicio que le enviamos al controlador.
         *
         * @return void
         */
        function servicesPrices(){
            var service_id = $('#service_id').val();
                
            $.ajax({
                type: "GET",
                url: "/services_prices",
                data: {
                    service_id : service_id,
                },
                dataType: "json",

                success: function(response){
                    // console.log(response)
                    $.each(response.services, function (key, item){
                        // console.log(item.price)
                        $('#total_price').val(item.price);
                        $('.total_price').text(item.price + '€');
                    });
                }
            });
        }

        /**
         * Esta función bloqueará las sesiones donde ya hay una reserva.
         *
         * @return void
         */
        function bloqueosHoras(){
            var order_date = $('#order_date').val();

            // Reiniciamos el estado del div, limpiamos el div (order_hours) para despues regenerarlo.
            var order_hours = '';
            document.getElementById('order_hours').innerHTML = order_hours;
                
            $.ajax({
                type: "GET",
                url: "/bloqueos_horas",
                data: {
                    order_date : order_date,
                },
                dataType: "json",

                success: function(response){
                    // Creamos el div donde generaremos el select.
                    order_hours = '<div class="border rounded p-3">'
                                    +'<label for="order_hour" class="form-label">Hora de la reserva</label>'
                                    +'<select name="order_hour" id="order_hour" class="form-control" required>'
                                        +'<option value="0" selected disabled>Selecciona una hora</option>'
                                    +'</select>'
                                +'</div>';
                    document.getElementById('order_hours').innerHTML += order_hours;

                    // Seleccionamos el select y recorriendo la respuesta del AJAX generaremos las options.
                    var select = document.getElementById('order_hour');

                    $.each(response.hours, function (key_h, hour){
                        var opt = document.createElement('option');
                        opt.value = hour.order_hour;
                        opt.innerHTML = hour.order_hour;

                        $.each(response.orders, function (key_o, order){
                            if(order.order_hour == hour.order_hour){
                                opt.disabled = true;
                                opt.innerHTML += ' - Reservada';
                            }
                        });

                        select.appendChild(opt);
                    });
                }
            });
        }
    </script>

@stop
