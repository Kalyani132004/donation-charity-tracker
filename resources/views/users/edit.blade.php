@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<x-page-header title="Edit User" :subtitle="$user->email" />

<div class="card">
    <div class="card-body">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            @include('users._form')
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</div>

@endsection
