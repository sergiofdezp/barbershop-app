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
                    <button type="submit" class='btn btn-success'>Añadir reserva</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function(){
        $('#service_id').click(function(){
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
                        $('#total_price').val(item.price)
                        $('.total_price').text(item.price + '€');
                    });
                }
            });
        });
    });
</script>