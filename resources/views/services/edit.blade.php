@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><span class="fw-bold">Servicio:</span> {{$service->type}}</h1>
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
            <form action="{{ route('services.update', $service->id) }}" id="form_store" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informacion del cliente -->
                <h2>Información del servicio</h2>
                <div class="row mb-4">
                    <div>
                        <div class="border rounded p-3">
                            <label for="type" class="form-label">Servicio</label>
                            <input type="text" name="type" id="type" class="form-control" value="{{$service->type}}" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div>
                        <div class="border rounded p-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{$service->price}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <!-- IMAGEN -->
                        <label for="imagen" class="block text-base font-medium text-[#07074D]">Imagen</label>
                        <div class="">
                            <img src="/images/services/{{ $service->image }}" id="imagenSeleccionada" style="max-height: 150px;" class="mx-auto d-block">
                        </div>
                        <div class="mb-4">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Imagen</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-2 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group' style="border-color: #6875F5;">
                                    <div class='flex flex-col items-center justify-center pt-7'>
                                    <svg class="w-10 h-10" style="color: #6875F5;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class='text-sm text-gray-400 pt-1 tracking-wider'>Seleccionar nueva imagen</p>
                                    </div>
                                <input name="imagen" id="imagen" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold
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