<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        <link rel="stylesheet" href="{{ asset('/scss/home.css') }}">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container-fluid container-img d-flex justify-content-center align-items-center">
            <section id="new_order" class="border-dark rounded p-3 bg-dark">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="error d-flex flex-row justify-content-center">
                        <div class="col-12">
                            <p class="bg-danger text-white rounded p-2"> {{ session('error') }} </p>
                        </div>
                    </div>

                    {!! session()->forget('error') !!}
                @endif

                <div class="row">
                    <div class="col-xs-12">
                        <p id="error-message" class="bg-danger text-white rounded mt-2"></p>
                    </div>
                </div>
                    
                <form action="{{ route('front.orders.store') }}" id="form_store" class="col-12" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3" hidden>
                        <input type="text" name="service_id" id="service_id" value="0" class="form-control" required>
                        <input type="text" name="total_price" id="total_price" class="form-control" value="0" required>
                        <input type="text" name="coupon_id" id="coupon_id" class="form-control">
                    </div>

                    <div class="row">
                        <h5 class="h5 text-white">Crea tu nueva reserva</h5>
                    </div>

                    <hr class="border">

                    <div class="row">
                        <h5 class="h5 text-white">Tus datos</h5>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6 col-xs-6">
                            <div class="">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6 mt-2 mt-lg-0 mt-md-0 mt-sm-0">
                            <div class="">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Teléfono" required>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-3">
                        <h5 class="h5 text-white">Elige tu servicio</h5>
                    </div>
                    <div class="row d-flex justify-content-center mb-2">
                        @foreach ($services as $service)
                        <div class="card-container d-flex justify-content-center col-4 p-1 p-lg-0 p-md-0 p-sm-0">
                            <div class="card" value="{{ $service->id }}">
                                <div class="card__image" id="card-1">
                                    <div class="image-overlay"></div>
                                    <img src="{{ asset('/images/services/' . $service->image) }}" class="service_img" alt="service_image"/>
                                </div>

                                <div class="card-body text-center">
                                    <p class="card-text">{{ $service->type }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row pt-3">
                        <h5 class="h5 text-white">Elige la fecha y la hora</h5>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6 col-xs-6">
                            <div class="">
                                <input type="date" name="order_date" id="order_date" min="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6 col-xs-6 mt-2 mt-lg-0 mt-md-0 mt-sm-0" id="order_hours">
                            <div class="">
                                <select name="order_hour" id="order_hour" class="form-control" required disabled>
                                    <option value="0" selected disabled>Selecciona un día</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-3">
                        <h5 class="h5 text-white">¿Tienes un cupón de descuento?</h5>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <input type="text" name="discount" id="discount" class="form-control" placeholder="Introduce un código">
                                </div>
                                <div class="col-12 d-flex justify-content-end pt-2">
                                    <input type="button" class="aplicar_cod inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                        text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                        focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        value="Aplicar cupón">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-3 pb-2">
                        <div class="col-12 text-white">
                            <div id="show_prices" class="border rounded p-2">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h5 class="mb-0">Precio total</h5>
                                   
                                    <span id="show_total_price" class="h1 mb-0">0€</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="text-end">
                            <a href="/" class="inline-flex text-decoration-none items-center px-2 py-2 bg-red-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900
                                focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Volver atrás
                            </a>

                            <button type="submit" class="inline-flex items-center px-2 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>

    <script>
        $(document).ready(function(){
            $('#order_date').change(function(){
                block_hours();
            });

            $('.aplicar_cod').click(function(){
                check_discount_code();
            });
        });

        // Obtén todos las elementos con la clase 'card'
        var services = document.querySelectorAll('.card');
        var service_id = document.getElementById('service_id');

        // Itera sobre cada elemento y añade un event listener para 'click'
        services.forEach(function(card) {
            card.addEventListener('click', function() {
                // Obtenemos el elemento que tiene la clase actualmente
                var currentChecked = document.querySelector('.service-checked');
                
                // Si el elemento clicado ahora no es el mismo que el de antes se le quita la clase al anterior
                if (currentChecked && currentChecked !== this) {
                    currentChecked.classList.remove('service-checked');
                }
                
                // Alternar la clase en el elemento clicado
                if (this.classList.contains('service-checked')) {
                    this.classList.remove('service-checked');

                    // El elemento se deselecciona por lo tanto debemos mostrar el precio como 0.
                    var price_zero = document.getElementById('show_total_price');
                    price_zero.innerHTML = "0€";
                } else {
                    this.classList.add('service-checked');

                    var selected_service = document.getElementsByClassName('service-checked');

                    for (let i = 0; i < selected_service.length; i++) {
                        service_id.value = selected_service[i].attributes.value.value;
                        selected_service_id = service_id.value;
                    }

                    total_price(selected_service_id);
                }
            });
        });

        /**
         * Esta función bloqueará las sesiones donde ya hay una reserva.
         *
         * @return void
         */
         function block_hours(){
            var order_date = $('#order_date').val();
            var order_hours = '';
                
            $.ajax({
                type: "GET",
                url: "/bloqueos_horas",
                data: {
                    order_date : order_date,
                },
                dataType: "json",

                success: function(response){
                    console.log(response)
                    // Creamos el div donde generaremos el select.
                    order_hours += '<option value="0" selected disabled>Selecciona una hora</option>';

                    document.getElementById('order_hour').innerHTML = order_hours;
                    document.getElementById('order_hour').disabled = false;

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
        };

        function total_price(selected_service_id){                
            $.ajax({
                type: "GET",
                url: "/services_prices",
                data: {
                    service_id : selected_service_id,
                },
                dataType: "json",

                success: function(response){
                    // console.log(response)
                    $.each(response.services, function (key, item){
                        // console.log(item.price)
                        $('#show_total_price').text(item.price + '€');
                        $('#total_price').val(item.price);
                        // Debemos resetear el input del código descuento al cambiar el servicio
                        $('#coupon_id').val("");
                    });
                }
            });
        }

        // Verificaciones de codigo de descuento
        function check_discount_code(){
            var coupon_code = $('#discount').val();
            var service_id = $('#service_id').val();
            var total_price = $('#total_price').val();
            var order_date = $('#order_date').val();

            // Limpiamos el mensaje de error
            $('#error-message').html('');
            $('#error-message').removeClass('p-2');

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

                                let list =
                                    '<div class="d-flex flex-row justify-content-between align-items-center">' +
                                        '<p class="mb-0">Precio sin descuento</p>' +
                                        '<span>' + total_price + '€</span>' +
                                    '</div>' +

                                    '<div class="d-flex flex-row justify-content-between align-items-center">' +
                                        '<p class="mb-0">Descuento</p>' +
                                        '<span>-' + discount_value + '€</span>' +
                                    '</div>' +

                                    '<hr>' +

                                    '<div class="d-flex flex-row justify-content-between align-items-center">' +
                                        '<h5 class="mb-0">Precio final</h5>' +
                                        '<span id="show_total_price" class="h1">' + final_price + '€</span>' +
                                    '</div>'

                                $('#show_prices').html(list)
                            });
                        }
                    }
                }
            });
        }
    </script>
</html>