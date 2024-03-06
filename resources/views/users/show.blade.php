@extends('layout.main')
@section('content')
    <div class="container mt-4">
        <div class="d-block mx-auto mb-2 mt-4">
            <h2> Página de {{ $user->name }} </h2>
            <h4>Email: {{ $user->email }}</h4>
            <h5>País: {{ $user->pais }}</h5>
            <h5>Provincia: {{ $user->provincia }}</h5>
            <h5>Calle: {{ $user->calle }}</h5>

            <!--Cesta-->

            <div class="container pb-2">
                <h3>Cesta:</h3>
                <div class="container p3">
                    <table class="table table-striped table-dark">
                        <thead class="thead-dark">
                            <th>Articulo</th>
                            <th>Cantidad</th>
                            <th>Precio total</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach ($basket as $producto)
                                <tr>
                                    <td> {{ $producto->NombreArticulo }}</td>
                                    <td> {{ $producto->quantity }}</td>
                                    <td> {{ $producto->total }}</td>
                                    <td>
                                        <form action="{{ route('basket.destroy', [$producto->id, $user->id]) }}" method="POST">
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
                    <button class="btn btn-info"><a href="{{ route('basket.create', $user->id) }}"
                            style="text-decoration: none">Añadir a la cesta</a></button>
                </div>
            </div>
            <button class="btn btn-dark"><a href="./">Volver</a></button>
        </div>
    </div>
@endsection
