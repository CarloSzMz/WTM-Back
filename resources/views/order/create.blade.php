@extends('layout.main')
@section('content')
    <div class="container bg-secondary-subtle rounded p-4">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <div class="container">
                <img src="{{ asset('assets/img/logos/logo_black.png') }}" alt="" width="150px" class="float-end">
                <h3>Datos de envío:</h3>
                <h5>Nombre: {{ $user->name }} {{$user->surname}}</h5>
                <input type="text" hidden name="user_id" value="{{ $user->id }}">
                <h5>Provincia: {{ $user->provincia }} </h5>
                <h5>Calle: {{ $user->calle }} </h5>
                <br>
                <hr><br>
                <h3>Datos pedido</h3>
                <br>
                @php
                    $basketjson = json_encode($basket);
                @endphp
                <input type="hidden" name="basket" value="{{ $basketjson }}"></input>
                <div class="table-responisve">
                    <table class="table table-striped table-hover  align-middle">
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        @foreach ($basket as $item)
                            <tr>
                                <td>{{ $item->NombreArticulo }} </td>
                                <td>{{ $item->quantity }}</td>
                                <td> {{ $item->total }}€</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <h4 class="float-end">Precio total: {{ $total_price }}€</h4>
                <input type="text" hidden name="total_price" value="{{ $total_price }}">
                <br>
                <button class="btn btn-success" type="submit">Aceptar</button>
                <button class="btn btn-danger"><a href="{{ route('users.index') }}"></a>Cancelar</button>
        </form>
    </div>
@endsection
