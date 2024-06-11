<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        /* Include your CSS styles here */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e2e2e2;
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .card {
            margin-bottom: 1rem;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-body {
            padding: 1.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Report Details</h1>
        <div class="card">
            <div class="card-header">Report Summary</div>
            <div class="card-body">
                <p>Report generated on: {{ now() }}</p>
                <p>Total publications: {{ count($publications) }}</p>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">Publication List</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Authors</th>
                            <th>Type</th>
                            <th>Published Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publications as $publication)
                            <tr>
                                <td>{{ $publication->P_title }}</td>
                                <td>{{ $publication->P_authors }}</td>
                                <td>{{ $publication->P_type }}</td>
                                <td>{{ $publication->P_published_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
