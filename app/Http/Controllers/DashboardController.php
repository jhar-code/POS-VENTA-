<?php

namespace App\Http\Controllers;

use App\Models\Abonoventa;
use App\Models\Caja;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Detalleventa;
use App\Models\Gasto;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $userId = Auth::id();
        $existe = Caja::where('estado', 1)->first();
        $saldo = 0;

        if ($existe) {
            $id_caja = $existe->id;
            $montoInicial = $existe->monto_inicial;
            $compras = Compra::where('id_caja', $id_caja)->where('estado', 1)->sum('total');
            $gastos = Gasto::where('id_caja', $id_caja)->sum('monto');
            $ventas = Venta::where('id_caja', $id_caja)->where('estado', 1)->where('metodo', 'Contado')->sum('total');
            $abonoventa = Abonoventa::where('id_caja', $id_caja)->sum('monto');
            $saldo = ($montoInicial + $ventas + $abonoventa) - ($compras + $gastos);
        }

        $totales = [
            'products' => Producto::count(),
            'clients' => Cliente::count(),
            'categories' => Categoria::count(),
            'suppliers' => Proveedor::count(),
            'spents' => Gasto::sum('monto'),
            'balance' => $saldo
        ];

        $comprasTotal = Compra::whereIn('estado', [1, 2])->sum('total');
        $ventasTotal = Venta::whereIn('estado', [1, 2])->where('metodo', 'Contado')->sum('total');
        $montosTotal = [
            'compras' => $comprasTotal,
            'ventas' => $ventasTotal,
        ];

        $rankingUsuarios = Venta::with('user')
            ->select('id_usuario', DB::raw('SUM(total) as total'))
            ->groupBy('id_usuario')
            ->orderByDesc('total')
            ->limit(10) // 🔹 Agregado el límite de 10
            ->get();

        $rankingProductos = Detalleventa::select('nombre_producto', DB::raw('SUM(cantidad) as total'))
            ->groupBy('nombre_producto')
            ->orderByDesc('total')
            ->limit(10) // 🔹 Agregado el límite de 10
            ->get();

        $reporteClientes = Venta::with('cliente')
            ->select('id_cliente', DB::raw('SUM(total) as total'))
            ->groupBy('id_cliente')
            ->orderByDesc('total')
            ->limit(10) // 🔹 Agregado el límite de 10
            ->get();

        $nombresMeses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        $ventasPorMeses = Venta::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total')
            ->whereIn('estado', [1, 2])
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $ventas = [];
        foreach ($ventasPorMeses as $venta) {
            $year = $venta->year;
            $month = $nombresMeses[$venta->month];
            $ventas[$year][$month] = $venta->total;
        }

        $hoy = Carbon::now();
        $inicioSemana = $hoy->startOfWeek()->toDateString();
        $finSemana = $hoy->endOfWeek()->toDateString();

        $diasEnEspanol = [
            'Sunday' => 'Domingo',
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
        ];

        $ventasPorSemana = Venta::select(DB::raw('DAYNAME(created_at) as dia'), DB::raw('SUM(total) as total'))
            ->whereIn('estado', [1, 2])
            ->whereBetween('created_at', ["{$inicioSemana} 00:00:00", "{$finSemana} 23:59:59"])
            ->groupBy('dia')
            ->get();

        $ventasPorSemana = $ventasPorSemana->map(function ($venta) use ($diasEnEspanol) {
            $venta->diaEnEspanol = $diasEnEspanol[ucfirst(strtolower($venta->dia))];
            return $venta;
        });

        return view('dashboard', compact('ventas', 'ventasPorSemana', 'totales', 'montosTotal', 'rankingUsuarios', 'rankingProductos', 'reporteClientes'));
    }
}
