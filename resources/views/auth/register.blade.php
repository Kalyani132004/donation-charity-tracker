@extends('layouts.guest')

@section('title', 'Sign Up')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-brand">
            <div class="auth-brand-icon"><i class="bi bi-heart-fill"></i></div>
            <h4 class="mb-1">Donation & Charity Tracker</h4>
            <p class="text-muted small mb-0">Manage donations. Track impact. Maintain transparency.</p>
        </div>

        <div class="auth-tabs">
            <a href="{{ route('login') }}" class="auth-tab">Login</a>
            <a href="{{ route('register') }}" class="auth-tab active">Sign up</a>
        </div>

        <x-alert type="danger" :message="$errors->first()" />

        <form action="{{ route('register.attempt') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Create Account</button>
        </form>

        <p class="text-center small text-muted mt-3 mb-0">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </p>

        <hr>
        <p class="small text-muted text-center mb-0">New accounts are created with Staff access. Contact your Admin to change roles.</p>
    </div>
</div>
@endsection
