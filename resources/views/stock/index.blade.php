@extends('layout.styles')

<div class="container mt-4">
    <table class="table table-striped table-dark">
        <thead class="thead-dark">
            <th>ID</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach ($stock as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <form action="{{ route('stock.destroy', $item->id) }}" method="POST">
                            <a class="btn" href="{{ route('stock.edit', $item->id) }}">
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

    <button class="btn btn-info"><a href={{ route('stock.create') }}>Crear Stock</a></button>


    <button class="btn btn-info"><a href={{ route('users.index') }}>Ver Usuarios</a></button>
</div>
