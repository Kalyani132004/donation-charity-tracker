@extends('layouts.app')

@section('title', 'Donor-wise Report')

@section('content')

<x-page-header title="Donor-wise Report">
    <x-slot:action>
        <button onclick="window.print()" class="btn btn-outline-secondary no-print"><i class="bi bi-printer"></i> Print</button>
    </x-slot:action>
</x-page-header>

<div class="card mb-3 no-print">
    <div class="card-body">
        <form action="{{ route('reports.donor-wise') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-6 col-md-3">
                <label class="form-label small text-muted mb-1">Donor</label>
                <select name="donor_id" class="form-select">
                    <option value="">All Donors</option>
                    @foreach ($donors as $donor)
                        <option value="{{ $donor->id }}" {{ request('donor_id') == $donor->id ? 'selected' : '' }}>{{ $donor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3">
                <label class="form-label small text-muted mb-1">From Date</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
            </div>
            <div class="col-6 col-md-3">
                <label class="form-label small text-muted mb-1">To Date</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
            </div>
            <div class="col-6 col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-secondary flex-fill">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('reports.donor-wise') }}" class="btn btn-outline-secondary flex-fill">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Donor Name</th><th>Number of Donations</th><th>Total Amount</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>{{ $row->donor_name }}</td>
                        <td>{{ $row->total_donations }}</td>
                        <td class="text-amount">₹{{ number_format($row->total_amount, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3"><x-empty-state message="No data for the selected filters." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection