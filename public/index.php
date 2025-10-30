<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Comprobar si la aplicación está en mantenimiento
|--------------------------------------------------------------------------
|
| Si la aplicación está en modo de mantenimiento/demo mediante el comando "down"
| cargaremos este archivo para que se pueda mostrar cualquier contenido pre-renderizado
| en lugar de iniciar el framework, lo que podría causar una excepción.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|----------------------------------------------------------------------
| Registrar el cargador automático
|--------------------------------------------------------------------------
|
| Composer proporciona un práctico cargador de clases generado automáticamente 
  para esta aplicación. ¡Solo tenemos que usarlo! Simplemente lo requeriremos 
  en el script para no tener que cargar nuestras clases manualmente.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Ejecutar la aplicación
|--------------------------------------------------------------------------
|
| Una vez que tengamos la aplicación, podemos gestionar la solicitud entrante usando
| el kernel HTTP de la aplicación. Luego, enviaremos la respuesta
| al navegador del cliente, permitiéndole disfrutar de nuestra aplicación.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
