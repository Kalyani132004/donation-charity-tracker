@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<x-page-header title="My Profile" subtitle="Manage your account details" />

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="d-flex align-items-center gap-3 mb-4">
                        @if ($user->photoUrl())
                            <img src="{{ $user->photoUrl() }}" alt="{{ $user->name }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;">
                        @else
                            <div style="width:80px;height:80px;border-radius:50%;background:#e3e7ed;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-person fs-1 text-muted"></i>
                            </div>
                        @endif
                        <div>
                            <label class="form-label mb-1">Profile Photo</label>
                            <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
                            @error('photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Leave blank to keep current">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <input type="text" value="{{ ucfirst($user->role) }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection