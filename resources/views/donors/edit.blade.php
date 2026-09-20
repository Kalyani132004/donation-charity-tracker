@extends('layouts.app')

@section('title', 'Edit Donor')

@section('content')

<x-page-header title="Edit Donor" :subtitle="$donor->donor_code" />

<div class="card">
    <div class="card-body">
        <form action="{{ route('donors.update', $donor) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('donors._form')
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('donors.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Donor</button>
            </div>
        </form>
    </div>
</div>

@endsection