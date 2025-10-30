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

    tfoot {
        background-color: #3700b3;
        color: #ffffff;
        font-weight: bold;
    }

    .text-right {
        text-align: right;
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
</style>

<table>
    <tr>
        <td colspan="2">
            <img src="{{ public_path('/img/logo.png') }}" alt="Logo" class="logo" />
        </td>
        <td colspan="3" class="report-title">
            REPORTE DE COMPRAS
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Proveedor</th>
            <th>Teléfono</th>
            <th class="text-right">Monto</th>
            <th>Fecha/Hora</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalCompras = 0;
        @endphp
        @foreach ($compras as $compra)
            @php
                $totalCompras += $compra->total;
            @endphp
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ $compra->proveedor->nombre }}</td>
                <td>{{ $compra->proveedor->telefono }}</td>
                <td class="text-right">{{ number_format($compra->total, 2) }}</td>
                <td>{{ $compra->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total Compras:</td>
            <td class="text-right">{{ number_format($totalCompras, 2) }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>
