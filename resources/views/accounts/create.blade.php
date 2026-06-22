<h2>Tambah Account</h2>

<form action="{{ route('accounts.store') }}" method="POST">
    @csrf

    <input type="text"
           name="account_number"
           placeholder="Nomor Account">

    <br><br>

    <input type="text"
           name="account_name"
           placeholder="Nama Account">

    <br><br>

    <button type="submit">
        Simpan
    </button>
</form>