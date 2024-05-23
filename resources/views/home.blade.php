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
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('/images/home/carrousel_1.jpg')}}" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-md-block">
                        <h5>Barbershop-app</h5>
                        <p>Bienvenido a este sistema desarrollado en PHP 8.1 y Laravel 10.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('/images/home/carrousel_2.jpg')}}" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-md-block">
                        <h5>Este sistema comprende todo lo necesario para gestionar el flujo de reservas de una barbería.</h5>
                        <p>Aquí podrás registrarte, crear tus reservas, editarlas, consultar su estado o cancelarlas.</p>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('user_orders') }}" class="text-decoration-none inline-flex items-center mx-2 px-2 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver mis reservas">
                                    Mis reservas
                                </a>
                                <a href="{{ route('front.create') }}" class="text-decoration-none inline-flex items-center px-2 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nueva reserva">
                                    Reservar
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-decoration-none inline-flex items-center mx-2 px-2 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Inicia sesión</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-decoration-none inline-flex items-center px-2 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                    text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                    focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Crea una cuenta</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('/images/home/carrousel_3.jpg')}}" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-md-block">
                        <h5>Otras posibilidades.</h5>
                        <p>Si dispones de un código de descuento, podrás aplicarlo siempre que esté destinado al servicio elegido y comprenda las fechas de validez del cupón.</p>
                        <p>También tienes tu propia tarjeta de fidelización, cuando completas 8 reservas, podrás utilizarla a la hora de crear la reserva y no pagarás nada.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>

    <script>
        // Implementación de tooltips para los btns
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
</html>
