<div class="form-grid">
    <label>
        Account
        @php($selectedAccount = old('account_id', $balance->account_id ?? ''))
        <select name="account_id">
            <option value="">Pilih account</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" @selected((string) $selectedAccount === (string) $account->id)>
                    {{ $account->account_number }} - {{ $account->account_name }}
                </option>
            @endforeach
        </select>
        @error('account_id') <span class="error">{{ $message }}</span> @enderror
    </label>

    <label>
        Saldo
        <input type="number" name="amount" min="0" step="1000" value="{{ old('amount', $balance->amount ?? '') }}" placeholder="Contoh: 2500000">
        @error('amount') <span class="error">{{ $message }}</span> @enderror
    </label>

    <label>
        Transaksi Terakhir
        <input type="date" name="last_transaction_at" value="{{ old('last_transaction_at', isset($balance) && $balance->last_transaction_at ? $balance->last_transaction_at->format('Y-m-d') : '') }}">
        @error('last_transaction_at') <span class="error">{{ $message }}</span> @enderror
    </label>
</div>
