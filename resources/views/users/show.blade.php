@extends('layout.main')
@section('content')
    <div class="container mt-4">
        <div class="d-block mx-auto mb-2 mt-4 border border-1 bg-light">
            <div class="w-100 bg-secondary text-light p-2">
                <h2> Detalles de usuario </h2>
            </div>
            <div class="p-3">
                <h5>Nombre: {{ $user->name }} Apellidos: {{ $user->surname }} </h5>
                <h5>Email: {{ $user->email }}</h5>
                <h5>Provincia: {{ $user->provincia }}</h5>
                <h5>Calle: {{ $user->calle }}</h5>

                <hr style="color: black;">

                <!--Cesta-->

                <div class="container pb-2">
                    <div class="d-flex flex-row align-items-center">
                        <h3 style="padding-right: 10px">Cesta</h3>
                        <i class="gg-shopping-bag"></i>

                    </div>
                    <div class="container p3">
                        <table class="table table-striped table-dark">
                            <thead class="thead-dark">
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Precio total (€)</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($basket as $producto)
                                    <tr>
                                        <td> {{ $producto->NombreArticulo }}</td>
                                        <td> {{ $producto->quantity }}</td>
                                        <td> {{ $producto->total }}</td>
                                        <td>
                                            <form action="{{ route('basket.destroy', [$producto->id, $user->id]) }}"
                                                method="POST">
                                                <a class="btn" href="{{ route('basket.edit', $producto->id) }}">
                                                    <i class="fas fa-edit fa-lg text-primary"></i>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" type="submit">
                                                    <i class="fas fa-trash text-danger fa-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-info"><a href="{{ route('basket.create', $user->id) }}" class="text-decoration-none text-dark">Añadir a la cesta</a></button>
                        <button class="btn btn-info"><a href="{{ route('order.create', $user->id) }}" class="text-decoration-none text-dark">Crear Pedido</a></button>
                    </div>
                </div>

                <hr style="color: black;">

                <!--Pedidos-->

                <div class="container pb-2">
                    <div class="d-flex flex-row align-items-center">
                        <h3 style="margin-right: 10px">Pedidos</h3>
                        <i class="gg-notes"></i>
                    </div>
                    <div class="container p3">
                        <table class="table table-striped table-dark">
                            <thead class="thead-dark">
                                <th>Id_Pedido</th>
                                <th>Precio total (€)</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td> {{ $order->id }}</td>
                                        <td> {{ $order->total_price }}</td>
                                        @if ($order->status == 1)
                                            <td>Recibido</td>
                                        @else
                                            <td>Enviado</td>
                                        @endif
                                        <td>
                                            <a class="btn" href="{{ route('order.show', $order->id) }}">
                                                <i class="fas fa-eye text-success fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark p-2 mx-2 mb-2"><a href="{{route('users.index')}}" class="text-decoration-none text-light">Volver</a></button>
        </div>
    </div>
@endsection
