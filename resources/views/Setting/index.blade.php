<!DOCTYPE html>
<html>
<head>
    <title>Account Settings</title>
</head>
<body>
<h1>Account Settings</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Key</th>
        <th>Value</th>
    </tr>
    @foreach($settings as $setting)
    <tr>
        <td>{{ $setting->id }}</td>
        <td>{{ $setting->user_id }}</td>
        <td>{{ $setting->key }}</td>
        <td>{{ $setting->value }}</td>
    </tr>
    @endforeach
</table>
</body>
</html>