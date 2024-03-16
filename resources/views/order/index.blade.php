@extends('layout.main')
@section('content')
    <div>
        <div class="container mt-5">
            <table class="table table-striped table-dark pb-5">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>User</th>
                    <th>Total_price</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->NombreUsuario }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>
                                <form action="" method="POST">
                                    <a class="btn" href="">
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

            <button class="btn btn-info"><a href={{ route('users.index') }} class="text-decoration-none text-dark">Ver
                    Usuarios</a></button> 
            <button class="btn btn-info"><a href={{ route('stock.index') }} class="text-decoration-none text-dark">Ver
                    Stock</a></button>
            <button class="btn btn-info"><a href={{ route('category.index') }} class="text-decoration-none text-dark">Ver
                    Categoria</a></button>
            <button class="btn btn-info"><a href={{ route('article.index') }} class="text-decoration-none text-dark">Ver
                    Articulos</a></button>

        </div>
    </div>
@endsection