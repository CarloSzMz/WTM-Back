@extends('layout.main')
@section('content')
    <div>
        <div class="container mt-5">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Provincia</th>
                    <th>Calle</th>
                    <th>Tipo</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->provincia }}</td>
                            <td>{{ $user->calle }}</td>
                            @if ($user->tipo == 0)
                                <td>normal</td>
                            @else
                                <td>admin</td>
                            @endif
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    <a class="btn" href="{{ route('users.show', $user->id) }}">
                                        <i class="fas fa-eye text-success fa-lg"></i>
                                    </a>
                                    <a class="btn" href="{{ route('users.edit', $user->id) }}">
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

            <button class="btn btn-secondary"><a href={{ route('users.create') }}
                    class="text-decoration-none text-light">Crear
                    Usuario</a></button>

        </div>
    </div>
@endsection
