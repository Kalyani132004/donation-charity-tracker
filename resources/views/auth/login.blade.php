@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="auth-decor" aria-hidden="true">
    <svg viewBox="0 0 220 140" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 130c40 10 90 5 130-15 30-15 55-15 90-2" stroke="#C99A4A" stroke-width="1.5" opacity="0.4"/>
        <path d="M10 120c15-25 10-45-5-55" stroke="#5c9274" stroke-width="3" stroke-linecap="round" fill="none"/>
        <ellipse cx="12" cy="95" rx="9" ry="15" fill="#7a9c85" opacity="0.55" transform="rotate(-25 12 95)"/>
        <ellipse cx="24" cy="80" rx="8" ry="13" fill="#5c9274" opacity="0.5" transform="rotate(10 24 80)"/>
        <ellipse cx="5" cy="70" rx="7" ry="12" fill="#3f7a5d" opacity="0.45" transform="rotate(-40 5 70)"/>
    </svg>
</div>

<div class="auth-page-center">

    <div class="auth-brand-block">
        <div class="auth-emblem">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="46" fill="none" stroke="#1b3b36" stroke-width="2" opacity="0.15"/>
                <path d="M50 40 L50 70" stroke="#3f7a5d" stroke-width="3" stroke-linecap="round"/>
                <path d="M50 55c-8-2-12-8-10-14 6 0 11 5 10 14z" fill="#5c9274"/>
                <path d="M50 55c8-2 12-8 10-14-6 0-11 5-10 14z" fill="#3f7a5d"/>
                <path d="M50 40c-2-4-7-5-9-1-2 3 0 6 9 11 9-5 11-8 9-11-2-4-7-3-9 1z" fill="#C99A4A"/>
                <path d="M22 70c0-6 5-10 12-10 4 0 7 2 9 5-3 8-10 13-18 13-2-3-3-5-3-8z" fill="#7a9c85"/>
                <path d="M78 70c0-6-5-10-12-10-4 0-7 2-9 5 3 8 10 13 18 13 2-3 3-5 3-8z" fill="#5c9274"/>
            </svg>
        </div>
        <h1 class="auth-brand-name">KindTrack</h1>
        <div class="auth-divider"></div>
        <p class="auth-brand-tagline">Manage donations. Track impact. Sustain giving.</p>

        <div class="role-grid">
            <div class="role-card">
                <span class="role-icon role-icon-admin"><i class="bi bi-shield-check"></i></span>
                <div>
                    <div class="role-name">Admin</div>
                    <div class="role-desc">Full access — donors, causes, reports and staff accounts.</div>
                </div>
            </div>
            <div class="role-card">
                <span class="role-icon role-icon-staff"><i class="bi bi-people-fill"></i></span>
                <div>
                    <div class="role-name">Staff</div>
                    <div class="role-desc">Record donations, manage donors and view reports.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-card">
        <div class="auth-tabs">
            <a href="{{ route('login') }}" class="auth-tab active">Login</a>
            <a href="{{ route('register') }}" class="auth-tab">Sign up</a>
        </div>

        <h4 class="auth-card-title">Welcome Back</h4>
        <p class="auth-card-subtitle">Sign in to your KindTrack account</p>

        <x-alert type="danger" :message="$errors->first()" />

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <div class="input-icon-group">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" class="form-control @error('email') is-invalid @enderror" required autofocus>
                </div>
                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Password *</label>
                <div class="input-icon-group">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" id="passwordField" placeholder="Enter your password" class="form-control" required>
                    <button type="button" class="input-icon-toggle" data-toggle-password="passwordField">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
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
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const field = document.getElementById(btn.dataset.togglePassword);
            const icon = btn.querySelector('i');
            const isHidden = field.type === 'password';
            field.type = isHidden ? 'text' : 'password';
            icon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    });
</script>
@endpush