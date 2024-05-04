@extends('layout.main')
@section('content')
    <div>
        <div class="bg-light m-5">
            <div class="w-100 bg-secondary p-2 text-light">
                <h2>Pedidos</h2>
            </div>
            <div class="container p-3">
                <table class="table table-striped table-dark pb-5">
                    <thead class="thead-dark">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Precio Total (€)</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->NombreUsuario }}</td>
                                <td>{{ $order->total_price }}</td>
                                @if ($order->status == 1)
                                    <td>Recibido</td>
                                @else
                                    <td>Enviado</td>
                                @endif
                                <td>
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                        <a class="btn" href="{{ route('order.show', $order->id) }}">
                                            <i class="fas fa-eye text-success fa-lg"></i>
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
            </div>


        </div>
    </div>
@endsection
