<?php
namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // ❌ Cek status aktif petugas
            if ($user->level_user === 'petugas' && optional($user->petugas)->status !== 'Aktif') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'login' => 'Akun petugas Anda sedang tidak aktif.',
                ]);
            }

            // ❌ Cek status aktif anggota
            if ($user->level_user === 'anggota' && optional($user->anggota)->status_anggota !== 'Aktif') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'login' => 'Akun anggota Anda sedang tidak aktif.',
                ]);
            }

            // ✅ Redirect sesuai role
            switch ($user->level_user) {
                case 'admin':
                    return redirect()->intended('/dashboard-admin');
                case 'petugas':
                    return redirect()->intended('/dashboard-petugas');
                case 'anggota':
                    return redirect()->intended('/dashboard-anggota');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'login' => 'Level user tidak dikenali.',
                    ]);
            }
        }

        return back()->withErrors([
            'login' => 'Login gagal. Username atau Password salah.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
