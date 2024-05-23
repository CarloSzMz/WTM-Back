@extends('layout.main')
@section('content')
    <div class="m-5 bg-light">
        <div class="w-100 bg-secondary p-2 text-light">
            <h2> Descuentos </h2>
        </div>
        <div class="p-3 mt-2">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descuento</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($discounts as $discount)
                        <tr>
                            <td>{{ $discount->id }}</td>
                            <td>{{ $discount->name }}</td>
                            <td>{{ $discount->discount }}</td>
                            <td>{{ $discount->active }}</td>
                            <td>
                                <form action="{{ route('category.destroy', $discount->id) }}" method="POST">
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

            <button class="btn btn-primary"><a href={{ route('discount.create') }}
                    class="text-decoration-none text-light">Crear Descuento</a></button>

        </div>

    </div>
@endsection
