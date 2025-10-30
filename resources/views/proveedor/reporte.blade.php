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
        <td colspan="4" class="report-title">
            REPORTE DE PROVEEDORES
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>N° Ident. Fiscal</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->identidad }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->correo }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->direccion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
