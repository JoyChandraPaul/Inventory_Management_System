<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/images/logo.png">

    <title>Sales Inventory App</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-box {
            background: white;
            border-radius: 20px;
            padding: 60px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .btn-custom {
            padding: 10px 30px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="container hero">
        <div class="row justify-content-center w-100">
            <div class="col-lg-8">

                <div class="hero-box text-center">

                    <h1 class="display-4 fw-bold mb-3">
                        Sales Inventory Management
                    </h1>

                    <p class="lead text-muted mb-4">
                        Manage Products, Customers, Sales and Inventory Easily.
                    </p>

                    <div class="mb-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
                            alt="Inventory"
                            width="140">
                    </div>

                    @if (Route::has('login'))

                        <div class="d-flex justify-content-center gap-3">

                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-custom">
                                    Login
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-dark btn-custom">
                                        Register
                                    </a>
                                @endif
                            @endauth

                        </div>

                    @endif

                </div>

            </div>
        </div>
    </div>

</body>

</html>