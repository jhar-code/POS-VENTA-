@extends('layouts.app')

@section('title', 'Nueva venta')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="mb-1">
                <a href="{{ route('cajas.index') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-funnel-dollar"></i> {{ __('Caja') }}
                </a>
                <a href="{{ route('venta.show') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-list"></i> {{ __('Listar ventas') }}
                </a>
            </div>
            <div class="card">
                <div class="card-body">

                    @livewire('product-list')

                </div>
                <div class="card-footer">
                    <button class="btn btn-primary fixed-button" id="btnVenta" type="button">Generar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalVenta">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <h3>Total: $ <span id="total_pagar">0.00</span></h3>
                    </h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Buscar Cliente <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalCliente"
                                        type="button"><i class="fas fa-search"></i></button>
                                </div>
                                <input id="buscarCliente" class="form-control" type="text"
                                    placeholder="Nombre del cliente">
                                <input id="id_cliente" class="form-control" type="hidden">
                            </div>
                            <span id="errorBusqueda" class="text-danger"></span>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input id="limitecredito" class="form-control" type="text" placeholder="Lim. Credito"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary"><i class="fas fa-phone"></i></span>
                                </div>
                                <input id="tel_cliente" class="form-control" placeholder="Telefono" type="text" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary"><i class="fas fa-home"></i></span>
                                </div>
                                <input id="dir_cliente" class="form-control" type="text" placeholder="Direccion"
                                    disabled>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Pago con $</span>
                                </div>
                                <input id="pago_con" class="form-control" type="number" step="0.01" min="0.01"
                                    placeholder="0.00" oninput="calcularCambio()">
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cambio $</span>
                                </div>
                                <input id="cambio" class="form-control" type="text" placeholder="0.00" disabled>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="forma">Forma Pago <span class="text-danger">*</span></label>
                            <select id="forma" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach ($formapagos as $formapago)
                                    <option value="{{ $formapago->id }}">{{ $formapago->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="metodo">Metodo <span class="text-danger">*</span></label>
                            <select id="metodo" class="form-control">
                                <option value="Contado">Contado</option>
                                <option value="Credito">Credito</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="responsable">Responsable de la venta <span class="text-danger">*</span></label>
                            <select id="responsable" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nota">Nota</label>
                            <textarea id="nota" class="form-control" name="nota" rows="3" placeholder="Nota"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" id="btnProcesar" type="button">Completar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Clientes</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover display responsive nowrap" width="100%"
                            id="tblClients">
                            <thead class="thead">
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Limite Crédito</th>
                                    <th>Dirección</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link href="DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script>
        var ventaUrl = "{{ route('venta.index') }}";
        var ticketUrl = "{{ route('venta.ticket', ['id' => 0]) }}";
        var limiteUrl = "{{ route('creditoventa.limitecliente', ['id' => 0]) }}";
        const btnVenta = document.querySelector('#btnVenta');
        const btnProcesar = document.querySelector('#btnProcesar');
        const total_pagar = document.querySelector('#total_pagar');
        const metodo = document.querySelector('#metodo');
        const responsable = document.querySelector('#responsable');
        const pago_con = document.querySelector('#pago_con');
        const total = document.querySelector('#total');
        const nota = document.querySelector('#nota');
        const limitecredito = document.querySelector('#limitecredito');
        document.addEventListener('DOMContentLoaded', function() {

            new DataTable('#tblClients', {
                responsive: true,
                fixedHeader: true,
                ajax: {
                    url: '{{ route('clients.list') }}',
                    dataSrc: 'data'
                },
                columns: [{
                        // Agregar columna para acciones
                        data: null,
                        render: function(data, type, row) {
                            // Agregar botones de editar y eliminar
                            return `<a class="btn btn-sm btn-primary" href="#" onclick="selectCliente(${data.id}, '${data.nombre}', '${data.telefono}', '${data.direccion}')">Seleccionar</a>`;
                        }
                    },
                    {
                        data: 'nombre'
                    },
                    {
                        data: 'telefono'
                    },
                    {
                        data: 'correo'
                    },
                    {
                        data: 'credito'
                    },
                    {
                        data: 'direccion'
                    }

                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json',
                },
                order: [
                    [0, 'desc']
                ]
            });

            $("#buscarCliente").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('venta.cliente') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            if (data.length === 0) {
                                errorBusqueda.textContent = "No se encontraron resultados.";
                            } else {
                                errorBusqueda.textContent = '';
                            }
                            response(data);
                        }
                    });
                },
                minLength: 2, // Número mínimo de caracteres para mostrar sugerencias
                select: function(event, ui) {
                    console.log(ui.item.id);
                    id_cliente.value = ui.item.id;
                    tel_cliente.value = ui.item.telefono;
                    dir_cliente.value = ui.item.direccion;
                    verlimitecredito(ui.item.id);
                }
            });

            btnVenta.addEventListener('click', function() {
                total_pagar.textContent = total.value;
                $('#modalVenta').modal('show');
            })

            btnProcesar.addEventListener('click', function() {
                if (responsable.value == '' || id_cliente.value == '' || forma.value == '' || metodo
                    .value == '') {
                    mostrarAlerta('TODO LOS CAMPOS CON * SON REQUERIDOS', 'warning');
                } else {
                    const montoPago = parseFloat(pago_con.value.replace(',', ''));
                    const totalPagar = parseFloat(total_pagar.textContent.replace(',', ''));

                    const esCredito = metodo.value === 'Credito';

                    if (esCredito && parseFloat(limitecredito.value) < totalPagar) {
                        mostrarAlerta("TU LIMITE DE CREDITO SUPERA AL TOTAL", 'warning');
                        return;
                    }

                    if (esCredito && montoPago >= totalPagar) {
                        mostrarAlerta("LA VENTA ES A CREDITO, INGRESE UN VALOR MENOR AL TOTAL", 'warning');
                        return;
                    }

                    Swal.fire({
                        title: "Mensaje?",
                        text: "Esta seguro de procesar la venta!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, procesar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(ventaUrl, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        id_cliente: id_cliente.value,
                                        responsable: responsable.value,
                                        forma: forma.value,
                                        metodo: metodo.value,
                                        pago_con: montoPago,
                                        nota: nota.value,
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    mostrarAlerta(data.title, data.icon);
                                    if (data.icon == 'success') {
                                        setTimeout(() => {
                                            window.open(
                                                `${ticketUrl.replace('0', data.ticket)}`,
                                                '_blank');
                                            window.location.reload();
                                        }, 1500);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error: ', error);
                                });
                        }
                    });
                }
            });

        })

        function selectCliente(id_cliente, nombre, telefono, direccion) {
            verlimitecredito(id_cliente);
            document.querySelector('#id_cliente').value = id_cliente;
            document.querySelector('#buscarCliente').value = nombre;
            document.querySelector('#tel_cliente').value = telefono;
            document.querySelector('#dir_cliente').value = direccion;
            mostrarAlerta('Cliente: ' + nombre + ' Seleccionado', 'success');
            $('#modalCliente').modal('hide');
        }

        function verlimitecredito(id_cliente) {
            fetch(limiteUrl.replace('0', id_cliente), {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    limitecredito.value = data.toFixed(2);
                })
                .catch(error => {
                    console.error('Error: ', error);
                });
        }

        function calcularCambio() {
            var pagoCon = parseFloat(pago_con.value.replace(',', '')) || 0; // Reemplaza comas por puntos
            var totalVenta = parseFloat(total.value.replace(',', '')) || 0;

            if (!isNaN(pagoCon) && !isNaN(totalVenta)) {
                var cambio = pagoCon - totalVenta;
                document.getElementById('cambio').value = cambio.toFixed(2);
            } else {
                document.getElementById('cambio').value = '0.00';
            }
        }

        function mostrarAlerta(texto, icono) {
            Swal.fire({
                showConfirmButton: false,
                title: "Respuesta",
                text: texto,
                icon: icono,
                toast: true,
                timer: 1500,
                position: "top-end",
            });
        }
    </script>
@stop
