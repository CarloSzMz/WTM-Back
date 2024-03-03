@extends('layout.main')
@section('content')
    <div class="container mt-4">
        <table class="table table-striped table-dark">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Nombre</th>
                <th>Desc</th>
                <th>Descuento</th>
                <th>Categoria</th>
                <th>Stock Actual</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->name }}</td>
                        <td>{{ $article->description }}</td>
                        <td>{{ $article->discount }}%</td>
                        <td>{{ $article->Categoria }}</td>
                        <td>{{ $article->Cantidad }}</td>

                        <td>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                <a class="btn" href="{{ route('articles.show', $article->id) }}">
                                    <i class="fas fa-eye text-success fa-lg"></i>
                                </a>
                                <a class="btn" href="{{ route('articles.edit', $article->id) }}">
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

        <button class="btn btn-info"><a href={{ route('articles.create') }}>Crear Articulo</a></button>


        <button class="btn btn-info"><a href={{ route('users.index') }}>Ver Usuarios</a></button>
    </div>
@endsection
