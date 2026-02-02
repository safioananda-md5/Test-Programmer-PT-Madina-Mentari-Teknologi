<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <style>
        @media screen and (max-width: 768px) {
            .card {
                width: 80%;
            }
        }

        @media screen and (min-width: 769px) and (max-width: 1024px) {
            .card {
                width: 60%;
            }
        }

        @media screen and (min-width: 1025px) {
            .card {
                width: 30%;
            }
        }

        body {
            background-color: #547792 !important;
        }

        .card {
            background-color: #E8E2DB !important;
        }
    </style>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="card shadow">
            <div class="card-header border-bottom-0 bg-transparent">
                <div class="d-flex flex-column text-center">
                    <p class="m-0 p-0">ܓܘܙܕܩܐ</p>
                    <h5>LOGIN SISWA</h5>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('bootstrap.post.login') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username"
                            placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                    </div>
                    <div class="d-flex flex-column align-items-center text-center">
                        <button type="submit" class="btn w-50" style="background: #1A3263; color:#fff">Login</button>
                        <a class="text-decoration-none link-primary mt-3" style="font-size: 14px"
                            href="{{ route('no-bootstrap.login') }}">Login
                            sebagai
                            karyawan?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
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
