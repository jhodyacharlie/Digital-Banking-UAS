<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Models\Security;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SecurityController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $latestOtp = $user
            ? OTP::where('email', $user->email)->latest()->first()
            : null;

        return view('security', compact('user', 'latestOtp'));
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->input('intent') === 'send_otp') {
            $validated = $request->validate([
                'account' => ['required', 'string', 'max:255'],
            ]);

            $user = $this->findUser($validated['account']);

            if (! $user) {
                return back()->withErrors(['account' => 'Akun tidak ditemukan.']);
            }

            $otp = (string) random_int(100000, 999999);

            OTP::create([
                'email' => $user->email,
                'otp_code' => $otp,
                'expired_at' => now()->addMinutes(5),
            ]);

            return back()
                ->with('success', 'Kode OTP reset password berhasil dibuat.')
                ->with('demo_otp', $otp)
                ->withInput(['account' => $validated['account']]);
        }

        if ($request->input('intent') === 'reset_password') {
            $validated = $request->validate([
                'account' => ['required', 'string', 'max:255'],
                'otp_code' => ['required', 'digits:6'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $user = $this->findUser($validated['account']);

            if (! $user) {
                return back()->withErrors(['account' => 'Akun tidak ditemukan.'])->withInput();
            }

            $otp = OTP::where('email', $user->email)
                ->where('otp_code', $validated['otp_code'])
                ->where('expired_at', '>=', now())
                ->latest()
                ->first();

            if (! $otp) {
                return back()
                    ->withErrors(['otp_code' => 'Kode OTP salah atau sudah kedaluwarsa.'])
                    ->withInput();
            }

            $user->forceFill([
                'password' => Hash::make($validated['password']),
            ])->save();

            return redirect()
                ->route('login')
                ->with('status', 'Password berhasil diganti. Silakan login kembali.');
        }

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'pin' => ['required', 'string', 'min:4', 'max:12'],
            'security_question' => ['required', 'string', 'max:160'],
            'security_answer' => ['required', 'string', 'max:160'],
        ]);

        Security::create($validated);

        return back()->with('success', 'Data security berhasil disimpan.');
    }

    private function findUser(string $account): ?User
    {
        return User::query()
            ->where('email', $account)
            ->orWhere('no_card', $account)
            ->first();
    }
}
