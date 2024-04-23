<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo servicio') }}
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