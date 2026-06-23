<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PayController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $payments = Pay::where('user_id', $user->id)
            ->latest()
            ->limit(4)
            ->get();
        $availableBalance = (float) ($user->balance ?? 12500000) - (float) Pay::where('user_id', $user->id)->sum('amount');

        return view('payment', [
            'payments' => $payments,
            'availableBalance' => max($availableBalance, 0),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:1000'],
            'description' => ['nullable', 'string', 'max:160'],
        ]);

        $payment = Pay::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'status' => 'Success',
        ]);

        $payment->statuses()->create([
            'status' => 'Success',
        ]);

        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Payment success',
            'message' => 'Transfer ke ' . $validated['receiver'] . ' sebesar Rp ' . number_format($validated['amount'], 0, ',', '.') . ' berhasil diproses.',
            'status' => 'unread',
        ]);

        return redirect()->route('status.index')->with('success', 'Payment success. Transfer berhasil diproses.');
    }
}
