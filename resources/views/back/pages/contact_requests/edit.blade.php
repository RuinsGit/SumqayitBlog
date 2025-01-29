@extends('back.layouts.master')

@section('title', 'Edit Contact Request')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1>Edit Contact Request</h1>
        <form action="{{ route('back.pages.contact_requests.update', $contactRequest->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $contactRequest->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $contactRequest->email }}" required>
            </div>
            <div class="form-group">
                <label for="number">Number</label>
                <input type="text" class="form-control" id="number" name="number" value="{{ $contactRequest->number }}" required>
            </div>
            <div class="form-group">
                <label for="text">Message</label>
                <textarea class="form-control" id="text" name="text" required>{{ $contactRequest->text }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection 