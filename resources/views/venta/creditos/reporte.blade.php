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

    th,
    td {
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
</style>

<table>
    <tr>
        <td colspan="2">
            <img src="{{ public_path('/img/logo.png') }}" alt="Logo" height="90" />
        </td>
        <td colspan="7">
            <p>REPORTE DE CREDITOS</p>
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Teléfono</th>
            <th class="text-right">Monto</th>
            <th class="text-right">Abonado</th>
            <th class="text-right">Restante</th>
            <th>Fecha/Hora</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalMonto = 0;
            $totalAbonado = 0;
            $totalRestante = 0;
        @endphp
        @foreach ($creditos as $credito)
            @php
                $totalMonto += $credito['total'];
                $totalAbonado += $credito['abonado'];
                $totalRestante += $credito['restante'];
            @endphp
            <tr>
                <td>{{ $credito['id'] }}</td>
                <td>{{ $credito['nombre'] }}</td>
                <td>{{ $credito['telefono'] }}</td>
                <td class="text-right">{{ number_format($credito['total'], 2) }}</td>
                <td class="text-right">{{ number_format($credito['abonado'], 2) }}</td>
                <td class="text-right">{{ number_format($credito['restante'], 2) }}</td>
                <td>{{ $credito['fecha'] }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Totales:</td>
            <td class="text-right">{{ number_format($totalMonto, 2) }}</td>
            <td class="text-right">{{ number_format($totalAbonado, 2) }}</td>
            <td class="text-right">{{ number_format($totalRestante, 2) }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>
