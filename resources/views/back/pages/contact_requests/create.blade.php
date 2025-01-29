@extends('back.layouts.master')

@section('title', 'Əlaqə Tələbi Yarat')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1>Əlaqə Tələbi Yarat</h1>
        <form action="{{ route('back.pages.contact_requests.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Ad</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="number">Nömrə</label>
                <input type="text" class="form-control" id="number" name="number" required>
            </div>
            <div class="form-group">
                <label for="text">Mesaj</label>
                <textarea class="form-control" id="text" name="text" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Təqdim et</button>
        </form>
    </div>
</div>
@endsection 