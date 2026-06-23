<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index(): View
    {
        $theme = session('theme', 'light');
        $settings = Setting::where('user_id', Auth::id())->get();

        return view('Setting.index', compact('settings', 'theme'));
    }

    public function theme(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'theme' => ['required', Rule::in(['light', 'dark'])],
        ]);

        session(['theme' => $validated['theme']]);

        Setting::updateOrCreate(
            ['user_id' => Auth::id(), 'key' => 'theme'],
            ['value' => $validated['theme']]
        );

        return back()->with('success', 'Tema berhasil diubah.');
    }
}
