<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function index()
    {
        $payments = Pay::with('statuses')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('status', compact('payments'));
    }
}
