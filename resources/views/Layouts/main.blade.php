<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@stack('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Syriac:wght@100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('sweetalert2/dist/sweetalert2.css') }}" />
    <style>
        body {
            padding-bottom: 2cm;
        }

        .noto-sans-syriac {
            font-family: "Noto Sans Syriac", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }

        .navbar-toggler-icon {
            color: white;
        }

        .navH:hover {
            font-weight: bold;
        }

        .active {
            font-weight: bold;
        }

        .breadcrumb a {
            color: #547792 !important;
        }

        .flatpickr-current-month .numInputWrapper {
            margin-left: 10px;
        }

        .numInputWrapper span.arrowUp,
        .numInputWrapper span.arrowDown {
            margin-left: 10px;
        }

        .flatpickr-current-month input.cur-year {
            border: 1px solid #E8E2DB;
            border-radius: 5px;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            border: 1px solid #E8E2DB;
            border-radius: 5px;
        }

        .flatpickr-current-month {
            height: 40px;
        }
    </style>
    @yield('css')
    @php
        $Auth = session()->get('_login');
    @endphp
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <nav class="navbar navbar-expand-lg" style="background: #1A3263;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="d-flex flex-column text-center">
                        <p class="m-0 p-0 text-light">ܓܘܙܕܩܐ</p>
                        @if ($Auth['role'] == 'admin')
                            <small class="text-light" style="font-size: 12px">Employee Management</small>
                        @else
                            <small class="text-light" style="font-size: 12px">Billing Management</small>
                        @endif
                    </div>
                </a>
                <button class="navbar-toggler border-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars text-light"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if ($Auth['role'] == 'student')
                            <li class="nav-item navH">
                                <a class="nav-link text-light" aria-current="page"
                                    href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                        @endif
                        @if ($Auth['role'] == 'admin')
                            <li class="nav-item navH">
                                <a class="nav-link text-light" href="{{ route('employee.index') }}">Employee</a>
                            </li>
                        @endif
                        <li class="nav-item navH">
                            <a class="nav-link text-light d-block d-lg-none" href="#">
                                Logout
                            </a>
                        </li>
                    </ul>
                    <div class="text-end d-none d-lg-block d-xl-block d-xxl-block">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropstart">
                                <a class="nav-link dropdown-toggle text-light" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $Auth['name'] }} <i class="fa-regular fa-circle-user"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item navH" href="{{ route('logout') }}">
                                            <i class="fa-solid fa-power-off"></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row m-0">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script src="{{ asset('sweetalert2/dist/sweetalert2.js') }}"></script>
    <script>
        $(document).ready(function() {
            var currentUrl = window.location.href;
            $('.nav-link').each(function() {
                let href = $(this).attr('href');
                if (href == currentUrl) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
