<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use PragmaRX\Google2FA\Google2FA;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    
    static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6'
    ];
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_secret',
        'two_factor_enabled',
        'two_factor_verified_at',
        'two_factor_recovery_codes'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'two_factor_enabled' => 'boolean',
        'two_factor_verified_at' => 'datetime',
    ];

    // Métodos para 2FA
    public function enableTwoFactorAuth()
    {
        $google2fa = new Google2FA();
        
        // Generar clave secreta
        $this->two_factor_secret = $google2fa->generateSecretKey();
        $this->two_factor_enabled = false;
        
        // Generar códigos de recuperación
        $this->two_factor_recovery_codes = json_encode(
            collect()->times(8, function () {
                return strtoupper(bin2hex(random_bytes(5)));
            })->all()
        );
        
        $this->save();
        
        // Generar QR Code
        $url = $google2fa->getQRCodeUrl(
            config('app.name'),
            $this->email,
            $this->two_factor_secret
        );

        $renderer = new \BaconQrCode\Renderer\ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(200),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new \BaconQrCode\Writer($renderer);
        $qrCodeUrl = $writer->writeString($url);
        
        return [
            'qr_code' => $qrCodeUrl,
            'secret' => $this->two_factor_secret,
            'recovery_codes' => json_decode($this->two_factor_recovery_codes)
        ];
    }
    
    public function verifyTwoFactorCode($code)
    {
        if ($this->useRecoveryCode($code)) {
            return true;
        }
        
        $google2fa = new Google2FA();
        return $google2fa->verifyKey($this->two_factor_secret, $code);
    }
    
    public function useRecoveryCode($code)
    {
        $recoveryCodes = json_decode($this->two_factor_recovery_codes, true) ?? [];
        
        foreach ($recoveryCodes as $index => $recoveryCode) {
            if (hash_equals($recoveryCode, $code)) {
                unset($recoveryCodes[$index]);
                $this->two_factor_recovery_codes = json_encode(array_values($recoveryCodes));
                $this->save();
                return true;
            }
        }
        
        return false;
    }
    
    public function disableTwoFactorAuth()
    {
        $this->update([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
            'two_factor_verified_at' => null,
            'two_factor_recovery_codes' => null,
        ]);
    }
    
    public function isTwoFactorEnabled()
    {
        return $this->two_factor_enabled && !is_null($this->two_factor_secret);
    }

    
    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    public function adminlte_profile_url()
    {
        return 'profile';
    }

    public function gastos()
    {
        return $this->hasMany(Gasto::class, 'id_usuario');
    }
}