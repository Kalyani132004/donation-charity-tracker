@extends('layouts.app')

@section('title', 'Edit Cause')

@section('content')

<x-page-header title="Edit Cause" :subtitle="$cause->name" />

<div class="card">
    <div class="card-body">
        <form action="{{ route('causes.update', $cause) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('causes._form')
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('causes.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Cause</button>
            </div>
        </form>
    </div>
</div>

@endsection