<div class="row">
    <div class="col-md-7">

        <input wire:model.live="search" type="text" placeholder="Buscar productos..." class="form-control mb-2">

        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-6 border-product position-relative">
                    <div class="featured-content-list">
                        <button type="button" data-name="Oxford Shirts" data-price="1200"
                            class="default-btn border-radius-5" wire:click="addToCart({{ $product->id }})">
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
                                <h4>${{ $product->precio_compra }} </h4>
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
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant</th>
                    <th>Precio</th>
                    <th></th>
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
                            <td class="align-middle"><span
                                    style="font-size: 9px;">${{ number_format($item->price, 2) }}</span></td>
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

        <div class="card-footer">
            <h3>Total del Carrito: ${{ Cart::subtotal() }}</h3>
        </div>
    </div>

</div>
