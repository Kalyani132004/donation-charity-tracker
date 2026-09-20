@extends('layouts.app')

@section('title', 'Add User')

@section('content')

<x-page-header title="Add Staff User" />

<div class="card">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('users._form')
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save User</button>
            </div>
        </form>
    </div>
</div>

@endsection
