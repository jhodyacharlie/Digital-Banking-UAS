<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::with('balance')->latest()->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_number' => ['required', 'string', 'max:30', 'unique:accounts,account_number'],
            'account_name' => ['required', 'string', 'max:100'],
            'account_type' => ['required', Rule::in(['Tabungan', 'Giro', 'Deposito'])],
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ]);

        Account::create($validated);

        return redirect()->route('accounts.index');
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            'account_number' => ['required', 'string', 'max:30', Rule::unique('accounts', 'account_number')->ignore($account->id)],
            'account_name' => ['required', 'string', 'max:100'],
            'account_type' => ['required', Rule::in(['Tabungan', 'Giro', 'Deposito'])],
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ]);

        $account->update($validated);

        return redirect()->route('accounts.index');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index');
    }
}
