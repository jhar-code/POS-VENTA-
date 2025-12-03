@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Configurar Autenticación en Dos Pasos</div>

                <div class="card-body">
                    <p>Escanea este código QR con tu aplicación de autenticación (Google Authenticator, Authy, etc.):</p>
                    
                    <div class="text-center mb-4">
                        {!! $twoFactorData['qr_code'] !!}
                    </div>
                    
                    <p>O ingresa manualmente esta clave: <code>{{ $twoFactorData['secret'] }}</code></p>
                    
                    <form method="POST" action="{{ route('2fa.enable') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Código de verificación</label>
                            <input type="text" class="form-control" id="code" name="code" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary">Habilitar 2FA</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection