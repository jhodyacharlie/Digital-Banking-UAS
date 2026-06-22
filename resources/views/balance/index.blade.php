<h2>Daftar Balance</h2>

<a href="{{ route('balances.create') }}">
    Tambah Balance
</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Account ID</th>
        <th>Saldo</th>
    </tr>

    @foreach($balances as $balance)
    <tr>
        <td>{{ $balance->id }}</td>
        <td>{{ $balance->account_id }}</td>
        <td>{{ $balance->amount }}</td>
    </tr>
    @endforeach
</table>