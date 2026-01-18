<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD</title>
    <style>
        body {
            font-family: Arial;
            margin: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <h1>Student Management</h1>

    {{-- Content from child views --}}
    @yield('content')

</body>
</html>
