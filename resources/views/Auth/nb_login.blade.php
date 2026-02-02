<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comic+Relief:wght@400;700&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <form action="{{ route('no-bootstrap.post.login') }}" class="form-login" method="POST" id="loginForm">
        @csrf
        <h3>LOGIN KARYAWAN</h3>
        @if (session('_Throw'))
            <div class="alert">
                <p>{{ session('_Throw') }}</p>
            </div>
        @endif
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" class="form-input" name="username" id="username" placeholder="Username"
                value="{{ old('username') }}">
            @error('username')
                <small style="color: red">{{ $message }}</small>
            @enderror
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" class="form-input" name="password" id="password" placeholder="Password"
                value="{{ old('password') }}">
            @error('password')
                <small style="color: red">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn">LOGIN</button>
        <a href="{{ route('bootstrap.login') }}" class="login-siswa">Login sebagai siswa?</a>
    </form>

    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>

    <script>
        $('button[type="submit"]').on('click', function(e) {
            e.preventDefault();
            const login = $('#loginForm');
            $(this).text('Memproses...').prop('disabled', true);
            login.submit();
        });
    </script>
</body>

</html>
