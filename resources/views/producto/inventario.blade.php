@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Movimientos de Inventario</h2>

        <div class="table-responsive">
            <table id="tblMovimientos" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Cant</th>
                        <th>StockAnt</th>
                        <th>StockAct</th>
                        <th>PrecioUn.</th>
                        <th>Total</th>
                        <th>Origen</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <link href="DataTables/datatables.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="DataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tblMovimientos').DataTable({
                responsive: true,
                fixedHeader: true,
                processing: true,
                ajax: {
                    url: '{{ route('movimientos.list') }}',
                    type: 'GET'
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'producto',
                        name: 'producto'
                    },
                    {
                        data: 'tipo_movimiento',
                        name: 'tipo_movimiento',
                        render: function(data) {
                            let lowerData = data
                        .toLowerCase(); // Convertir a minúsculas para comparar correctamente
                            let badgeClass = lowerData === 'entrada' ? 'success' : 'danger';
                            return `<span class="badge badge-${badgeClass}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                        }
                    },

                    {
                        data: 'cantidad',
                        name: 'cantidad'
                    },
                    {
                        data: 'stock_anterior',
                        name: 'stock_anterior'
                    },
                    {
                        data: 'stock_actual',
                        name: 'stock_actual'
                    },
                    {
                        data: 'precio_unitario',
                        name: 'precio_unitario',
                        render: function(data) {
                            return data;
                        }
                    },
                    {
                        data: null,
                        name: 'total',
                        render: function(data) {
                            return data.total;
                        }
                    },
                    {
                        data: 'origen',
                        name: 'origen',
                        render: function(data) {
                            return data.charAt(0).toUpperCase() + data.slice(1);
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            let date = new Date(data);
                            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
                        }
                    }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json'
                },
                order: [
                    [9, 'desc']
                ]
            });

        });
    </script>
@stop
