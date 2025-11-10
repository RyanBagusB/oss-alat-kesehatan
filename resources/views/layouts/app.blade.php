<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'OSS Alat Kesehatan' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col">
    @yield('content')
</body>
</html>
