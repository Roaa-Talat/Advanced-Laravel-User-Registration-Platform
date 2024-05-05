<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="register-route" content="{{ route('user.register') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Registration Form</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        @include('header')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('footer')
    </footer>

    <script src="{{ asset('main.js') }}"></script>
</body>

</html>
