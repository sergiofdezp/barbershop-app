@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><span class="fw-bold">Cupón:</span> {{$coupon->code}}</h1>
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
        <form action="{{ route('coupons.update', $coupon->id) }}" id="form_store" class="col-10" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3" hidden>
                
            </div>

            <!-- Informacion del cliente -->
            <h5>Información del cupón</h5>
            <hr>
            <div class="row mb-4">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="code" class="form-label">Código</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{$coupon->code}}" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 d-block d-sm-none d-flex justify-content-center align-items-end pt-2">
                    <input type="button" class="generar_cod inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold
                            text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 no-underline" id="" value="Generar código">
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6 d-flex align-items-end pt-2">
                    <input type="button" class="generar_cod d-none d-sm-block inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold
                            text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 no-underline" id="" value="Generar código">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="discount" class="form-label">Descuento</label>
                        <input type="number" name="discount" id="discount" class="form-control" value="{{$coupon->discount}}" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="service" class="form-label">Servicios</label>
                        <select name="service" id="service" class="form-control" required>
                            <option value="0">Todos los servicios</option>
                            @foreach ($services as $service)
                            <option value="{{$service->id}}" @if($coupon->service == $service->id)selected @endif>{{$service->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
            </div>

            <!-- Información de la reserva -->
            <h5>Información de fechas</h5>
            <hr>
            <div class="row gx-4 mb-4">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="start_date" class="form-label">Fecha de inicio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{$coupon->start_date}}" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="border rounded p-3">
                        <label for="end_date" class="form-label">Fecha de fin</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{$coupon->end_date}}" required>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold
                            text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 no-underline">
                    Guardar cambios
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
            $('.generar_cod').click(function(){
                genDiscountCode();
            });

            $('#submit_coupon').click(function(){
                checkCode();            
            });

            $('#code').mouseout(function(){
                checkCode();            
            });

            $('#code').focusout(function(){
                checkCode();            
            });

            /**
             * Genera un código de caracteres y números aleatorio y único
             *
             * @return void
             */
            function genDiscountCode(){
                $.ajax({
                    type: "GET",
                    url: "/new_discount_code",
                    dataType: "json",

                    success: function(response){
                        $('#code').val(response.coupon_code);

                        checkCode();  
                    }
                });
            }

            /**
             * Verifica si el código introducido manualmente ya existe en la bd, si existe muestra un msg de error.
             *
             * @return void
             */
            function checkCode(){
                var code = $('#code').val();
                $.ajax({
                    type: "GET",
                    url: "/verif_manual_code",
                    data: {
                        code : code,
                    },
                    dataType: "json",
        
                    success: function(response){
                        console.log(response.result)
                        if(response.result == 1){
                            $("#error-message").show();
                            $('#error-message').html('¡Este cupón ya existe! Por favor introduce otro código válido.');
                            $('#error-message').addClass('p-2');
                            $('#submit_coupon').prop("disabled", true);
                        } else{
                            $('#error-message').html('');
                            $('#error-message').removeClass('p-2');
                            $('#submit_coupon').prop("disabled", false);
                        }
                    }
                });
            }
        });
    </script>
@stop