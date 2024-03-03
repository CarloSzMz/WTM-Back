@extends('layout.styles')

<div class="container mt-4">
    <table class="table table-striped table-dark">
        <thead class="thead-dark">
            <th>ID</th>
            <th>Categoria</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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

    <button class="btn btn-info"><a href={{ route('category.create') }}>Crear Categoria</a></button>


    <button class="btn btn-info"><a href={{ route('users.index') }}>Ver Usuarios</a></button>
    <button class="btn btn-info"><a href={{ route('stock.index') }}>Ver Stock</a></button>

</div>
