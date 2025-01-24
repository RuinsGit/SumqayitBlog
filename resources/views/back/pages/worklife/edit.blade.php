@extends('back.layouts.master')

@section('title', 'Worklife Düzəlt')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h4 class="mb-0">Worklife Düzəlt</h4>

            <form action="{{ route('back.pages.worklife.update', $worklife->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="description_az" class="form-label">AZ</label>
                    <textarea name="description_az" id="description_az" class="form-control" required>{{ $worklife->description_az }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="description_en" class="form-label">EN</label>
                    <textarea name="description_en" id="description_en" class="form-control" required>{{ $worklife->description_en }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="description_ru" class="form-label">RU</label>
                    <textarea name="description_ru" id="description_ru" class="form-control" required>{{ $worklife->description_ru }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Yenilə</button>
                <a href="{{ route('back.pages.worklife.index') }}" class="btn btn-secondary">Geri Dön</a>
            </form>
        </div>
    </div>
@endsection 