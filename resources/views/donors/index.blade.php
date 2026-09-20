@extends('layouts.app')

@section('title', 'Donors')

@section('content')

<x-page-header title="Donors" subtitle="Manage donor records">
    <x-slot:action>
        <a href="{{ route('donors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Donor
        </a>
    </x-slot:action>
</x-page-header>

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('donors.index') }}" method="GET" class="row g-2">
            <div class="col-md-8">
                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by name, email, phone or donor code">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-secondary w-100">Search</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('donors.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Donations</th>
                    <th>Total Donated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donors as $donor)
                    <tr>
                        <td>{{ $donor->donor_code }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if ($donor->photoUrl())
                                    <img src="{{ $donor->photoUrl() }}" alt="{{ $donor->name }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                @else
                                    <div style="width:32px;height:32px;border-radius:50%;background:#e3e7ed;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-person small text-muted"></i>
                                    </div>
                                @endif
                                <a href="{{ route('donors.show', $donor) }}">{{ $donor->name }}</a>
                            </div>
                        </td>
                        <td>
                            {{ $donor->email ?? '—' }}<br>
                            <small class="text-muted">{{ $donor->phone ?? '—' }}</small>
                        </td>
                        <td>{{ $donor->donations_count }}</td>
                        <td class="text-amount">₹{{ number_format($donor->donations_sum_amount ?? 0, 2) }}</td>
                        <td>
                            <a href="{{ route('donors.show', $donor) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('donors.edit', $donor) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('donors.destroy', $donor) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this donor? This also removes their donations.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><x-empty-state message="No donors found." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($donors->hasPages())
        <div class="card-footer bg-white">
            {{ $donors->links() }}
        </div>
    @endif
</div>

@endsection
