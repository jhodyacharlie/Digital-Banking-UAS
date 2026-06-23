<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Pay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (! session('otp_verified')) {
            return redirect()->route('otp.index');
        }

        $user = Auth::user();
        $paymentQuery = Pay::where('user_id', $user->id);
        $payments = (clone $paymentQuery)
            ->latest()
            ->limit(5)
            ->get();

        $totalPayments = (clone $paymentQuery)->sum('amount');
        $pendingPayments = (clone $paymentQuery)
            ->where('status', 'Pending')
            ->sum('amount');
        $paymentCount = (clone $paymentQuery)->count();
        $monthlyPayments = (clone $paymentQuery)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->where('status', 'unread')
            ->count();
        $recentNotifications = Notification::where('user_id', $user->id)
            ->latest()
            ->limit(3)
            ->get();

        $startingBalance = (float) ($user->balance ?? 12500000);
        $availableBalance = max($startingBalance - $totalPayments, 0);
        $securityScore = $user->email_verified_at ? 92 : 76;

        return view('dashboard', compact(
            'user',
            'payments',
            'availableBalance',
            'pendingPayments',
            'paymentCount',
            'monthlyPayments',
            'unreadNotifications',
            'recentNotifications',
            'securityScore'
        ));
    }
}
