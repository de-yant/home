<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = Auth::user();

    // Cek apakah user aktif
    if (!$user->is_active) {
        Auth::logout(); // Logout user jika tidak aktif

        return redirect()->route('login')->withErrors([
            'email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
        ]);
    }

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'pengawas' => redirect()->route('pengawas.dashboard'),
        default => abort(403, 'Unauthorized'),
    };
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
