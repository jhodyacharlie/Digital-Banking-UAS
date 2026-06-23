<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PayController extends Controller
{
    public function index(): View
    {
        return view('payment', [
            'user' => request()->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        Pay::create([
            'user_id' => $request->user()?->id,
            'amount' => $request->amount,
            'status' => 'Pending',
        ]);

        return redirect()->route('status.index')->with('status', 'Transfer berhasil dibuat dan menunggu proses.');
    }
}
