@extends('layout.main')
@section('content')
    <div class="m-5 bg-light shadow">
        <div class="w-100 bg-secondary p-2 text-light">
            <h2> Stock </h2>
        </div>
        <div class="p-3 mt-2">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php
                    $nombres = [];
                    $cantidades = [];
                    ?>
                    @foreach ($stock as $item)
                        <?php
                        $nombres[] = $item->name;
                        $cantidades[] = $item->quantity;
                        ?>
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

            <button class="btn btn-primary"><a href={{ route('stock.create') }}
                    class="text-decoration-none text-light">Crear Stock</a></button>

        </div>


    </div>

    <div class="m-5 text-center d-flex justify-content-center align-items-center">
        <div class="w-50 bg-light d-flex align-items-center justify-content-center shadow">
            <canvas id="myPieChart" width="400" height="400"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const nombres = @json($nombres);
        const cantidades = @json($cantidades);

        // Crear el gráfico
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: nombres,
                datasets: [{
                    label: 'Cantidad',
                    data: cantidades,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                        // Puedes agregar más colores aquí si tienes más productos
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                        // Puedes agregar más colores aquí si tienes más productos
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: false,
                mantainAspectRatio: false,
                plugins: {
                    datalabels: {
                        color: '#fff', // Color del texto
                        formatter: (value, ctx) => {
                            let label = ctx.chart.data.labels[ctx.dataIndex];
                            return label + ': ' + value; // Formato: 'Nombre: Valor'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        display: false
                    }
                }
            }
        });
    </script>
@endsection
