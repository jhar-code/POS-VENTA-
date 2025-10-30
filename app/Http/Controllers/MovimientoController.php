<?php

namespace App\Http\Controllers;

use App\Models\Abonoventa;
use App\Models\Caja;
use App\Models\Compra;
use App\Models\Gasto;
use App\Models\MovimientoInventario;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    public function inventario()
    {
        return view('producto.inventario');
    }

    public function index()
    {
        $caja = Caja::where('estado', 1)->first();
        if ($caja) {
            $data = $this->obtenerDatosCaja($caja->id);
            $data['box'] = true;
            return view('caja.movimiento', $data);
        } else {
            $data['box'] = true;
            return view('caja.movimiento', ['error' => 'El usuario no tiene una caja activa.']);
        }
    }

    public function show($caja_id)
    {
        $caja = Caja::find($caja_id);
        if ($caja) {
            $data = $this->obtenerDatosCaja($caja->id);
            $data['box'] = false;
            return view('caja.movimiento', $data);
        } else {
            $data['box'] = false;
            return view('caja.movimiento', ['error' => 'No se encontró la caja con ese ID.']);
        }
    }

    private function obtenerDatosCaja($caja_id)
    {
        $caja = Caja::find($caja_id);
        if (!$caja) {
            return ['error' => 'Caja no encontrada.'];
        }

        $montoInicial = $caja->monto_inicial;

        // Totales generales
        $compras = Compra::where('id_caja', $caja_id)->where('estado', 1)->sum('total') ?? 0;
        $gastos = Gasto::where('id_caja', $caja_id)->sum('monto') ?? 0;

        // Ventas por tipo de pago
        $ventasContado = Venta::where('id_caja', $caja_id)->where('estado', 1)->where('metodo', 'Contado')->sum('total') ?? 0;
        $ventasCredito = Venta::where('id_caja', $caja_id)->where('estado', 1)->where('metodo', 'Crédito')->sum('total') ?? 0;

        // Ventas por método de pago
        $ventasPorMetodo = Venta::select('id_forma', DB::raw('SUM(total) as total'))
            ->where('id_caja', $caja_id)
            ->where('estado', 1)
            ->groupBy('id_forma')
            ->get();

        // Abonos
        $abonoVentas = Abonoventa::select('id_forma', DB::raw('SUM(monto) as total'))
            ->where('id_caja', $caja_id)
            ->groupBy('id_forma')
            ->get();

        // 🔹 CÁLCULO DEL SALDO FINAL
        $saldo = $montoInicial + $ventasContado + $abonoVentas->sum('total') - $compras - $gastos;

        return compact(
            'montoInicial',
            'compras',
            'gastos',
            'ventasContado',
            'ventasCredito',
            'abonoVentas',
            'ventasPorMetodo',
            'saldo'
        );
    }
}
