@extends('layouts.app')

@section('title', 'Receipt')

<!-- @push('scripts')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endpush -->

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <a href="{{ route('donations.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Donations</a>
    <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Print Receipt</button>
</div>

<div class="receipt-box">

    <div class="receipt-top">
        <div class="receipt-org">
            <h3 class="mb-1">Hope Foundation Charity Trust</h3>
            <p class="mb-0 text-muted small">123 MG Road, Pune, Maharashtra, India</p>
            <p class="mb-0 text-muted small">+91-98765-00000 &nbsp;|&nbsp; contact@hopefoundation.org</p>
        </div>
        <div class="receipt-meta">
            <table class="receipt-meta-table">
                <tr>
                    <td class="label">Receipt No.</td>
                    <td class="value">{{ $donation->receipt_number }}</td>
                </tr>
                <tr>
                    <td class="label">Date</td>
                    <td class="value">{{ $donation->donation_date->format('d M Y') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="receipt-title">
        <h4>Donation Receipt</h4>
    </div>

    <div class="receipt-columns">
        <div class="receipt-col">
            <div class="col-heading">Donor Details</div>
            <table class="receipt-info-table">
                <tr><td class="label">Name</td><td class="value">{{ $donation->donor->name }}</td></tr>
                <tr><td class="label">Email</td><td class="value">{{ $donation->donor->email ?? '—' }}</td></tr>
                <tr><td class="label">Phone</td><td class="value">{{ $donation->donor->phone ?? '—' }}</td></tr>
                <tr><td class="label">Donor Code</td><td class="value">{{ $donation->donor->donor_code }}</td></tr>
            </table>
        </div>
        <div class="receipt-col">
            <div class="col-heading">Donation Details</div>
            <table class="receipt-info-table">
                <tr><td class="label">Cause</td><td class="value">{{ $donation->cause->name }}</td></tr>
                <tr><td class="label">Category</td><td class="value">{{ $donation->financial_category }}</td></tr>
                <tr><td class="label">Mode</td><td class="value">{{ $donation->donation_mode }}</td></tr>
                <tr><td class="label">Notes</td><td class="value">{{ $donation->notes ?: '—' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="receipt-amount-box">
        <span class="amount-label">Total Amount Donated</span>
        <span class="amount-value">₹{{ number_format($donation->amount, 2) }}</span>
    </div>

    <p class="receipt-footnote">
        This receipt confirms the donation described above was received by Hope Foundation Charity Trust
        and is issued for the donor's records.
    </p>

    <div class="receipt-signature-row">
        <div class="thank-you">Thank you for your generous support.</div>
        <div class="signature-block">
            <div class="signature-line"></div>
            <div class="signature-caption">Authorized Signature</div>
        </div>
    </div>

</div>

@endsection