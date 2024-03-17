@extends('layout.styles')

<form action="{{ route('order.store') }}" method="POST">
    @csrf

    <div class="pl-2">
        <h1>Datos Envio:</h1>
        <h5>Nombre: {{ $user->name }}</h5>
        <input type="text" hidden name="user_id" value="{{ $user->id }}">
        <h5>Pais: {{ $user->pais }}</h5>
        <h5>Provincia: {{ $user->provincia }} </h5>
        <h5>Calle: {{ $user->calle }} </h5>
        <br>
        <hr><br>
        <h1>Datos pedido</h1>
        @php
            $basketjson = json_encode($basket);
        @endphp
        <input type="hidden" name="basket" value="{{ $basketjson }}"></input>
        @foreach ($basket as $item)
            <h5>Producto: {{ $item->NombreArticulo }} - Cantidad: {{ $item->quantity }} - Precio: {{ $item->total }}€
            </h5>
        @endforeach

        <h4>Precio total: {{ $total_price }}</h4>
        <input type="text" hidden name="total_price" value="{{ $total_price }}">

        <button class="btn" type="submit">Aceptar</button>

        <button class="btn"><a href="{{ route('users.index') }}"></a> Cancelar </button>

</form>

</div>
