<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CheckInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Si ya está instalada
        if (Storage::exists('installed')) {
            // permitir acceder a "installer.finished"
            if ($request->is('installer/finished')) {
                return $next($request);
            }

            // bloquear cualquier otra ruta del instalador
            if ($request->is('installer*')) {
                return redirect('/');
            }

            return $next($request);
        }

        // Si no está instalada, permitir solo rutas del instalador
        if ($request->is('installer*') || $request->is('assets/installer/*')) {
            return $next($request);
        }

        // demás requests van al instalador
        return redirect()->route('installer.welcome');
    }
}
