@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Yeni İletişim Mesajı Gönder</h1>

    <form action="{{ route('contact_marketing.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">İsim</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Mesaj</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
    </form>
</div>
@endsection 