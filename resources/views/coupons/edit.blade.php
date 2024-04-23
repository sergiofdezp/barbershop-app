<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar cupón') }}
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
        <div class="d-flex justify-content-center pt-5">
            <form action="{{ route('coupons.update', $coupon->id) }}" id="form_store" class="col-10" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3" hidden>
                    
                </div>

                <!-- Informacion del cliente -->
                <h2>Información del cupón</h2>
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="code" class="form-label">Código</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{$coupon->code}}" required>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-end">
                            <button class="btn btn-success">Generar código</button>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="discount" class="form-label">Descuento</label>
                            <input type="number" name="discount" id="discount" class="form-control" value="{{$coupon->discount}}" required>
                        </div>
                    </div>
                    <div class="col-6">
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
                <h2>Información de fechas</h2>
                <div class="row gx-4 mb-4">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="start_date" class="form-label">Fecha de inicio</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{$coupon->start_date}}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <label for="end_date" class="form-label">Fecha de fin</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{$coupon->end_date}}" required>
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

    });
</script>