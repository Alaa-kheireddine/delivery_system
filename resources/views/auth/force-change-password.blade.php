<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <form action="{{ route('password.force-change.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
            >

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Change Password
        </button>
    </form>
</body>
</html>