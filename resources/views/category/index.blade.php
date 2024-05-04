@extends('layout.main')
@section('content')
    <div class="m-5 bg-light">
        <div class="w-100 bg-secondary p-2 text-light">
            <h2> Categorías </h2>
        </div>
        <div class="p-3 mt-2">
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
    
            <button class="btn btn-primary"><a href={{ route('category.create') }} class="text-decoration-none text-light">Crear Categoria</a></button>
    
        </div>
   
    </div>
@endsection
