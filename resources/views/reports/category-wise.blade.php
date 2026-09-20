@extends('layouts.app')

@section('title', 'Financial Category Report')

@section('content')

<x-page-header title="Financial Category Report">
    <x-slot:action>
        <button onclick="window.print()" class="btn btn-outline-secondary no-print"><i class="bi bi-printer"></i> Print</button>
    </x-slot:action>
</x-page-header>

<div class="card mb-3 no-print">
    <div class="card-body">
        <form action="{{ route('reports.category-wise') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-outline-secondary flex-fill">Filter</button>
                <a href="{{ route('reports.category-wise') }}" class="btn btn-outline-secondary flex-fill">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Category</th><th>Number of Donations</th><th>Total Amount</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>{{ $row->financial_category }}</td>
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
