@extends('layouts.app')

@section('title', 'Movimientos')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="text-center mb-4"><i class="fas fa-chart-bar fa-2x"></i> Cuadre de Caja</h4>

        @if (isset($error))
        <div class="alert alert-danger text-center">{{ $error }}</div>
        <div class="text-center">
            <a href="{{ route('cajas.create') }}" class="btn btn-primary">🗄️ Abrir Caja</a>
        </div>
        @else
        <!-- Tabla de Resumen -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2">Concepto</th>
                        <th colspan="2" class="text-right">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">💰 Monto Inicial</td>
                        <td colspan="2" class="text-right">S/{{ number_format($montoInicial, 2) }}</td>
                    </tr>
                    <tr class="table-success">
                        <td><strong>🟢 Ventas Contado</strong></td>
                        <td class="text-right"><strong>S/{{ number_format($ventasContado, 2) }}</strong></td>
                        <td><strong>🟡 Ventas Crédito</strong></td>
                        <td class="text-right"><strong>S/{{ number_format($ventasCredito, 2) }}</strong></td>
                    </tr>
                    <tr class="table-danger">
                        <td>🔴 Compras</td>
                        <td class="text-right">S/{{ number_format($compras, 2) }}</td>
                        <td>🔴 Gastos</td>
                        <td class="text-right">S/{{ number_format($gastos, 2) }}</td>
                    </tr>
                    <tr class="table-primary">
                        <td colspan="2"><strong>🟦 Total Saldo</strong></td>
                        <td colspan="2" class="text-right"><strong>S/{{ number_format($saldo, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- Tabla de Ventas por Método de Pago -->
                <h6 class="mt-4 text-center">💳 Ventas por Método de Pago</h6>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Método de Pago</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventasPorMetodo as $venta)
                            <tr>
                                <td>📌 {{ $venta->formapago->nombre }}</td>
                                <td class="text-right">S/{{ number_format($venta->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Tabla de Abonos de Ventas -->
                <h6 class="mt-4 text-center">💳 Abonos de Ventas</h6>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Método de Pago</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abonoVentas as $abono)
                            <tr>
                                <td>📌 {{ $abono->formapago->nombre }}</td>
                                <td class="text-right">S/{{ number_format($abono->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($box)
        <!-- Botón para Cerrar Caja -->
        <div class="text-center mt-4">
            <form id="cerrarCajaForm" action="{{ route('cajas.update') }}" method="post">
                {{ method_field('PUT') }}
                @csrf
                <button class="btn btn-danger btn-lg" type="button" onclick="confirmarCerrarCaja()">❌ Cerrar
                    Caja</button>
            </form>
        </div>
        @endif


        @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
    function confirmarCerrarCaja() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción cerrará la caja y no podrá reabrirse",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cerrar caja',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario
                document.getElementById('cerrarCajaForm').submit();
            }
        });
    }
</script>