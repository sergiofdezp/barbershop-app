@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nueva reserva</h1>
@stop

@section('content')
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
        <form action="{{ route('orders.store') }}" id="form_store" class="col-10" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3" hidden>
                <input type="text" name="total_price" id="total_price" class="form-control" value="0" required>
                <input type="text" name="is_online" id="is_online" class="form-control" value="0" required>
                <input type="text" name="order_status_id" id="order_status_id" class="form-control" value="1" required>
                <input type="text" name="user_id" id="user_id" value="{{$user->id}}" class="form-control" required>
                <input type="text" name="order_ref" id="order_ref" class="form-control" required>
                <input type="text" name="coupon_id" id="coupon_id" class="form-control">
            </div>

            <!-- Informacion del cliente -->
            <h5>Información del cliente</h5>
            <hr>
            <div class="row mb-4">
                <div class="col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Introduce el nombre del cliente" required>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="phone" class="form-label">Teléfono de contacto</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Introduce el teléfono del cliente" required>
                    </div>
                </div>
            </div>

            <!-- Información de la reserva -->
            <h5>Información de la reserva</h5>
            <hr>
            <div class="row gx-4 mb-4">
                <div class="col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="order_date" class="form-label">Día de la reserva</label>
                        <input type="date" name="order_date" id="order_date" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6" id="order_hours"></div>
            </div>

            <div class="row gx-4">
                <div class="col-sm-6 col-xs-6">
                    <div class="border rounded p-3 h-100">
                        <label for="service_id" class="form-label">Servicio</label>
                        <select name="service_id" id="service_id" class="form-control" required>
                            <option value="0" selected disabled>Selecciona un servicio</option>
                            @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-4">
                    <div class="border rounded p-3">
                        <div class="d-flex justify-content-between">
                            <div class="c-left">
                                <label for="discount" class="form-label">Cupón de descuento</label>
                            </div>
                            <div class="c-right d-none d-md-block d-lg-block">
                                <input type="button" class="aplicar_cod inline-flex items-center mb-1 px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                    text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                    focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    value="Aplicar cupón">
                            </div>
                        </div>
                        <input type="text" name="discount" id="discount" class="form-control" placeholder="Introduce un código de descuento">
                    </div>
                </div>

                <div class="col-xs-12 d-block d-sm-none d-flex justify-content-center pt-2">
                    <input type="button" class="aplicar_cod inline-flex items-center mb-1 px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                        text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                        focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        value="Aplicar cupón">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <p id="error-message" class="bg-danger text-white rounded mt-2"></p>
                </div>
            </div>

            <!-- Información del pago -->
            <h5>Información del pago</h5>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-xs-6 mb-3">
                    <div class="border rounded p-3">
                        <label for="">Estado del pago</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay_status" id="flexRadioDefault1" value="0" checked required>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Sin pagar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay_status" id="flexRadioDefault2" value="1" required>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Pago realizado
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6 mb-3 d-flex justify-content-end align-items-end bg-dark text-white rounded">
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
                    Guardar
                </button>
            </div>
        </form>
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
            newOrderRef();
            $('#service_id').change(function(){
                servicesPrices();
            });
            $('#order_date').change(function(){
                bloqueosHoras();
            });
            $('.aplicar_cod').click(function(){
                checkDiscountCode();
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
                        // Debemos resetear el input del código descuento al cambiar el servicio
                        $('#coupon_id').val("");
                    });
                }
            });
        }
        /**
         * Esta función genera una referencia única para la nueva reserva.
         *
         * @return void
         */
        function newOrderRef(){
            $.ajax({
                type: "GET",
                url: "/new_order_ref",
                dataType: "json",

                success: function(response){
                    $('#order_ref').val(response.order_ref);
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

        function checkDiscountCode(){
            $('#error-message').html('');
            $('#error-message').removeClass('p-2');

            var coupon_code = $('#discount').val();
            var service_id = $('#service_id').val();
            var total_price = $('#total_price').val();
            var order_date = $('#order_date').val();

            $.ajax({
                type: "GET",
                url: "/check_discount_code",
                data: {
                    coupon_code : coupon_code,
                    service_id : service_id,
                    order_date : order_date,
                },
                dataType: "json",

                success: function(response){
                    $("#error-message").show();
                    // Verificar que se ha elegido una fecha y un servicio
                    if(response.coupon == "noorderdate"){
                        $('#error-message').html('Debes elegir una fecha antes de aplicar un código.');
                        $('#error-message').addClass('p-2');
                    } else if(response.coupon == "noserviceid"){
                        $('#error-message').html('Debes elegir un servicio antes de aplicar un código.');
                        $('#error-message').addClass('p-2');
                    } else{
                        // Verificación de existencia de cupón
                        if(response.coupon == 0){
                            $('#error-message').html('¡Este cupón no existe! Por favor introduce un código válido.');
                            $('#error-message').addClass('p-2');

                            servicesPrices();
                        } else if(response.coupon == "noservice"){
                            $('#error-message').html('Este cupón no puede aplicarse a este servicio.');
                            $('#error-message').addClass('p-2');
                        } else if(response.coupon == "nodates"){
                            $('#error-message').html('Este cupón no puede aplicarse para esta fecha.');
                            $('#error-message').addClass('p-2');
                        } else{
                            $.each(response.coupon, function (key_c, coupon){
                                var discount_value = (total_price * coupon.discount) / 100;

                                final_price = total_price - discount_value;
            
                                $('#coupon_id').val(coupon.id);
                                $('#total_price').val(final_price);
                                $('.total_price').text(final_price + '€');
                            });
                        }
                    }
                }
            });
        }
    </script>
@stop