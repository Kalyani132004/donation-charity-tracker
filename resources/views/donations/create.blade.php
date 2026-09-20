@extends('layouts.app')

@section('title', 'Record Donation')

@section('content')

<x-page-header title="Record Donation" subtitle="Donation Details" />

<div class="card">
    <div class="card-body">
        <form action="{{ route('donations.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Donor *</label>
                    <select name="donor_id" class="form-select @error('donor_id') is-invalid @enderror" required>
                        <option value="">Select Donor</option>
                        @foreach ($donors as $donor)
                            <option value="{{ $donor->id }}" {{ old('donor_id') == $donor->id ? 'selected' : '' }}>{{ $donor->name }} ({{ $donor->donor_code }})</option>
                        @endforeach
                    </select>
                    @error('donor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cause *</label>
                    <select name="cause_id" class="form-select @error('cause_id') is-invalid @enderror" required>
                        <option value="">Select Cause</option>
                        @foreach ($causes as $cause)
                            <option value="{{ $cause->id }}" {{ old('cause_id') == $cause->id ? 'selected' : '' }}>{{ $cause->name }}</option>
                        @endforeach
                    </select>
                    @error('cause_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Amount (₹) *</label>
                    <input type="number" step="0.01" min="0.01" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror" required>
                    @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Donation Mode *</label>
                    <select name="donation_mode" class="form-select @error('donation_mode') is-invalid @enderror" required>
                        <option value="">Select</option>
                        @foreach ($donationModes as $mode)
                            <option value="{{ $mode }}" {{ old('donation_mode') === $mode ? 'selected' : '' }}>{{ $mode }}</option>
                        @endforeach
                    </select>
                    @error('donation_mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Financial Category *</label>
                    <select name="financial_category" class="form-select @error('financial_category') is-invalid @enderror" required>
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ old('financial_category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @error('financial_category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Donation Date *</label>
                    <input type="date" name="donation_date" value="{{ old('donation_date', date('Y-m-d')) }}" class="form-control @error('donation_date') is-invalid @enderror" required>
                    @error('donation_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="2" class="form-control">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('donations.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Record Donation</button>
            </div>
        </form>
    </div>
</div>

@endsection
