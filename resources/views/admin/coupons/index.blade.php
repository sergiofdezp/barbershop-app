@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cupones</h1>
@stop
@section('content')
    <div class="container pt-5">
        <div class="text-end pb-2">
            <a href="{{ route('coupons.create')}}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                                focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 no-underline">
                Nuevo cupón
            </a>
        </div>
        <table class="table" id="coupons_table" class="display">
            <thead>
                <tr>
                    <th scope="col" class="text-start">#</th>
                    <th scope="col" class="text-start">Código</th>
                    <th scope="col" class="text-start">Descuento</th>
                    <th scope="col" class="text-start">Fecha inicio</th>
                    <th scope="col" class="text-start">Fecha fin</th>
                    <th scope="col" class="text-start">Aplicado a</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                <tr>
                    <th scope="row" class="text-start">{{$coupon->id}}</th>
                    <td class="text-start">{{$coupon->code}}</td>
                    <td class="text-start">{{$coupon->discount}}%</td>
                    <td class="text-start">{{$coupon->start_date}}</td>
                    <td class="text-start">{{$coupon->end_date}}</td>
                    <td class="text-start">
                        @if($coupon->service == 0)
                            Todos los servicios
                        @elseif($coupon->service == 1)
                            Corte de pelo
                        @elseif($coupon->service == 2)
                            Arreglo de barba
                        @endif
                    </td>
                    <td class="">
                        <div class="flex justify-end">
                            <a href="{{ route('coupons.edit', $coupon->id)}}" class="inline-flex items-center px-4 py-2 bg-navy-600 border border-transparent rounded-md font-semibold
                                text-xs text-white uppercase tracking-widest hover:bg-navy-700 focus:bg-navy-700 active:bg-navy-900
                                focus:outline-none focus:ring-2 focus:ring-navy-500 focus:ring-offset-2 transition ease-in-out duration-150 no-underline">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
    <!-- Datatables -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

    <script>
        let table = new DataTable('#coupons_table', {
            responsive: true,
            language: {
                info: "Mostrando _START_ de _END_ de un total de _TOTAL_ registros.",
                zeroRecords: 'No se encontraron registros.',
                search: 'Buscar:',
                lengthMenu: 'Mostrando _MENU_ registros.',
                paginate: {
                    first: 'Primera pág.',
                    previous: 'Anterior',
                    next: 'Siguiente',
                    last: 'Última pág.'
                },
            },
        });
    </script>
@stop