@extends('layouts.app')

@section('title', 'Causes')

@section('content')

<x-page-header title="Causes" subtitle="Manage donation causes">
    <x-slot:action>
        <a href="{{ route('causes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Cause
        </a>
    </x-slot:action>
</x-page-header>

<div class="row g-3">
    @forelse ($causes as $cause)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                @if ($cause->imageUrl())
                    <img src="{{ $cause->imageUrl() }}" alt="{{ $cause->name }}" style="width:100%;height:140px;object-fit:cover;">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title mb-1">{{ $cause->name }}</h5>
                        <x-badge :status="$cause->status" />
                    </div>
                    <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($cause->description, 90) }}</p>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>₹{{ number_format($cause->donations_sum_amount ?? 0, 2) }} raised</span>
                        <span class="text-muted">of ₹{{ number_format($cause->target_amount, 2) }}</span>
                    </div>
                    <div class="progress progress-thin mb-3">
                        <div class="progress-bar bg-success" style="width: {{ $cause->progressPercentage() }}%"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $cause->donations_count }} donations</small>
                        <div>
                            <a href="{{ route('causes.show', $cause) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('causes.edit', $cause) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            @if (auth()->user()->isAdmin())
                                <form action="{{ route('causes.destroy', $cause) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this cause?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><x-empty-state message="No causes added yet." /></div>
    @endforelse
</div>

<div class="mt-3">{{ $causes->links() }}</div>

@endsection
