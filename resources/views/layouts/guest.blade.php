<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="/images/logo.png">

        <title>Shopno</title>

        <!-- Bootstrap 5 (CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <style>
            .auth-bg {
                min-height: 100vh;
                background:
                    radial-gradient(1200px 600px at 10% 10%, rgba(13,110,253,.18), transparent 60%),
                    radial-gradient(900px 500px at 90% 20%, rgba(25,135,84,.16), transparent 55%),
                    radial-gradient(900px 500px at 20% 90%, rgba(111,66,193,.14), transparent 55%),
                    linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
            }
            .auth-card {
                border: 0;
                border-radius: 1rem;
                box-shadow: 0 20px 50px rgba(15, 23, 42, .12);
            }
            .auth-brand {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: rgba(13,110,253,.12);
                color: #0d6efd;
                font-weight: 700;
                letter-spacing: .5px;
            }
        </style>

        <div class="auth-bg d-flex align-items-center">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-7 col-lg-5">
                        <div class="text-center mb-4">
                        <div class="auth-brand mb-3">
                            <img src="/images/logo.png"
                                alt="Logo"
                                width="80"
                                class="rounded-circle">
                            </div>
                            <div class="h4 mb-1">Shopno</div>
                            <div class="text-secondary small">Sign in to manage your inventory</div>
                        </div>

                        <div class="card auth-card">
                            <div class="card-body p-4 p-md-5">
                                {{ $slot }}
                            </div>
                        </div>

                        <div class="text-center text-secondary small mt-4">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
