@extends('layout.main')
@section('content')
    <div class="m-5 bg-light">
        <div class="w-100 bg-secondary p-2 text-light">
            <h2> Artículos </h2>
        </div>
        <div class="p-3 mt-2">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Desc</th>
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
    
            <button class="btn btn-primary"><a href={{ route('articles.create') }} class="text-decoration-none text-light">Crear Articulo</a></button>
    
        </div>
    
    </div>
@endsection
