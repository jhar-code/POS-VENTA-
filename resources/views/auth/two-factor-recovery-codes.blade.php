@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Códigos de Recuperación de 2FA</div>

                <div class="card-body">
                    <div class="alert alert-warning">
                        <p>Guarda estos códigos en un lugar seguro. Puedes usarlos para acceder a tu cuenta si pierdes tu dispositivo de autenticación.</p>
                    </div>

                    <div class="row">
                        @foreach ($recoveryCodes as $code)
                            <div class="col-md-6 mb-2">
                                <code class="h5">{{ $code }}</code>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Volver al Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
