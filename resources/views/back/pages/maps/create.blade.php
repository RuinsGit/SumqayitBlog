@extends('back.layouts.master')

@section('title', 'Xəritə Əlavə Et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Xəritə Əlavə Et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.maps.index') }}">Xəritələr</a></li>
                                <li class="breadcrumb-item active">Xəritə Əlavə Et</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('back.pages.maps.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="description" class="form-label">Xəritə Linki:</label>
                                    <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Əlavə Et</button>
                                        <a href="{{ route('back.pages.maps.index') }}" class="btn btn-secondary">İptal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 