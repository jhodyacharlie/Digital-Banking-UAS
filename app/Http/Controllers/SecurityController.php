<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SecurityController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $securityScore = $user->email_verified_at ? 92 : 76;

        return view('security', compact('user', 'securityScore'));
    }
}
