<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</html>