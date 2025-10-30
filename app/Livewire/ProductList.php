<?php

namespace App\Livewire;

use App\Models\Producto;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 12;
    public $quantity = [];

    public $isOpen = 0;

    // Variables para el modal
    public $serviceName;
    public $serviceQuantity;
    public $servicePrice;

    public function render()
    {
        $products = Producto::where('producto', 'like', '%' . $this->search . '%')
            ->orWhere('codigo', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);


        $cartItems = Cart::instance('ventas')->content();

        foreach ($cartItems as $item) {
            $this->quantity[$item->rowId] = $item->qty;
        }

        return view(
            'livewire.product-list',
            ['products' => $products, 'cartItems' => $cartItems]
        );
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->isOpen = false;        
    }

    public function resetInputFields()
    {
        $this->serviceName = '';
        $this->serviceQuantity = '';
        $this->servicePrice = '';
    }

    public function addServiceToCart()
    {
        // Validación básica
        if (!$this->serviceName || !$this->serviceQuantity || !$this->servicePrice) {
            session()->flash('error_message', 'Todos los campos son obligatorios.');
            return;
        }

        Cart::instance('ventas')->add([
            'id' => 'SVC-' . uniqid(),
            'name' => $this->serviceName,
            'qty' => $this->serviceQuantity,
            'price' => $this->servicePrice,
            'options' => ['type' => 'service'], // 🔹 Identificarlo como servicio
        ]);

        session()->flash('success_message', 'Servicio agregado al carrito.');

        // Limpiar campos
        $this->reset(['serviceName', 'serviceQuantity', 'servicePrice']);

        // Cerrar el modal
        $this->dispatch('closeModal', 'modalServicio');
    }

    public function addToCart($productId)
    {
        $product = Producto::find($productId);

        if (!$product) {
            session()->flash('error_message', 'Producto no encontrado.');
            return;
        }

        if ($product->stock < 1) {
            session()->flash('error_message', 'No hay suficiente stock disponible.');
            return;
        }

        $existingItem = Cart::instance('ventas')->search(fn($cartItem, $rowId) => $cartItem->id === $productId);

        if ($existingItem->isNotEmpty()) {
            $existingItem = $existingItem->first();
            $newQuantity = $existingItem->qty + 1;

            if ($newQuantity > $product->stock) {
                session()->flash('error_message', 'No hay suficiente stock disponible.');
                return;
            }

            Cart::instance('ventas')->update($existingItem->rowId, $newQuantity);
        } else {
            Cart::instance('ventas')->add([
                'id' => $product->id,
                'name' => $product->producto,
                'price' => $product->precio_venta,
                'qty' => 1,
                'options' => ['type' => 'product'], // 🔹 Identificarlo como producto
            ]);
        }

        session()->flash('success_message', 'Producto agregado al carrito.');
    }

    public function addProductByCode()
    {
        $product = Producto::where('codigo', $this->search)->first();

        if ($product) {
            if ($product->stock < 1) {
                session()->flash('error_message', 'No hay suficiente stock disponible.');
                return;
            }

            Cart::instance('ventas')->add([
                'id' => $product->id,
                'name' => $product->producto,
                'qty' => 1,
                'price' => $product->precio_venta,
                'options' => ['type' => 'product'], // 🔹 Identificarlo como producto
            ]);

            $this->search = '';
            session()->flash('success_message', 'Producto agregado al carrito.');
        } else {
            session()->flash('error_message', 'Código no encontrado.');
        }
    }


    public function updateQuantity($rowId)
    {
        $newQuantity = $this->quantity[$rowId];
        $cartItem = Cart::instance('ventas')->get($rowId);

        if (!$cartItem) {
            session()->flash('error_message', 'No se encontró el producto en el carrito.');
            return;
        }

        // Si es un servicio, actualiza sin validar stock
        if (isset($cartItem->options['type']) && $cartItem->options['type'] === 'service') {
            Cart::instance('ventas')->update($rowId, ['qty' => $newQuantity]);
            session()->flash('success_message', 'Cantidad de servicio actualizada.');
            return;
        }

        // Si es un producto físico, validar stock
        $product = Producto::find($cartItem->id);

        if ($newQuantity > $product->stock) {
            session()->flash('error_message', 'No hay suficiente stock disponible.');
            return;
        }

        Cart::instance('ventas')->update($rowId, ['qty' => $newQuantity]);
        session()->flash('success_message', 'Cantidad de producto actualizada.');
    }


    public function removeFromCart($rowId)
    {
        Cart::instance('ventas')->remove($rowId);
        session()->flash('success_message', 'Producto eliminado del carrito.');
    }
}
