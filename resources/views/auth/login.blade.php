<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery System Login</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #111827;
        }

        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
        }

        .auth-left {
            background: linear-gradient(
                                180deg,
                                rgb(26, 67, 84) 0%,
                                rgb(35, 88, 110) 55%,
                                rgb(38, 94, 118) 100%
                            );
            color: white;
            padding: 64px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .hero-content {
            max-width: 540px;
        }

        .hero-content h1 {
            font-size: 48px;
            line-height: 1.1;
            margin-bottom: 18px;
        }

        .hero-content p {
            font-size: 17px;
            line-height: 1.7;
            color: #d1d5db;
        }

        .auth-footer {
            font-size: 13px;
            color: #9ca3af;
        }

        .auth-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #ffffff;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .login-box h2 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .login-box .subtitle {
            color: #6b7280;
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        input {
            width: 100%;
            height: 48px;
            padding: 0 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #111827;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        .login-button {
            width: 100%;
            height: 48px;
            margin-top: 8px;
            border: none;
            border-radius: 10px;
            background: #111827;
            color: white;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
        }

        .login-button:hover {
            background: #000000;
        }

        .small-note {
            margin-top: 22px;
            text-align: center;
            color: #6b7280;
            font-size: 13px;
        }

        @media (max-width: 850px) {
            .auth-page {
                grid-template-columns: 1fr;
            }

            .auth-left {
                display: none;
            }

            .auth-right {
                min-height: 100vh;
            }
        }
    </style>
</head>
<body>

<div class="auth-page">

    <section class="auth-left">
        <div class="brand">
            Delivery System
        </div>

        <div class="hero-content">
            <h1>Manage shipments with clarity and control.</h1>
            <p>
                Track branches, users, shipments, payments, and daily operations
                from one simple internal dashboard.
            </p>
        </div>

        <div class="auth-footer">
            © {{ date('Y') }} Delivery System. All rights reserved.
        </div>
    </section>

    <section class="auth-right">
        <div class="login-box">
            <h2>Sign in</h2>
            <p class="subtitle">Enter your account details to continue.</p>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address</label>

                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="admin@example.com"
                            required
                            autofocus
                        >

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>

                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter password"
                            required
                        >

                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            onclick="togglePassword('password', this)"
                        >
                            <i class="bi bi-eye"></i>
                        </button>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-dark btn-lg w-100 fw-bold rounded-3">
                    Login
                </button>
            </form>

            <p class="small-note">
                Access is limited to authorized system users only.
            </p>
        </div>
    </section>

</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
</body>
</html>
