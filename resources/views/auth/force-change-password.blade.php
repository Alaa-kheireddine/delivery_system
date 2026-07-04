<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.min.css') }}">

    <style>
        :root {
            --sidebar-bg: rgb(26, 67, 84);
            --sidebar-hover: rgb(38, 94, 118);
            --sidebar-active: rgb(35, 88, 110);
            --sidebar-border: #2e6650;
            --blue: #3c9e9e;
            --text-light: #a8c4b8;
            --body-bg: #f4f8f7;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--sidebar-bg), var(--sidebar-active));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            padding: 20px;
        }

        .password-card {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.22);
            border-top: 5px solid var(--blue);
        }

        .password-icon {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: rgba(60, 158, 158, 0.14);
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin: 0 auto 16px;
        }

        .password-title {
            color: var(--sidebar-bg);
            font-weight: 700;
            text-align: center;
            margin-bottom: 6px;
        }

        .password-subtitle {
            color: #6c757d;
            text-align: center;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .form-label {
            font-weight: 600;
            color: var(--sidebar-bg);
            font-size: 14px;
        }

        .form-control {
            border-radius: 12px;
            padding: 11px 14px;
            border: 1px solid #d7e3df;
        }

        .form-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 0.2rem rgba(60, 158, 158, 0.18);
        }

        .btn-change {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 12px;
            background: var(--blue);
            color: #fff;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn-change:hover {
            background: var(--sidebar-hover);
            color: #fff;
            transform: translateY(-1px);
        }

        .small-note {
            margin-top: 16px;
            font-size: 13px;
            color: #7a8b86;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="password-card">

        <div class="password-icon">
            <i class="bi bi-shield-lock"></i>
        </div>

        <h4 class="password-title">Change Your Password</h4>
        <p class="password-subtitle">
            For security reasons, please set a new password before continuing.
        </p>

        <form action="{{ route('password.force-change.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-key me-1"></i>New Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter new password"
                    required
                >

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label"><i class="bi bi-check-circle me-1"></i>Confirm Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Confirm new password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-change">
                Change Password
            </button>

            <div class="small-note">
                Use a strong password to keep your account secure.
            </div>
        </form>

    </div>

</body>
</html>