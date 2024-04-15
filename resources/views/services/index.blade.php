<x-app-layout>
    <div class="container pt-5">
        <h1>Servicios</h1>
        <hr>
        <div class="row">
            @foreach ($services as $service)
            <div class="col-sm-6">
                <div class="card d-flex align-items-center text-center rounded">
                    <img src="{{asset('/images/' . $service->type . '.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$service->type}}</h5>
                        <p class="card-text">Precio: {{$service->price}}€</p>
                        <a href="#" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>