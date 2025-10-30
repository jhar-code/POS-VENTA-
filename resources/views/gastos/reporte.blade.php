<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    thead {
        background-color: #d32f2f;
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
            REPORTE DE GASTOS
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Monto</th>
            <th>Usuario</th>
            <th>Descripción</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gastos as $gasto)
            <tr>
                <td>{{ $gasto->id }}</td>
                <td class="text-right">{{ number_format($gasto->monto, 2) }}</td>
                <td>{{ $gasto->usuario->name }}</td>
                <td>{{ $gasto->descripcion }}</td>
                <td>{{ $gasto->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
