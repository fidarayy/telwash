<!-- resources/views/customers/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
</head>
<body>
    <h1>Daftar Pelanggan</h1>
    <ul>
        @foreach ($customers as $customer)
            <li>{{ $customer->name }} - {{ $customer->phone_number }}</li>
        @endforeach
    </ul>
</body>
</html>
