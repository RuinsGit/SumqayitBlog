@extends('back.layouts.master')

@section('title', 'Digital Marketing əlaqə')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Digital Marketing əlaqə Məzmunu</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('back.pages.contact_marketing.index') }}">Digital Marketing əlaqə</a></li>
                            <li class="breadcrumb-item active">Məzmun</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Mesaj Məzmunu</h5>
                <p><strong>Ad:</strong> {{ $contact->name }}</p>
                <p><strong>Email:</strong> {{ $contact->email }}</p>
                <p><strong>Mesaj:</strong> {{ $contact->message }}</p>
                <p><strong>Tarix:</strong> {{ $contact->created_at->format('d-m-Y H:i') }}</p>
                <a href="{{ route('back.pages.contact_marketing.index') }}" class="btn btn-secondary">Geri</a>
            </div>
        </div>
    </div>
</div>
@endsection 