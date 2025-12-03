<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthController extends Controller
{
    public function showSetupForm()
    {
        $user = Auth::user();
        
        if ($user->isTwoFactorEnabled()) {
            return redirect()->route('dashboard')->with('info', 'La autenticación de dos factores ya está habilitada.');
        }
        
        $twoFactorData = $user->enableTwoFactorAuth();
        
        return view('auth.two-factor-setup', compact('twoFactorData'));
    }
    
    public function enable(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);
        
        $user = Auth::user();
        
        if ($user->verifyTwoFactorCode($request->code)) {
            $user->update([
                'two_factor_enabled' => true,
                'two_factor_verified_at' => now()
            ]);
            
            return redirect()->route('dashboard')
                ->with('success', 'Autenticación de dos factores habilitada correctamente.');
        }
        
        return back()->with('error', 'El código de verificación es inválido.');
    }
    
    public function showVerificationForm()
    {
        return view('auth.two-factor-verify');
    }
    
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);
        
        $user = Auth::user();
        
        if ($user->verifyTwoFactorCode($request->code)) {
            session(['2fa_verified' => true]);
            return redirect()->intended('/dashboard');
        }
        
        return back()->with('error', 'Código inválido. Intenta nuevamente.');
    }
    
    public function showRecoveryCodes()
    {
        $user = Auth::user();
        $recoveryCodes = json_decode($user->two_factor_recovery_codes, true) ?? [];
        
        return view('auth.two-factor-recovery-codes', compact('recoveryCodes'));
    }
    
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password'
        ]);
        
        $user = Auth::user();
        $user->disableTwoFactorAuth();
        
        return redirect()->route('profile.edit')
            ->with('success', 'Autenticación de dos factores deshabilitada.');
    }
}