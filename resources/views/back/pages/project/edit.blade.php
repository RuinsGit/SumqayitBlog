@extends('back.layouts.master')

@section('title', 'Layihə Redaktə')

@section('content')

<style>
        .swal2-popup {
            border-radius: 50px;
        }
        .editable-div {
            min-height: 100px;
            padding: 0.5rem;
            overflow-y: auto;
        }
        .editable-div:focus {
            outline: 1px solid #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .cke_notifications_area {
            display: none !important;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Layihə Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.projects.index') }}">Layihələr</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Əsas Şəkil (1224x471)</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($project->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $project->image) }}" alt="" class="img-fluid" style="max-height: 100px">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Yaradılma Tarixi</label>
                                            <input type="datetime-local" name="created_at" class="form-control" 
                                                   value="{{ old('created_at', $project->created_at->format('Y-m-d\TH:i')) }}"
                                                   placeholder="Boş buraxılsa cari tarix qeyd olunacaq">
                                            <small class="text-muted">Boş buraxılsa avtomatik cari tarix qeyd olunacaq</small>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <i class="fas fa-language me-2"></i>AZ
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <i class="fas fa-language me-2"></i>EN
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <i class="fas fa-language me-2"></i>RU
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane fade show active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq</label>
                                            <input type="text" name="title_az" id="title_az" value="{{ $project->title_az }}" class="form-control @error('title_az') is-invalid @enderror" required>
                                            @error('title_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug_az" id="slug_az" value="{{ $project->slug_az }}" class="form-control @error('slug_az') is-invalid @enderror">
                                            @error('slug_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Mətn</label>
                                            <textarea name="text_az" class="form-control @error('text_az') is-invalid @enderror" rows="4" required>{{ $project->text_az }}</textarea>
                                            @error('text_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Açıqlama</label>
                                            <textarea name="description_az" id="description_az" class="form-control" rows="4">{{ old('description_az', $project->description_az) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Şəkil ALT</label>
                                            <input type="text" name="image_alt_az" value="{{ $project->image_alt_az }}" class="form-control @error('image_alt_az') is-invalid @enderror" required>
                                            @error('image_alt_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Meta Başlıq</label>
                                            <input type="text" name="meta_title_az" value="{{ $project->meta_title_az }}" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Meta Açıqlama</label>
                                            <textarea name="meta_description_az" class="form-control" rows="3">{{ $project->meta_description_az }}</textarea>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane fade" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title_en" id="title_en" value="{{ $project->title_en }}" class="form-control @error('title_en') is-invalid @enderror" required>
                                            @error('title_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug_en" id="slug_en" value="{{ $project->slug_en }}" class="form-control @error('slug_en') is-invalid @enderror">
                                            @error('slug_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Text</label>
                                            <textarea name="text_en" class="form-control @error('text_en') is-invalid @enderror" rows="4" required>{{ $project->text_en }}</textarea>
                                            @error('text_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description_en" id="description_en" class="form-control" rows="4">{{ old('description_en', $project->description_en) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Image ALT</label>
                                            <input type="text" name="image_alt_en" value="{{ $project->image_alt_en }}" class="form-control @error('image_alt_en') is-invalid @enderror" required>
                                            @error('image_alt_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title_en" value="{{ $project->meta_title_en }}" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="meta_description_en" class="form-control" rows="3">{{ $project->meta_description_en }}</textarea>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane fade" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок</label>
                                            <input type="text" name="title_ru" id="title_ru" value="{{ $project->title_ru }}" class="form-control @error('title_ru') is-invalid @enderror" required>
                                            @error('title_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug_ru" id="slug_ru" value="{{ $project->slug_ru }}" class="form-control @error('slug_ru') is-invalid @enderror">
                                            @error('slug_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Текст</label>
                                            <textarea name="text_ru" class="form-control @error('text_ru') is-invalid @enderror" rows="4" required>{{ $project->text_ru }}</textarea>
                                            @error('text_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Описание</label>
                                            <textarea name="description_ru" id="description_ru" class="form-control" rows="4">{{ old('description_ru', $project->description_ru) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">ALT изображения</label>
                                            <input type="text" name="image_alt_ru" value="{{ $project->image_alt_ru }}" class="form-control @error('image_alt_ru') is-invalid @enderror" required>
                                            @error('image_alt_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Мета-заголовок</label>
                                            <input type="text" name="meta_title_ru" value="{{ $project->meta_title_ru }}" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Мета-описание</label>
                                            <textarea name="meta_description_ru" class="form-control" rows="3">{{ $project->meta_description_ru }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save me-2"></i>Yadda saxla
                                    </button>
                                    <a href="{{ route('back.pages.projects.index') }}" class="btn btn-light">
                                        <i class="fas fa-arrow-left me-2"></i>Geri Dön
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <script>
    CKEDITOR.replace('description_az');
    CKEDITOR.replace('description_en');
    CKEDITOR.replace('description_ru');
    
    document.addEventListener('DOMContentLoaded', function() {
        const slugify = (text) => {
            let trMap = {
                'çÇ':'c',
                'ğĞ':'g',
                'şŞ':'s',
                'üÜ':'u',
                'ıİ':'i',
                'öÖ':'o',
                'əƏ':'e',
                'ёЁ':'yo',
                'йЙ':'i',
                'щЩ':'sh',
                'юЮ':'yu',
                'яЯ':'ya'
            };
            for(let key in trMap) {
                text = text.replace(new RegExp('['+key+']','g'), trMap[key]);
            }
            return text
                .toLowerCase()
                .replace(/[^-a-zA-Z0-9\s]+/ig, '') 
                .replace(/\s/gi, "-") 
                .replace(/-+/g, "-") 
                .trim();
        };

        ['az', 'en', 'ru'].forEach(lang => {
            const titleInput = document.getElementById(`title_${lang}`);
            const slugInput = document.getElementById(`slug_${lang}`);
            
            titleInput.addEventListener('keyup', function() {
                if (!slugInput.value || slugInput.value === slugify(this.value)) {
                    slugInput.value = slugify(this.value);
                }
            });

            slugInput.addEventListener('keyup', function() {
                this.value = slugify(this.value);
            });
        });
    });
    </script>
    @endpush
@endsection 