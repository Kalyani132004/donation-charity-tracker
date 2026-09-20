@extends('layouts.app')

@section('title', 'Add Donor')

@section('content')

<x-page-header title="Add Donor" subtitle="Create a new donor record" />

<div class="card">
    <div class="card-body">
        <form action="{{ route('donors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('donors._form')
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('donors.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Donor</button>
            </div>
        </form>
    </div>
</div>

@endsection