<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
</head>
<body>

<h1>Daftar Notifikasi</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Pesan</th>
        <th>Status</th>
    </tr>

    @foreach($notifications as $notification)
    <tr>
        <td>{{ $notification->id }}</td>
        <td>{{ $notification->title }}</td>
        <td>{{ $notification->message }}</td>
        <td>{{ $notification->status }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>