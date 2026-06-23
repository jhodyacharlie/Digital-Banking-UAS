<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StatusController extends Controller
{
    public function index(): View
    {
        $payments = Pay::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('status', compact('payments'));
    }
}
