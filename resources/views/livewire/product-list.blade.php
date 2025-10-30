<div class="row">
    <div class="col-md-7">

        <div class="mb-3">
            <div class="input-group">
                <input wire:model.live="search" wire:keydown.enter="addProductByCode" type="text"
                    placeholder="Buscar productos..." class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" wire:click="openModal()" type="button"><i
                            class="fas fa-plus"></i>
                        Agregar Servicio
                    </button>

                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-6 border-product position-relative">
                    <div class="featured-content-list">
                        <button type="button" data-name="Oxford Shirts" data-price="1200"
                            class="btn btn-primary border-radius-5" wire:click="addToCart({{ $product->id }})">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                    <span class="product">{{ $product->producto }}</span>
                    <div class="featured-item">
                        <div class="featured-item-img">
                            <a href="#">
                                <img class="img"
                                    src="{{ $product->foto ? Storage::url($product->foto) : asset('img/default.png') }}"
                                    alt="Images">
                            </a>
                        </div>
                        <div class="content">
                            <div class="content-in">
                                <h4>${{ $product->precio_venta }} </h4>
                                <span>({{ $product->stock }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="mb-2">
            {{ $products->links() }}
        </div>

    </div>
    <div class="col-md-5">
        @if ($message = Session::get('success_message'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('error_message'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">
                            Producto
                        </th>
                        <th scope="col">Cant</th>
                        <th scope="col">Precio</th>
                        <th scope="col"></th>
                        <!-- Agrega más columnas según tus necesidades -->
                    </tr>
                </thead>
                <tbody>
                    @if ($cartItems->isNotEmpty())
                        @foreach ($cartItems as $item)
                            <tr>
                                <td class="align-middle">
                                    <span style="font-size: 9px;">{{ $item->name }}</span>
                                </td>
                                <td class="align-middle" width="100">
                                    <input type="number" wire:model.defer="quantity.{{ $item->rowId }}"
                                        wire:change="updateQuantity('{{ $item->rowId }}')" class="form-control">
                                </td>
                                <td class="align-middle">
                                    <span style="font-size: 9px;">${{ number_format($item->price, 2) }}</span>
                                </td>
                                <td class="align-middle"><button wire:click="removeFromCart('{{ $item->rowId }}')"
                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>
                                <!-- Agrega más columnas según tus necesidades -->
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">El carrito está vacío.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div>
            <input type="hidden" id="total" value="{{ Cart::subtotal() }}">
            <hr>
            <br>
            <h5 class="text-right">Total del Carrito: ${{ Cart::subtotal() }}</h5>
        </div>
    </div>

    <div id="modalServicio" class="modal fade @if ($isOpen) show d-block @endif" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Producto y Servicio
                    </h5>
                    <button class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="producto">Producto / Servicio</label>
                            <input id="producto" class="form-control" type="text" placeholder="Producto / Servicio"
                                wire:model.defer="serviceName">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cantidad">Cantidad</label>
                            <input id="cantidad" class="form-control" type="number" placeholder="Cantidad"
                                wire:model.defer="serviceQuantity">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="precio">Precio</label>
                            <input id="precio" class="form-control" type="number" step="0.01" min="0.01"
                                placeholder="Precio" wire:model.defer="servicePrice">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" wire:click="closeModal()">
                        Cerrar
                    </button>
                    <button class="btn btn-primary" wire:click="addServiceToCart">
                        Agregar al Carrito
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
