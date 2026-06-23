<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Notification;
use App\Models\OTP;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function show(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'no_card' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ], [
            'no_card.required' => 'Nomor kartu atau email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $isAuthenticated = Login::attempt(
            trim($validated['no_card']),
            $validated['password'],
            $request->boolean('remember')
        );

        if ($isAuthenticated) {
            $request->session()->regenerate();
            $request->session()->forget('url.intended');
            $request->session()->put('otp_verified', false);
            $request->session()->put(
                'theme',
                Setting::where('user_id', Auth::id())->where('key', 'theme')->value('value') ?? 'light'
            );

            $otp = (string) random_int(100000, 999999);

            OTP::create([
                'email' => Auth::user()->email,
                'otp_code' => $otp,
                'expired_at' => now()->addMinutes(5),
            ]);

            Notification::create([
                'user_id' => Auth::id(),
                'title' => 'Login baru',
                'message' => 'Akun Anda berhasil login dan menunggu verifikasi OTP.',
                'status' => 'unread',
            ]);

            return redirect()
                ->route('otp.index')
                ->with('status', 'Login berhasil. Masukkan kode OTP untuk lanjut ke dashboard.')
                ->with('demo_otp', $otp);
        }

        return back()
            ->withErrors(['login' => 'Nomor kartu/email atau password salah.'])
            ->onlyInput('no_card');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda berhasil keluar.');
    }
}
