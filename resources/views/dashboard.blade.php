@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="card card-custom blue">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('compra.index') }}">
                    <img src="{{ asset('img/home/compras.png') }}" alt="Image 1">
                    <div>
                        <h5 class="card-title">Compras</h5>
                        <h2 class="card-number">{{ number_format($montosTotal['compras'], 2) }}</h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom orange">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('productos.index') }}">
                    <img src="{{ asset('img/home/productos.png') }}" alt="Image 2">
                    <div>
                        <h5 class="card-title">Productos</h5>
                        <h2 class="card-number">{{ $totales['products'] }}</h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom purple">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('clientes.index') }}">
                    <img src="{{ asset('img/home/clientes.png') }}" alt="Image 3">
                    <div>
                        <h5 class="card-title">Clientes</h5>
                        <h2 class="card-number">{{ $totales['clients'] }}</h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom green">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('proveedores.index') }}">
                    <img src="{{ asset('img/home/proveedor.png') }}" alt="Image 3">
                    <div>
                        <h5 class="card-title">Proveedores</h5>
                        <h2 class="card-number">{{ $totales['suppliers'] }}</h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom red">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('venta.index') }}">
                    <img src="{{ asset('img/home/ventas.png') }}" alt="Image 3">
                    <div>
                        <h5 class="card-title">Ventas</h5>
                        <h2 class="card-number">{{ number_format($montosTotal['ventas'], 2) }}</h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom teal">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('categorias.index') }}">
                    <img src="{{ asset('img/home/categorias.png') }}" alt="Image 3">
                    <div>
                        <h5 class="card-title">Categorias</h5>
                        <h2 class="card-number">{{ $totales['categories'] }}</h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom cyan">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('usuarios.index') }}">
                    <img src="{{ asset('img/home/dinero.png') }}" alt="Image 3">
                    <div>
                        <h5 class="card-title">Saldo</h5>
                        <h2 class="card-number">{{ number_format($totales['balance'], 2) }}</h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom amber">
                <a class="d-flex justify-content-between aling-items-center" href="{{ route('gastos.index') }}">
                    <img src="{{ asset('img/home/gasto.png') }}" alt="Image 3">
                    <div>
                        <h5 class="card-title">Gasto</h5>
                        <h2 class="card-number">{{ number_format($totales['spents'], 2) }}</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        @if ($ventasPorSemana)
            <div class="col-lg-6 col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <h4 class="text-dark">Ventas por Semana</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="ventasPorSemana"></canvas>
                    </div>
                </div>
            </div>
        @endif

        @if ($ventas)
            <div class="col-lg-6 col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <h4 class="text-dark">Ventas por Mes</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="ventasPorMes"></canvas>
                    </div>
                </div>
            </div>
        @endif

        @if ($rankingUsuarios)
            <div class="col-lg-6 col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <h4 class="text-dark">Ranking de Ventas por Usuario</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="rankingUsuariosChart"></canvas>
                    </div>
                </div>
            </div>
        @endif

        @if ($rankingProductos)
            <div class="col-lg-6 col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <h4 class="text-dark">Ranking de Ventas por Producto/Servicio</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="rankingProductosChart"></canvas>
                    </div>
                </div>
            </div>
        @endif

        @if ($reporteClientes)
            <div class="col-lg-6 col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <h4 class="text-dark">Reporte de Ventas por Cliente</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="reporteClientesChart"></canvas>
                    </div>
                </div>
            </div>
        @endif
    </div>


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('ventasPorSemana')) {
                ventasSemana();
            }

            function getGradient(ctx, color1, color2) {
                let gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, color1);
                gradient.addColorStop(1, color2);
                return gradient;
            }

            function createBarChart(id, labels, data, color1, color2) {
                var ctx = document.getElementById(id).getContext('2d');
                let gradient = getGradient(ctx, color1, color2);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: id.replace(/Chart$/, '').replace(/([A-Z])/g, ' $1').trim(),
                            data: data,
                            backgroundColor: gradient,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                            display: false,
                            labels: {
                                boxWidth: 8
                            }
                        },
                        tooltips: {
                            displayColors: false
                        },
                        scales: {
                            x: {
                                barPercentage: 0.5
                            }
                        }
                    }
                });
            }

            // Ventas por mes
            var dataVenta = @json($ventas);
            if (dataVenta && Object.keys(dataVenta).length > 0) {
                var ctx = document.getElementById('ventasPorMes').getContext('2d');
                var datasets = [];
                let gradient1 = getGradient(ctx, '#f54ea2', '#ff7676');
                let gradient2 = getGradient(ctx, '#42e695', '#3bb2b8');

                Object.keys(dataVenta).forEach(function(year, index) {
                    datasets.push({
                        label: 'Ventas ' + year,
                        data: Object.values(dataVenta[year]),
                        backgroundColor: index % 2 === 0 ? gradient1 : gradient2,
                        borderWidth: 1
                    });
                });

                var labels = Object.keys(dataVenta[Object.keys(dataVenta)[0]]);
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                            display: false,
                            labels: {
                                boxWidth: 8
                            }
                        },
                        tooltips: {
                            displayColors: false
                        },
                        scales: {
                            x: {
                                barPercentage: 0.5
                            }
                        }
                    }
                });
            }

            function ventasSemana() {
                var ventasData = {!! json_encode($ventasPorSemana) !!};
                var labels = ventasData.map(item => item.diaEnEspanol);
                var ventasValores = ventasData.map(item => item.total);
                createBarChart('ventasPorSemana', labels, ventasValores, '#42e695', '#3bb2b8');
            }

            // Ranking de Ventas por Usuario
            var rankingUsuariosData = {!! json_encode($rankingUsuarios) !!};
            if (rankingUsuariosData.length > 0) {
                var labels = rankingUsuariosData.map(item => item.user.name);
                var valores = rankingUsuariosData.map(item => item.total);
                createBarChart('rankingUsuariosChart', labels, valores, '#4CAF50', '#66BB6A');
            }

            // Ranking de Ventas por Producto/Servicio
            var rankingProductosData = {!! json_encode($rankingProductos) !!};
            if (rankingProductosData.length > 0) {
                var labels = rankingProductosData.map(item => item.nombre_producto);
                var valores = rankingProductosData.map(item => item.total);
                createBarChart('rankingProductosChart', labels, valores, '#FF9800', '#FFB74D');
            }

            // Reporte de Ventas por Cliente
            var reporteClientesData = {!! json_encode($reporteClientes) !!};
            if (reporteClientesData.length > 0) {
                var labels = reporteClientesData.map(item => item.cliente.nombre);
                var valores = reporteClientesData.map(item => item.total);
                createBarChart('reporteClientesChart', labels, valores, '#E91E63', '#F06292');
            }
        });
    </script>

@stop
