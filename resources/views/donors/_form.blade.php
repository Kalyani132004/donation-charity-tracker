@php $donor = $donor ?? null; @endphp

<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Photo</label>
        <div class="d-flex align-items-center gap-3">
            @if ($donor && $donor->photoUrl())
                <img src="{{ $donor->photoUrl() }}" alt="{{ $donor->name }}" style="width:60px;height:60px;border-radius:50%;object-fit:cover;">
            @else
                <div style="width:60px;height:60px;border-radius:50%;background:#e3e7ed;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-person fs-4 text-muted"></i>
                </div>
            @endif
            <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror" style="max-width:300px;">
        </div>
        @error('photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Name *</label>
        <input type="text" name="name" value="{{ old('name', $donor->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $donor->email ?? '') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $donor->phone ?? '') }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Address</label>
        <input type="text" name="address" value="{{ old('address', $donor->address ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">City</label>
        <input type="text" name="city" value="{{ old('city', $donor->city ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">State</label>
        <input type="text" name="state" value="{{ old('state', $donor->state ?? '') }}" class="form-control">
    </div>
</div>