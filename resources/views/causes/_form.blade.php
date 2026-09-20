@php $cause = $cause ?? null; @endphp

<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Banner Image</label>
        <div class="d-flex align-items-center gap-3">
            @if ($cause && $cause->imageUrl())
                <img src="{{ $cause->imageUrl() }}" alt="{{ $cause->name }}" style="width:100px;height:60px;border-radius:6px;object-fit:cover;">
            @endif
            <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror" style="max-width:300px;">
        </div>
        @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">Cause Name *</label>
        <input type="text" name="name" value="{{ old('name', $cause->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Target Amount (₹) *</label>
        <input type="number" step="0.01" name="target_amount" value="{{ old('target_amount', $cause->target_amount ?? '') }}" class="form-control @error('target_amount') is-invalid @enderror" required>
        @error('target_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $cause->description ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status *</label>
        <select name="status" class="form-select">
            <option value="active" {{ old('status', $cause->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $cause->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
</div>