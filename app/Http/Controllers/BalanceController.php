<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BalanceController extends Controller
{
    public function index()
    {
        $balances = Balance::with('account')->latest()->get();
        return view('balance.index', compact('balances'));
    }

    public function create()
    {
        $accounts = Account::orderBy('account_name')->get();
        return view('balance.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => ['required', 'exists:accounts,id', 'unique:balances,account_id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'last_transaction_at' => ['nullable', 'date'],
        ]);

        Balance::create($validated);

        return redirect()->route('balances.index');
    }

    public function edit(Balance $balance)
    {
        $accounts = Account::orderBy('account_name')->get();
        return view('balance.edit', compact('balance', 'accounts'));
    }

    public function update(Request $request, Balance $balance)
    {
        $validated = $request->validate([
            'account_id' => ['required', 'exists:accounts,id', Rule::unique('balances', 'account_id')->ignore($balance->id)],
            'amount' => ['required', 'numeric', 'min:0'],
            'last_transaction_at' => ['nullable', 'date'],
        ]);

        $balance->update($validated);

        return redirect()->route('balances.index');
    }

    public function destroy(Balance $balance)
    {
        $balance->delete();

        return redirect()->route('balances.index');
    }
}
