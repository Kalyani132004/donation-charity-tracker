@extends('layouts.app')

@section('title', 'Cause Details')

@section('content')

<x-page-header title="{{ $cause->name }}">
    <x-slot:action>
        <a href="{{ route('causes.edit', $cause) }}" class="btn btn-outline-secondary">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </x-slot:action>
</x-page-header>

<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-body">
                <p>{{ $cause->description ?: 'No description provided.' }}</p>
                <div class="d-flex justify-content-between small mb-1">
                    <span>₹{{ number_format($cause->totalCollected(), 2) }} raised</span>
                    <span class="text-muted">of ₹{{ number_format($cause->target_amount, 2) }} ({{ $cause->progressPercentage() }}%)</span>
                </div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-success" style="width: {{ $cause->progressPercentage() }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card h-100">
            <div class="stat-label">Number of Donations</div>
            <div class="stat-value">{{ $cause->donations()->count() }}</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white fw-semibold">Donations for this Cause</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Receipt No.</th><th>Donor</th><th>Amount</th><th>Mode</th><th>Date</th></tr></thead>
            <tbody>
                @forelse ($donations as $donation)
                    <tr>
                        <td>{{ $donation->receipt_number }}</td>
                        <td>{{ $donation->donor->name }}</td>
                        <td class="text-amount">₹{{ number_format($donation->amount, 2) }}</td>
                        <td>{{ $donation->donation_mode }}</td>
                        <td>{{ $donation->donation_date->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-empty-state message="No donations recorded for this cause yet." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($donations->hasPages())
        <div class="card-footer bg-white">{{ $donations->links() }}</div>
    @endif
</div>

@endsection
