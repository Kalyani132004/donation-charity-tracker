@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-brand">
            <div class="auth-brand-icon"><i class="bi bi-heart-fill"></i></div>
            <h4 class="mb-1">Donation & Charity Tracker</h4>
            <p class="text-muted small mb-0">Manage donations. Track impact. Maintain transparency.</p>
        </div>

        <div class="auth-tabs">
            <a href="{{ route('login') }}" class="auth-tab active">Login</a>
            <a href="{{ route('register') }}" class="auth-tab">Sign up</a>
        </div>

        <x-alert type="danger" :message="$errors->first()" />

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center small text-muted mt-3 mb-0">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </p>

        <hr>
        <p class="small text-muted text-center mb-0">Demo — Admin: admin@example.com / password &nbsp;|&nbsp; Staff: staff@example.com / password</p>
    </div>
</div>
@endsection
