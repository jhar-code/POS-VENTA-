@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verificación en Dos Pasos</div>

                <div class="card-body">
                    <p>Por favor, ingresa el código de verificación de tu aplicación de autenticación.</p>
                    
                    <form method="POST" action="{{ route('2fa.verify.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Código de verificación</label>
                            <input type="text" class="form-control" id="code" name="code" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary">Verificar</button>
                    </form>
                    
                    <div class="mt-3">
                        <a href="{{ route('2fa.recovery-codes') }}">¿Problemas con tu código? Usa un código de recuperación</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection