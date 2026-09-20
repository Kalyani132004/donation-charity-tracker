@extends('layouts.app')

@section('title', 'Donations')

@section('content')

<x-page-header title="Donations" subtitle="Record and manage donations">
    <x-slot:action>
        <a href="{{ route('donations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Record Donation
        </a>
    </x-slot:action>
</x-page-header>

@if (session('new_donation_id'))
    <div class="alert alert-success d-flex justify-content-between align-items-center">
        <span>Donation recorded successfully. Receipt: {{ \App\Models\Donation::find(session('new_donation_id'))->receipt_number ?? '' }}</span>
        <div>
            <a href="{{ route('receipts.show', session('new_donation_id')) }}" class="btn btn-sm btn-outline-success">View Receipt</a>
            <a href="{{ route('receipts.show', session('new_donation_id')) }}?print=1" class="btn btn-sm btn-success">Print Receipt</a>
        </div>
    </div>
@endif

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('donations.index') }}" method="GET" class="row g-2">
            <div class="col-md-2">
                <select name="donor_id" class="form-select">
                    <option value="">All Donors</option>
                    @foreach ($donors as $donor)
                        <option value="{{ $donor->id }}" {{ request('donor_id') == $donor->id ? 'selected' : '' }}>{{ $donor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="cause_id" class="form-select">
                    <option value="">All Causes</option>
                    @foreach ($causes as $cause)
                        <option value="{{ $cause->id }}" {{ request('cause_id') == $cause->id ? 'selected' : '' }}>{{ $cause->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="donation_mode" class="form-select">
                    <option value="">All Modes</option>
                    @foreach (\App\Models\Donation::DONATION_MODES as $mode)
                        <option value="{{ $mode }}" {{ request('donation_mode') === $mode ? 'selected' : '' }}>{{ $mode }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control" placeholder="From">
            </div>
            <div class="col-md-2">
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control" placeholder="To">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-outline-secondary flex-fill">Filter</button>
                <a href="{{ route('donations.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Receipt No.</th>
                    <th>Donor</th>
                    <th>Cause</th>
                    <th>Amount</th>
                    <th>Mode</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donations as $donation)
                    <tr>
                        <td>{{ $donation->receipt_number }}</td>
                        <td>{{ $donation->donor->name }}</td>
                        <td>{{ $donation->cause->name }}</td>
                        <td class="text-amount">₹{{ number_format($donation->amount, 2) }}</td>
                        <td>{{ $donation->donation_mode }}</td>
                        <td>{{ $donation->financial_category }}</td>
                        <td>{{ $donation->donation_date->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('receipts.show', $donation) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-receipt"></i></a>
                            <a href="{{ route('donations.edit', $donation) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('donations.destroy', $donation) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this donation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8"><x-empty-state message="No donations found." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($donations->hasPages())
        <div class="card-footer bg-white">{{ $donations->links() }}</div>
    @endif
</div>

@endsection
