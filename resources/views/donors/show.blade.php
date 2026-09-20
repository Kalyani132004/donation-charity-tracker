@extends('layouts.app')

@section('title', 'Donor Details')

@section('content')

<x-page-header title="{{ $donor->name }}" subtitle="{{ $donor->donor_code }}">
    <x-slot:action>
        <a href="{{ route('donors.edit', $donor) }}" class="btn btn-outline-secondary">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </x-slot:action>
</x-page-header>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Total Amount Donated</div>
            <div class="stat-value text-amount">₹{{ number_format($donor->totalDonated(), 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Number of Donations</div>
            <div class="stat-value">{{ $donor->donations()->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="stat-label mb-2">Donor Information</div>
                <p class="mb-1"><i class="bi bi-envelope"></i> {{ $donor->email ?? '—' }}</p>
                <p class="mb-1"><i class="bi bi-telephone"></i> {{ $donor->phone ?? '—' }}</p>
                <p class="mb-0"><i class="bi bi-geo-alt"></i> {{ trim(($donor->city ?? '') . ', ' . ($donor->state ?? ''), ', ') ?: '—' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white fw-semibold">Donation History</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr><th>Receipt No.</th><th>Cause</th><th>Amount</th><th>Mode</th><th>Date</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($donations as $donation)
                    <tr>
                        <td>{{ $donation->receipt_number }}</td>
                        <td>{{ $donation->cause->name }}</td>
                        <td class="text-amount">₹{{ number_format($donation->amount, 2) }}</td>
                        <td>{{ $donation->donation_mode }}</td>
                        <td>{{ $donation->donation_date->format('d M Y') }}</td>
                        <td><a href="{{ route('receipts.show', $donation) }}" class="btn btn-sm btn-outline-secondary">Receipt</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6"><x-empty-state message="No donations recorded for this donor yet." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($donations->hasPages())
        <div class="card-footer bg-white">{{ $donations->links() }}</div>
    @endif
</div>

@endsection
