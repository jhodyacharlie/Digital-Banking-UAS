<h2>Daftar Account</h2>

<a href="{{ route('accounts.create') }}">
    Tambah Account
</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nomor Account</th>
        <th>Nama Account</th>
    </tr>

    @foreach($accounts as $account)
    <tr>
        <td>{{ $account->id }}</td>
        <td>{{ $account->account_number }}</td>
        <td>{{ $account->account_name }}</td>
    </tr>
    @endforeach
</table>