@extends('layouts.app')

@section('title', 'Add Cause')

@section('content')

<x-page-header title="Add Cause" subtitle="Create a new donation cause" />

<div class="card">
    <div class="card-body">
        <form action="{{ route('causes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('causes._form')
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('causes.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Cause</button>
            </div>
        </form>
    </div>
</div>

@endsection