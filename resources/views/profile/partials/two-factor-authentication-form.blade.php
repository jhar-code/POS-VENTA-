<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Autenticación de Dos Factores') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Añade seguridad adicional a tu cuenta usando la autenticación de dos factores.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        @if (Auth::user()->isTwoFactorEnabled())
            <div class="alert alert-success">
                {{ __('La autenticación de dos factores está habilitada.') }}
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('2fa.recovery-codes') }}" class="btn btn-secondary">
                    {{ __('Ver Códigos de Recuperación') }}
                </a>

                <form method="POST" action="{{ route('2fa.disable') }}" class="inline">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña actual" required>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres deshabilitar 2FA?')">
                            {{ __('Deshabilitar 2FA') }}
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="alert alert-warning">
                {{ __('La autenticación de dos factores no está habilitada.') }}
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('2fa.setup') }}" class="btn btn-primary">
                    {{ __('Habilitar 2FA') }}
                </a>
            </div>
        @endif
    </div>
</section>
