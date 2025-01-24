@extends('back.layouts.master')

@section('title', 'Yeni Worklife Əlavə Et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h4 class="mb-0">Yeni Worklife Əlavə Et</h4>

            <form action="{{ route('back.pages.worklife.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="description_az" class="form-label">AZ</label>
                    <textarea name="description_az" id="description_az" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="description_en" class="form-label">EN</label>
                    <textarea name="description_en" id="description_en" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="description_ru" class="form-label">RU</label>
                    <textarea name="description_ru" id="description_ru" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Əlavə Et</button>
                <a href="{{ route('back.pages.worklife.index') }}" class="btn btn-secondary">Geri Dön</a>
            </form>
        </div>
    </div>
@endsection 