<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionHistoryController extends Controller
{
    public function index(): View
    {
        $payments = Pay::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transactions', compact('payments'));
    }
}
