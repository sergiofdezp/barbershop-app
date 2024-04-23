<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cupones') }}
        </h2>
    </x-slot>
    <div class="container pt-5">
        <div class="text-end pb-2">
            <a href="{{ route('coupons.create')}}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
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
                            <a href="{{ route('coupons.edit', $coupon->id)}}" class="btn btn-primary">
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
</x-app-layout>

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