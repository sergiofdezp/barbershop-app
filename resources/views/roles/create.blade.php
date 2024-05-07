@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de roles</h1>
@stop

@section('content')
    <div class="container d-flex justify-content-center pt-5">
        <form action="{{ route('roles.store') }}" id="form_store" class="row" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-4">
                <div>
                    <div class="border rounded p-3">
                        <label for="name" class="form-label">Rol</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Introduce el nombre del rol" required>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div>
                    <div class="border rounded p-3">
                        <label class="form-label">Permisos</label>
                        <p class="text-muted text-sm">Selecciona los permisos que tendrá el nuevo rol.</p>
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input id="permission_{{$permission->id}}" class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->id}}">
                                <label for="permission_{{$permission->id}}" class="form-check-label">{{ $permission->description }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="text-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar
                    </button>
                </div>
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
@stop

@section('js')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stop