<x-app-layout>
    <div class="container pt-5">
        <h1>Nueva reserva</h1>
        <hr>
        <div class="d-flex justify-content-center pt-5">
            <form action="{{ route('orders.store') }}" id="form_store" class="col-10" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3" hidden>
                    <input type="text" name="total_price" id="total_price" class="form-control" value="0">
                    <input type="text" name="is_online" id="is_online" class="form-control" value="0">
                    <input type="text" name="order_status" id="order_status" class="form-control" value="0">
                    <input type="text" name="user_id" id="user_id" value="{{$user->id}}" class="form-control">
                    <input type="text" name="order_ref" id="order_ref" class="form-control">
                </div>

                <!-- Informacion del cliente -->
                <h2>Información del cliente</h2>
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Introduce el nombre del cliente">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="phone" class="form-label">Teléfono de contacto</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Introduce el teléfono del cliente">
                        </div>
                    </div>
                </div>
    
                <!-- Información de la reserva -->
                <h2>Información de la reserva</h2>
                <div class="row gx-4 mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="order_date" class="form-label">Día de la reserva</label>
                            <input type="date" name="order_date" id="order_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="order_hour" class="form-label">Hora de la reserva</label>
                            <select name="order_hour" id="order_hour" class="form-control">
                                <option value="0" selected disabled>Selecciona una hora</option>
                                @foreach ($hours as $hour)
                                    <option value="{{$hour->order_hour}}">{{$hour->order_hour}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
    
                <div class="row gx-4">
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <label for="service_id" class="form-label">Servicio</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="0" selected disabled>Selecciona un servicio</option>
                                @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                </div>

                <!-- Información del pago -->
                <h2>Información del pago</h2>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay_status" id="flexRadioDefault1" value="0" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Sin pagar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay_status" id="flexRadioDefault2" value="1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Pago realizado
                            </label>
                        </div>
                    </div>
                    <div class="col-6 mb-3 d-flex justify-content-end align-items-end bg-dark text-white rounded">
                        <div class="text-end">
                            <span class="total_price h1">0€</span>
                            <h5>Precio total</h5>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success" style="background-color: #13B807; border: none;">
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
        newOrderRef();
        $('#service_id').click(function(){
            servicesPrices();
        });
    });
    /**
     * Esta función obtiene el precio del servicio que le enviamos al controlador.
     *
     * @return void
     */
    function servicesPrices(){
        var service_id = $('#service_id').val();
            
        $.ajax({
            type: "GET",
            url: "/services_prices",
            data: {
                service_id : service_id,
            },
            dataType: "json",

            success: function(response){
                // console.log(response)
                $.each(response.services, function (key, item){
                    // console.log(item.price)
                    $('#total_price').val(item.price);
                    $('.total_price').text(item.price + '€');
                });
            }
        });
    }
    /**
     * Esta función genera una referencia única para la nueva reserva.
     *
     * @return void
     */
    function newOrderRef(){
        $.ajax({
            type: "GET",
            url: "/new_order_ref",
            dataType: "json",

            success: function(response){
                console.log(response.order_ref)
                $('#order_ref').val(response.order_ref);
            }
        });
    }
</script>