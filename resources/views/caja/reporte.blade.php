<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    thead {
        background-color: #6200ea;
        color: #ffffff;
        font-weight: bold;
    }

    th, td {
        border: 1px solid #dddddd;
        padding: 10px;
        text-align: left;
    }

    tbody tr:nth-child(even) {
        background-color: #f3f3f3;
    }

    .report-title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .logo {
        height: 90px;
    }

    .text-right {
        text-align: right;
    }
</style>

<table>
    <tr>
        <td colspan="2">
            <img src="{{ public_path('/img/logo.png') }}" alt="Logo" class="logo" />
        </td>
        <td colspan="6" class="report-title">
            REPORTE DE CAJA
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>F. Apertura</th>
            <th>Monto Inicial</th>
            <th>F. Cierre</th>
            <th>Compras</th>
            <th>Gastos</th>
            <th>Ventas</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cajas as $caja)
            <tr>
                <td>{{ $caja->id }}</td>
                <td>{{ $caja->fecha_apertura }}</td>
                <td class="text-right">{{ number_format($caja->monto_inicial, 2) }}</td>
                <td>{{ $caja->fecha_cierre }}</td>
                <td class="text-right">{{ number_format($caja->compras, 2) }}</td>
                <td class="text-right">{{ number_format($caja->gastos, 2) }}</td>
                <td class="text-right">{{ number_format($caja->ventas, 2) }}</td>
                <td class="text-right">
                    {{ number_format($caja->ventas - ($caja->gastos + $caja->compras), 2) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
