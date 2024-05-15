@extends('layout.main')
@section('content')
    <style>
        @media only screen and (max-width: 961px) {
            #ordersByMonthChart {
                max-width: 250px;
                max-height: 500px;
            }
        }

        <style>.dataTables_wrapper {
            margin-top: 20px;
            /* Agrega margen en la parte superior de los elementos de DataTables */
        }
    </style>
    </style>
    <div>
        <div class="d-flex flex-row w-100 align-items-center justify-between">
            <div class="m-5 d-flex justify-content-center align-items-center">
                <div class="bg-light shadow" style="max-width: 400px">
                    <div class="w-100 bg-secondary p-2 text-light">
                        <h2>Beneficio Anual </h2>
                    </div>
                    <div class="p-3 mt-2">
                        <canvas id="ordersByYearChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="m-5 d-flex justify-content-center align-items-center">
                <div class="bg-light shadow" style="max-width: 400px">
                    <div class="w-100 bg-secondary p-2 text-light">
                        <h2>Beneficio Trimestral 2024 </h2>
                    </div>
                    <div class="p-3 mt-2">
                        <canvas id="ordersByQuarterChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="m-5 d-flex justify-content-center align-items-center">
                <div class="bg-light shadow" style="max-width: 400px">
                    <div class="w-100 bg-secondary p-2 text-light">
                        <h2>Beneficio mensual 2024 </h2>
                    </div>
                    <div class="p-3 mt-2">
                        <canvas id="ordersByMonthChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!--Grafico-->


        <!--Tabla-->
        <div class="bg-light m-5 shadow">
            <div class="w-100 bg-secondary p-2 text-light">
                <h2>Pedidos</h2>
            </div>
            <div class="container p-3">
                <table class="table table-striped table-dark p-5 text-center" id="myTable">
                    <thead class="thead-dark">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Precio Total (€)</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @php
                            // Creamos un array con los nombres de todos los meses
                            $allMonths = [
                                'January',
                                'February',
                                'March',
                                'April',
                                'May',
                                'June',
                                'July',
                                'August',
                                'September',
                                'October',
                                'November',
                                'December',
                            ];
                            // Inicializamos un array para almacenar los totales por mes
                            $totalsByMonth = array_fill_keys($allMonths, 0);
                        @endphp
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->NombreUsuario }}</td>
                                <td>{{ $order->total_price }}</td>
                                @if ($order->status == 1)
                                    <td>Recibido</td>
                                @else
                                    <td>Enviado</td>
                                @endif
                                <td>
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                        <a class="btn" href="{{ route('order.show', $order->id) }}">
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
                            <!--Código para los datos de los graficos-->
                            @php
                                // Obtenemos el nombre del mes del pedido
                                $month = date('F', strtotime($order->created_at));
                                // Incrementamos el total del mes correspondiente
                                $totalsByMonth[$month] += $order->total_price;
                            @endphp
                            @php
                                // Inicializamos un array para almacenar los totales por año
                                $totalsByYear = [];

                                foreach ($orders as $order) {
                                    // Obtenemos el año del pedido
                                    $year = date('Y', strtotime($order->created_at));

                                    // Incrementamos el total del año correspondiente
                                    if (!isset($totalsByYear[$year])) {
                                        $totalsByYear[$year] = 0;
                                    }
                                    $totalsByYear[$year] += $order->total_price;
                                }
                            @endphp
                            @php
                                // Inicializamos un array para almacenar los totales por trimestre
                                $totalsByQuarter = [
                                    1 => 0,
                                    2 => 0,
                                    3 => 0,
                                    4 => 0,
                                ];

                                foreach ($orders as $order) {
                                    // Obtenemos el mes del pedido
                                    $month = date('n', strtotime($order->created_at));

                                    // Calculamos el trimestre correspondiente
                                    if ($month >= 1 && $month <= 3) {
                                        $quarter = 1;
                                    } elseif ($month >= 4 && $month <= 6) {
                                        $quarter = 2;
                                    } elseif ($month >= 7 && $month <= 9) {
                                        $quarter = 3;
                                    } else {
                                        $quarter = 4;
                                    }

                                    // Incrementamos el total del trimestre correspondiente
                                    if (!isset($totalsByQuarter[$quarter])) {
                                        $totalsByQuarter[$quarter] = 0;
                                    }
                                    $totalsByQuarter[$quarter] += $order->total_price;
                                }
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <!--DataTable Implementation-->
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "paging": true,
                "pageLength": 15 // Esto establece la paginación de 15 en 15
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Convertimos el array PHP a JSON para que pueda ser utilizado en JavaScript
        const totals = @json(array_values($totalsByMonth));
        const months = @json(array_keys($totalsByMonth));

        // Crear el gráfico de barras
        const ctx = document.getElementById('ordersByMonthChart').getContext('2d');
        const ordersByMonthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Total Ventas por Mes',
                    data: totals,
                    fill: false,
                    borderColor: 'rgba(76, 175, 80, 1)',
                    borderWidth: 1,
                    tension: 0.1,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //crear grafico anual

        const totalsyear = @json(array_values($totalsByYear));
        const years = @json(array_keys($totalsByYear));
        // Crear el gráfico de barras
        const context = document.getElementById('ordersByYearChart').getContext('2d');
        const ordersByYearChart = new Chart(context, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: 'Total Ventas Anual',
                    data: totalsyear,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // Cambia el color si lo deseas
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //crear graf trimestral

        const contextotrimestral = document.getElementById('ordersByQuarterChart').getContext('2d');
        const quarters = ['Trimestre 1', 'Trimestre 2', 'Trimestre 3', 'Trimestre 4']; // Nombres de trimestres
        const totalsquarter = @json(array_values($totalsByQuarter));
        console.log(totalsquarter);
        const ordersByQuarterChart = new Chart(contextotrimestral, {
            type: 'bar',
            data: {
                labels: quarters,
                datasets: [{
                    label: 'Beneficios Trimestre',
                    data: totalsquarter,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)', // Puedes cambiar el color si lo deseas
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
