<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo cupón') }}
        </h2>
    </x-slot>
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
        <!-- <?php // phpinfo(); ?> -->
        <div class="d-flex justify-content-center pt-5">
            <form action="{{ route('coupons.store') }}" id="form_store" class="col-10" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Informacion del cliente -->
                <h2>Información del cupón</h2>
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="code" class="form-label">Código</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Introduce o genera un código" required>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-end">
                        <input type="button" class="btn btn-success" id="generar_cod" value="Generar código">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <p id="error-message" class="bg-danger text-white rounded"></p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="discount" class="form-label">Descuento</label>
                            <input type="number" name="discount" id="discount" class="form-control" placeholder="Introduce el descuento" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="service" class="form-label">Servicios</label>
                            <select name="service" id="service" class="form-control" required>
                                <option value="0" selected>Todos los servicios</option>
                                @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                </div>
    
                <!-- Información de la reserva -->
                <h2>Información de fechas</h2>
                <div class="row gx-4 mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="start_date" class="form-label">Fecha de inicio</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="end_date" class="form-label">Fecha de fin</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" id="submit_coupon" class="btn btn-success" style="background-color: #13B807; border: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                            <path d="M11 2H9v3h2z"/>
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function(){
        $('#generar_cod').click(function(){
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