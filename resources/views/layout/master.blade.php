<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="register-route" content="{{ route('user.register') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>{{__('strings.Registration Form')}}</title>
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
    @include('sweetalert::alert')
</body>

</html>

<script>
    document.getElementById('languages').addEventListener('change', function() {
        var selectedLang = this.value;
        window.location.href = '/' + selectedLang; // Redirect to /en or /ar based on selection
    });
</script>

<script>
    var langStrings = {
        birthDateCheck: "{{ __('strings.BirthDateCheck') }}",
        emailCheck: "{{ __('strings.EmailCheck')}}",
        emptyEmail: "{{ __('strings.EmptyEmail')}}",
        emptyPhoneNumber: "{{ __('strings.EmptyPhoneNumber')}}",
        phonenumberCheck: "{{ __('strings.PhoneNumberCheck')}}",
        emptyPassword:"{{ __('strings.EmptyPassword')}}",
        passwordCheck:"{{ __('strings.PasswordCheck')}}",
        confirmpasswordCheck:"{{ __('strings.ConfirmPasswordCheck')}}",
        emptyBirthdate:"{{ __('strings.EmptyBirthDate')}}"
    };
</script>