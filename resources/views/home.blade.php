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
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="row">
                @if (Route::has('login'))
                    @auth
                        <section>
                            <a href="{{ route('user_orders') }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mis reservas">
                                Mis reservas
                            </a>
                        </section>

                        <section id="new_order" class="border-dark rounded p-3 bg-dark">
                            <div class="row">
                                <h5 class="h5 text-white">Crea tu nueva reserva</h5>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Introduce tu nombre" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Introduce tu telefono" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="h5 text-white">Elige tu servicio</h5>
                            </div>
                            <div class="row d-flex justify-content-center mb-2">
                                @foreach ($services as $service)
                                <div class="card-container d-flex justify-content-center col-4 p-0">
                                    <div class="card">
                                        <div class="card__image" id="card-1">
                                            <div class="image-overlay"></div>
                                            <img src="{{ asset('/images/services/' . $service->image) }}" alt="" />
                                        </div>
    
                                        <div class="card-body text-center">
                                            <p class="card-text">{{ $service->type }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <h5 class="h5 text-white">Elige la fecha y la hora</h5>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="">
                                        <input type="date" name="order_date" id="order_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6" id="order_hours">
                                    <div class="">
                                        <select name="order_hour" id="order_hour" class="form-control" required disabled>
                                            <option value="0" selected disabled>Selecciona primero un día</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="h5 text-white">¿Tienes un cupón de descuento?</h5>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="c-left w-100">
                                                <input type="text" name="discount" id="discount" class="form-control" placeholder="Introduce un código de descuento">
                                            </div>
                                            <div class="c-right d-none d-md-block d-lg-block px-1">
                                                <input type="button" class="aplicar_cod inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                                    text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                                    focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                    value="Aplicar cupón">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                    <div class="col-12 d-flex justify-content-between align-items-center border rounded text-white p-2">
                                        <div class="">
                                            <h5 class="mb-0">Precio total</h5>    
                                        </div>
                                        <div class="">    
                                            <span class="total_price h1">0€</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </section>

                    @else
                        <section>
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Inicia sesión
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-azure-500 border border-transparent rounded-md font-semibold
                                    text-xs text-white uppercase tracking-widest hover:bg-azure-700 focus:bg-azure-700 active:bg-azure-900
                                    focus:outline-none focus:ring-2 focus:ring-azure-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Crea una cuenta
                                </a>
                            @endif
                        </section>
                    @endauth
                @endif
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>

    <script>
        $(document).ready(function(){
            $('#order_date').change(function(){
                bloqueosHoras();
            });
        });

        // Implementación de tooltips para los btns
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Obtén todas las elementos con la clase 'card'
        var services = document.querySelectorAll('.card');

        // Itera sobre cada elemento y añade un event listener para 'click'
        services.forEach(function(card) {
            card.addEventListener('click', function() {
                // Obtenemos el elemento que tiene la clase actualmente
                var currentChecked = document.querySelector('.is-checked');
                
                // Si el elemento clicado ahora no es el mismo que el de antes se le quita la clase al anterior
                if (currentChecked && currentChecked !== this) {
                    currentChecked.classList.remove('is-checked');
                }
                
                // Alternar la clase en el elemento clicado
                if (this.classList.contains('is-checked')) {
                    this.classList.remove('is-checked');
                } else {
                    this.classList.add('is-checked');
                }
            });
        });

                /**
         * Esta función bloqueará las sesiones donde ya hay una reserva.
         *
         * @return void
         */
        function bloqueosHoras(){
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
    </script>
</html>