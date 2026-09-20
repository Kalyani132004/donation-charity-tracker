@extends('layouts.app')

@section('title', auth()->user()->isAdmin() ? 'Admin Dashboard' : 'Staff Dashboard')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h4 class="mb-1">Welcome back, {{ auth()->user()->name }}</h4>
        <p class="text-muted mb-0">Here's what's happening with donations today.</p>
    </div>
    <x-badge :status="auth()->user()->role" />
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-label">Total Donors</div>
            <div class="stat-value">{{ $totalDonors }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-label">Total Donations</div>
            <div class="stat-value">{{ $totalDonations }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-label">Total Amount Collected</div>
            <div class="stat-value text-amount">₹{{ number_format($totalAmount, 2) }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-label">This Month's Amount</div>
            <div class="stat-value text-amount">₹{{ number_format($thisMonthAmount, 2) }}</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header bg-white fw-semibold">Monthly Donation Summary</div>
            <div class="card-body">
                <canvas id="monthlyChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header bg-white fw-semibold">Top Causes</div>
            <div class="card-body">
                @forelse ($topCauses as $cause)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>{{ $cause->name }}</span>
                            <span class="text-amount">₹{{ number_format($cause->donations_sum_amount ?? 0, 2) }}</span>
                        </div>
                        <div class="progress progress-thin">
                            <div class="progress-bar bg-success" style="width: {{ $cause->progressPercentage() }}%"></div>
                        </div>
                    </div>
                @empty
                    <x-empty-state message="No causes yet." />
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white fw-semibold">Donation Mode Summary</div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>Mode</th><th class="text-end">Amount</th></tr></thead>
                    <tbody>
                        @forelse ($modeSummary as $row)
                            <tr><td>{{ $row->donation_mode }}</td><td class="text-end text-amount">₹{{ number_format($row->total, 2) }}</td></tr>
                        @empty
                            <tr><td colspan="2"><x-empty-state message="No data yet." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white fw-semibold">Financial Category Summary</div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>Category</th><th class="text-end">Amount</th></tr></thead>
                    <tbody>
                        @forelse ($categorySummary as $row)
                            <tr><td>{{ $row->financial_category }}</td><td class="text-end text-amount">₹{{ number_format($row->total, 2) }}</td></tr>
                        @empty
                            <tr><td colspan="2"><x-empty-state message="No data yet." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
        Recent Donations
        <a href="{{ route('donations.index') }}" class="small">View all</a>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr><th>Receipt No.</th><th>Donor</th><th>Cause</th><th>Amount</th><th>Mode</th><th>Date</th></tr>
            </thead>
            <tbody>
                @forelse ($recentDonations as $donation)
                    <tr>
                        <td>{{ $donation->receipt_number }}</td>
                        <td>{{ $donation->donor->name }}</td>
                        <td>{{ $donation->cause->name }}</td>
                        <td class="text-amount">₹{{ number_format($donation->amount, 2) }}</td>
                        <td>{{ $donation->donation_mode }}</td>
                        <td>{{ $donation->donation_date->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6"><x-empty-state message="No donations recorded yet." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const monthlyLabels = {!! json_encode($monthlySummary->pluck('month')) !!};
    const monthlyTotals = {!! json_encode($monthlySummary->pluck('total')) !!};

    new Chart(document.getElementById('monthlyChart'), {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Amount Collected',
                data: monthlyTotals,
                backgroundColor: '#1e3a5f'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush
