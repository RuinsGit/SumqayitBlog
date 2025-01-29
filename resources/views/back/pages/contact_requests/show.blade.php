@extends('back.layouts.master')

@section('title', 'Əlaqə Tələbi Təfərrüatları')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1>Əlaqə Tələbi Təfərrüatları</h1>
        <p><strong>Ad:</strong> {{ $contactRequest->name }}</p>
        <p><strong>Email:</strong> {{ $contactRequest->email }}</p>
        <p><strong>Nömrə:</strong> {{ $contactRequest->number }}</p>
        <p><strong>Mesaj:</strong> {{ $contactRequest->text }}</p>
        <p><strong>Status:</strong> {{ $contactRequest->status }}</p>
        <a href="{{ route('back.pages.contact_requests.index') }}" class="btn btn-secondary">Siyahıya Qayıt</a>
    </div>
</div>
@endsection 