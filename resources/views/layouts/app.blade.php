<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ ($title ?? 'OSS Alat Kesehatan') }}
        @if(config('app.name'))
            | {{ config('app.name') }}
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col">
    @yield('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                flashMessage('success', "{{ session('success') }}");
            @elseif (session('error'))
                flashMessage('error', "{{ session('error') }}");
            @elseif ($errors->any())
                flashMessage('error', "{{ $errors->first() }}");
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
