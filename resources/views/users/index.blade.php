@extends('layout.main')
@section('content')
    <style>
        @media only screen and (max-width: 961px) {
            #ordersByMonthChart {
                max-width: 250px;
                max-height: 500px;
            }
        }

        .dataTables_wrapper {
            margin-top: 20px;
            /* Agrega margen en la parte superior de los elementos de DataTables */
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }

        .dt-layout-row {
            padding-bottom: 20px;
        }

        .dt-length {
            display: none;
        }
    </style>
    <div>
        <div class="bg-light m-5 shadow">
            <div class="w-100 bg-secondary p-2 text-light">
                <h2> Usuarios </h2>
            </div>
            <div class="mt-2 p-3 table-responsive">
                <table class="table table-striped table-dark" id="userTable">
                    <thead class="thead-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
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
                    <button class="btn btn-primary float-end"><a href={{ route('users.create') }}
                            class="text-decoration-none text-light">Crear Usuario</a></button>

                </table>

            </div>


        </div>
    </div>
    <div class="bg-light m-5 shadow">
        <div class="w-100 bg-secondary p-2 text-light">
            <h2> Direcciones </h2>
        </div>
        <div class="mt-2 p-3 table-responsive">
            <table class="table table-striped table-dark" id="direccionestable">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Provincia</th>
                    <th>Calle</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->provincia }}</td>
                            <td>{{ $user->calle }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <!--DataTable Implementation-->
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                "paging": true,
                "pageLength": 7
            });
            $('#direccionestable').DataTable({
                "paging": true,
                "pageLength": 7
            });
        });
    </script>
@endsection
