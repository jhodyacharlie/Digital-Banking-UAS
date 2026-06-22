<h2>Tambah Balance</h2>

<form action="{{ route('balances.store') }}" method="POST">
    @csrf

    <input type="number"
           name="account_id"
           placeholder="Account ID">

    <br><br>

    <input type="number"
           name="amount"
           placeholder="Saldo">

    <br><br>

    <button type="submit">
        Simpan
    </button>
</form>