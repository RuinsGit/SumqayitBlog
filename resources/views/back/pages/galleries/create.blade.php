@extends('back.layouts.master')

@section('title', 'Yeni Qalereya')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Qalereya</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.galleries.index') }}">Qalereya</a></li>
                                <li class="breadcrumb-item active">Yeni</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.galleries.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Image Upload Section -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Əsas Şəkil (600x338)</label>
                                            <input type="file" name="main_image" class="form-control @error('main_image') is-invalid @enderror" required>
                                            @error('main_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq</label>
                                            <input type="text" name="title_az" id="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ old('title_az') }}" required>
                                            @error('title_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mətn</label>
                                            <textarea name="description_az" class="form-control @error('description_az') is-invalid @enderror" rows="4" required>{{ old('description_az') }}</textarea>
                                            @error('description_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Əsas Şəkil ALT</label>
                                            <input type="text" name="main_image_alt_az" class="form-control @error('main_image_alt_az') is-invalid @enderror" value="{{ old('main_image_alt_az') }}" required>
                                            @error('main_image_alt_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Başlıq</label>
                                            <input type="text" name="meta_title_az" class="form-control" value="{{ old('meta_title_az') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Açıqlama</label>
                                            <textarea name="meta_description_az" class="form-control" rows="3">{{ old('meta_description_az') }}</textarea>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}" required>
                                            @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="4" required>{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Main Image ALT</label>
                                            <input type="text" name="main_image_alt_en" class="form-control @error('main_image_alt_en') is-invalid @enderror" value="{{ old('main_image_alt_en') }}" required>
                                            @error('main_image_alt_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title_en" class="form-control" value="{{ old('meta_title_en') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="meta_description_en" class="form-control" rows="3">{{ old('meta_description_en') }}</textarea>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок</label>
                                            <input type="text" name="title_ru" id="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ old('title_ru') }}" required>
                                            @error('title_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Описание</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="4" required>{{ old('description_ru') }}</textarea>
                                            @error('description_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ALT главного изображения</label>
                                            <input type="text" name="main_image_alt_ru" class="form-control @error('main_image_alt_ru') is-invalid @enderror" value="{{ old('main_image_alt_ru') }}" required>
                                            @error('main_image_alt_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-заголовок</label>
                                            <input type="text" name="meta_title_ru" class="form-control" value="{{ old('meta_title_ru') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-описание</label>
                                            <textarea name="meta_description_ru" class="form-control" rows="3">{{ old('meta_description_ru') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.galleries.index') }}" class="btn btn-secondary">Ləğv et</a>
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