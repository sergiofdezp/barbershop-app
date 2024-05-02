@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Servicios</h1>
@stop

@section('content')
    <div class="container pt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <div class="text-end pb-2">
                    <a href="{{ route('services.create')}}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Nuevo servicio
                    </a>
                </div>
            </div>
        </div>
        @foreach ($services as $service)
        <div class="row d-flex justify-content-center pt-3">
            <div class="col-sm-6">
                <div class="card service-hover d-flex align-items-center text-center rounded">
                    <td>
                        <img src="{{asset('/images/services/' . $service->image)}}" class="card-img-top" alt="...">
                    </td>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">{{$service->type}}</h5>
                        <p class="card-text">Precio: {{$service->price}}€</p>
                        <a href="{{ route('services.edit', $service->id)}}" class="inline-flex items-center px-4 py-2 bg-navy-600 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-navy-700 focus:bg-navy-700 active:bg-navy-900
                                focus:outline-none focus:ring-2 focus:ring-navy-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Editar servicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
@stop

@section('js')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stop
