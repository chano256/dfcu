<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <h1>Admin Panel</h1>
    <table>
        <thead>
            <tr>
                <th>Total Requests:</th>
                <th>Total Failed Validations:</th>
                <th>Total Positive Requests:</th>
                <th>Total Negative Requests:</th>
            </tr>
        </thead>
        <tbody>
            <td>{{ $total_requests }}</td>
            <td>{{ $total_failed_validations }}</td>
            <td>{{ $total_positive_requests }}</td>
            <td>{{ $total_negative_requests }}</td>
        </tbody>
    </table>
</body>

</html>