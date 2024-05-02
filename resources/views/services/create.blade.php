@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo servicio</h1>
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
            <form action="{{ route('services.store') }}" id="form_store" class="" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Informacion del cliente -->
                <h2>Información del servicio</h2>
                <div class="row mb-4">
                    <div>
                        <div class="border rounded p-3">
                            <label for="type" class="form-label">Servicio</label>
                            <input type="text" name="type" id="type" class="form-control" placeholder="Introduce el nombre del servicio" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div>
                        <div class="border rounded p-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Introduce el precio del servicio" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div>
                        <div class="border rounded p-3">
                            <label for="image" class="form-label">Imagen</label>
                            <input name="image" class="form-control" id="image" type='file'>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar
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
@stop

@section('js')
    <script>   
        $(document).ready(function (e) {   
            $('#imagen').change(function(){            
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#imagenSeleccionada').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            });
        });
    </script>
@stop