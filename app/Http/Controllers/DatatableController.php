<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Cotizacion;
use App\Models\Creditoventa;
use App\Models\Forma;
use App\Models\Gasto;
use App\Models\MovimientoInventario;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
    public function products()
    {
        $products = Producto::select(
            'productos.id',
            'productos.codigo',
            'productos.producto',
            'productos.precio_compra',
            'productos.precio_venta',
            'productos.stock',
            'productos.foto',
            'categorias.nombre as categoria'
        )
            ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id') // Hacer un left join con la tabla categorias
            ->orderBy('productos.id', 'desc')
            ->get();

        return DataTables::of($products)
            ->editColumn('precio_compra', function ($product) {
                return '$ ' . number_format($product->precio_compra, 2);
            })
            ->editColumn('precio_venta', function ($product) {
                return '$ ' . number_format($product->precio_venta, 2);
            })
            ->toJson();
    }

    public function clients()
    {
        $clients = Cliente::select('id', 'ruc', 'nombre', 'telefono', 'correo', 'credito', 'direccion')
            ->orderBy('id', 'desc')->get();
        return DataTables::of($clients)->toJson();
    }

    public function proveedors()
    {
        $proveedors = Proveedor::select('id', 'identidad', 'nombre', 'telefono', 'correo', 'direccion')
            ->orderBy('id', 'desc')->get();
        return DataTables::of($proveedors)->toJson();
    }

    public function movimientos()
    {
        $movimientos = MovimientoInventario::with('producto')->orderBy('id', 'desc')->get();

        return DataTables::of($movimientos)
            ->addColumn('producto', function ($movimiento) {
                return $movimiento->producto->producto ?? 'N/A';
            })
            ->addColumn('tipo_movimiento', function ($movimiento) {
                return ucfirst($movimiento->tipo_movimiento);
            })
            ->addColumn('cantidad', function ($movimiento) {
                return $movimiento->cantidad;
            })
            ->addColumn('stock_anterior', function ($movimiento) {
                return $movimiento->stock_anterior;
            })
            ->addColumn('stock_actual', function ($movimiento) {
                return $movimiento->stock_actual;
            })
            ->addColumn('precio_unitario', function ($movimiento) {
                return '$ ' . number_format($movimiento->precio_unitario, 2);
            })
            ->addColumn('total', function ($movimiento) {
                return '$ ' . number_format($movimiento->cantidad * $movimiento->precio_unitario, 2);
            })
            ->addColumn('origen', function ($movimiento) {
                return ucfirst($movimiento->origen);
            })
            ->addColumn('fecha', function ($movimiento) {
                return $movimiento->created_at->format('d/m/Y H:i');
            })
            ->make(true);
    }


    public function users()
    {
        $users = User::select('id', 'name', 'email', 'created_at')
            ->orderBy('id', 'desc')->get();
        return DataTables::of($users)->toJson();
    }

    public function categories()
    {
        $categories = Categoria::select('id', 'nombre')
            ->orderBy('id', 'desc')->get();
        return DataTables::of($categories)->toJson();
    }

    public function formas()
    {
        $formas = Forma::select('id', 'nombre')
            ->orderBy('id', 'desc')->get();
        return DataTables::of($formas)->toJson();
    }

    public function gastos()
    {
        $id_user = Auth::id();
        $gastos = Gasto::with(['usuario'])
            ->where('id_usuario', $id_user)->get();
        $data = [];

        foreach ($gastos as $gasto) {
            $foto = ($gasto->foto) ? asset('storage/' . $gasto->foto) : null;
            $data[] = [
                'id' => $gasto->id,
                'monto' => '$ ' . number_format($gasto->monto, 2),
                'descripcion' => $gasto->descripcion,
                'foto' => $foto,
                'usuario' => $gasto->usuario->name,
                'created_at' => $gasto->created_at->format('Y-m-d H:i:s'),
            ];
        }
        return DataTables::of($data)->toJson();
    }

    public function sales()
    {
        $sales = Venta::with(['cliente', 'formapago', 'user'])
            ->whereIn('ventas.estado', [1, 2])
            ->get();
        $data = [];

        foreach ($sales as $venta) {
            $data[] = [
                'id' => $venta->id,
                'total' => '$ ' . number_format($venta->total, 2),
                'cliente' => $venta->cliente->nombre,
                'user' => $venta->user->name,
                'metodo' => $venta->metodo,
                'formapago' => $venta->formapago->nombre,
                'created_at' => $venta->created_at->format('Y-m-d H:i:s'),
            ];
        }
        return DataTables::of($data)->toJson();
    }

    public function creditoventas()
    {
        $id_user = Auth::id();

        $creditos = Creditoventa::with('cliente', 'abonos')
            ->where('id_usuario', $id_user)
            ->get();

        $data = [];

        foreach ($creditos as $credito) {
            $abonado = $credito->abonos->sum('monto');
            $restante = $credito->monto - $abonado;

            $data[] = [
                'id' => $credito->id,
                'total' => '$ ' . number_format($credito->monto, 2),
                'cliente' => $credito->cliente->nombre,
                'abonado' => '$ ' . number_format($abonado, 2, '.', ''),
                'restante' => '$ ' . number_format($restante, 2, '.', ''),
                'fecha' => $credito->created_at->format('Y-m-d H:i:s'),
            ];
        }

        return DataTables::of($data)->toJson();
    }


    public function compras()
    {
        $id_user = Auth::id();
        $compras = Compra::join('proveedors', 'compras.id_proveedor', '=', 'proveedors.id')
            ->select('compras.*', 'proveedors.nombre')
            ->orderBy('compras.id', 'desc')
            ->whereIn('compras.estado', [1, 2])  // Cambio aquí
            ->where('compras.id_usuario', $id_user)

            ->get();
        return DataTables::of($compras)
            ->editColumn('total', function ($compra) {
                return '$ ' . number_format($compra->total, 2);
            })
            ->toJson();
    }

    public function cotizaciones()
    {
        $id_user = Auth::id();
        $cotizaciones = Cotizacion::join('clientes', 'cotizaciones.id_cliente', '=', 'clientes.id')
            ->select('cotizaciones.*', 'clientes.nombre')
            ->orderBy('cotizaciones.id', 'desc')->where('cotizaciones.id_usuario', $id_user)->get();
        return DataTables::of($cotizaciones)
            ->editColumn('total', function ($cotizacion) {
                return '$ ' . number_format($cotizacion->total, 2);
            })
            ->toJson();
    }

    public function cajas()
    {
        $id_user = Auth::id();
        $cajas = Caja::select('id', 'monto_inicial', 'fecha_apertura', 'fecha_cierre', 'estado', 'compras', 'gastos', 'ventas')
            ->orderBy('id', 'desc')->where('id_usuario', $id_user)->get();

        return DataTables::of($cajas)
            ->editColumn('monto_inicial', function ($caja) {
                return '$ ' . number_format($caja->monto_inicial, 2);
            })
            ->editColumn('compras', function ($caja) {
                return '$ ' . number_format($caja->compras, 2);
            })
            ->editColumn('gastos', function ($caja) {
                return '$ ' . number_format($caja->gastos, 2);
            })
            ->editColumn('ventas', function ($caja) {
                return '$ ' . number_format($caja->ventas, 2);
            })
            ->toJson();
    }
}
