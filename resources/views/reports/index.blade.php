@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<x-page-header title="Reports" subtitle="Choose a report to view" />

<div class="row g-3">
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.donor-wise') }}" class="text-decoration-none">
            <div class="card h-100"><div class="card-body">
                <i class="bi bi-person fs-3 text-primary"></i>
                <h5 class="mt-2">Donor-wise Report</h5>
                <p class="text-muted small mb-0">Donations grouped by donor.</p>
            </div></div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.cause-wise') }}" class="text-decoration-none">
            <div class="card h-100"><div class="card-body">
                <i class="bi bi-flag fs-3 text-primary"></i>
                <h5 class="mt-2">Cause-wise Report</h5>
                <p class="text-muted small mb-0">Donations grouped by cause.</p>
            </div></div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.mode-wise') }}" class="text-decoration-none">
            <div class="card h-100"><div class="card-body">
                <i class="bi bi-credit-card fs-3 text-primary"></i>
                <h5 class="mt-2">Donation Mode Report</h5>
                <p class="text-muted small mb-0">Donations grouped by payment mode.</p>
            </div></div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.category-wise') }}" class="text-decoration-none">
            <div class="card h-100"><div class="card-body">
                <i class="bi bi-tags fs-3 text-primary"></i>
                <h5 class="mt-2">Financial Category Report</h5>
                <p class="text-muted small mb-0">Donations grouped by financial category.</p>
            </div></div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.date-wise') }}" class="text-decoration-none">
            <div class="card h-100"><div class="card-body">
                <i class="bi bi-calendar3 fs-3 text-primary"></i>
                <h5 class="mt-2">Date-wise Report</h5>
                <p class="text-muted small mb-0">Donations grouped by date.</p>
            </div></div>
        </a>
    </div>
</div>

@endsection
