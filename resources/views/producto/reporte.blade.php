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
        <td colspan="5" class="report-title">
            REPORTE DE PRODUCTOS
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Código</th>
            <th>Producto</th>
            <th class="text-right">Precio Compra</th>
            <th class="text-right">Precio Venta</th>
            <th class="text-right">Stock</th>
            <th>Categoría</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalCompra = 0;
            $totalVenta = 0;
            $totalStock = 0;
        @endphp
        @foreach ($productos as $producto)
            @php
                $totalCompra += $producto->precio_compra;
                $totalVenta += $producto->precio_venta;
                $totalStock += $producto->stock;
            @endphp
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->producto }}</td>
                <td class="text-right">{{ number_format($producto->precio_compra, 2) }}</td>
                <td class="text-right">{{ number_format($producto->precio_venta, 2) }}</td>
                <td class="text-right">{{ $producto->stock }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Totales:</td>
            <td class="text-right">{{ number_format($totalCompra, 2) }}</td>
            <td class="text-right">{{ number_format($totalVenta, 2) }}</td>
            <td class="text-right">{{ $totalStock }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>
