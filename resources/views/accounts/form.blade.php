<div class="form-grid">
    <label>
        Nomor Account
        <input type="text" name="account_number" value="{{ old('account_number', $account->account_number ?? '') }}" placeholder="Contoh: DGB-001">
        @error('account_number') <span class="error">{{ $message }}</span> @enderror
    </label>

    <label>
        Nama Account
        <input type="text" name="account_name" value="{{ old('account_name', $account->account_name ?? '') }}" placeholder="Nama nasabah">
        @error('account_name') <span class="error">{{ $message }}</span> @enderror
    </label>

    <label>
        Tipe Account
        @php($selectedType = old('account_type', $account->account_type ?? 'Tabungan'))
        <select name="account_type">
            @foreach(['Tabungan', 'Giro', 'Deposito'] as $type)
                <option value="{{ $type }}" @selected($selectedType === $type)>{{ $type }}</option>
            @endforeach
        </select>
        @error('account_type') <span class="error">{{ $message }}</span> @enderror
    </label>

    <label>
        Status
        @php($selectedStatus = old('status', $account->status ?? 'Aktif'))
        <select name="status">
            @foreach(['Aktif', 'Nonaktif'] as $status)
                <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('status') <span class="error">{{ $message }}</span> @enderror
    </label>
</div>
