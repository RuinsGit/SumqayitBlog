@extends('back.layouts.master')

@section('title', 'Video Qalereya Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Video Qalereya Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.gallery-videos.index') }}">Video Qalereya</a></li>
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
                            <form action="{{ route('back.pages.gallery-videos.update', $galleryVideo->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Video Upload Section -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Video</label>
                                            <input type="file" name="main_video" class="form-control @error('main_video') is-invalid @enderror" accept="video/mp4,video/quicktime">
                                            @error('main_video')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($galleryVideo->main_video)
                                            <div class="mt-2">
                                                <video width="200" controls>
                                                    <source src="{{ asset($galleryVideo->main_video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Video Thumbnail</label>
                                            <input type="file" name="main_video_thumbnail" class="form-control @error('main_video_thumbnail') is-invalid @enderror" accept="image/*">
                                            @error('main_video_thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($galleryVideo->main_video_thumbnail)
                                            <div class="mt-2">
                                                <img src="{{ asset($galleryVideo->main_video_thumbnail) }}" alt="Video Thumbnail" style="max-width: 200px;">
                                            </div>
                                            @endif
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
                                            <input type="text" name="title_az" id="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ old('title_az', $galleryVideo->title_az) }}" required>
                                            @error('title_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Başlıq</label>
                                            <input type="text" name="meta_title_az" class="form-control" value="{{ old('meta_title_az', $galleryVideo->meta_title_az) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Açıqlama</label>
                                            <textarea name="meta_description_az" class="form-control" rows="3">{{ old('meta_description_az', $galleryVideo->meta_description_az) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en', $galleryVideo->title_en) }}" required>
                                            @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title_en" class="form-control" value="{{ old('meta_title_en', $galleryVideo->meta_title_en) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="meta_description_en" class="form-control" rows="3">{{ old('meta_description_en', $galleryVideo->meta_description_en) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок</label>
                                            <input type="text" name="title_ru" id="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ old('title_ru', $galleryVideo->title_ru) }}" required>
                                            @error('title_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-заголовок</label>
                                            <input type="text" name="meta_title_ru" class="form-control" value="{{ old('meta_title_ru', $galleryVideo->meta_title_ru) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-описание</label>
                                            <textarea name="meta_description_ru" class="form-control" rows="3">{{ old('meta_description_ru', $galleryVideo->meta_description_ru) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.gallery-videos.index') }}" class="btn btn-secondary">Ləğv et</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        function addVideoInput() {
            const container = document.getElementById('additional-videos-container');
            const wrapper = document.createElement('div');
            wrapper.className = 'mb-2 position-relative';
            
            const videoInput = document.createElement('input');
            videoInput.type = 'file';
            videoInput.name = 'videos[]';
            videoInput.className = 'form-control mb-2';
            videoInput.accept = 'video/mp4,video/quicktime';
            
            const thumbnailInput = document.createElement('input');
            thumbnailInput.type = 'file';
            thumbnailInput.name = 'videos_thumbnail[]';
            thumbnailInput.className = 'form-control mb-2';
            thumbnailInput.accept = 'image/*';
            
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
            removeButton.innerHTML = '<i class="ri-delete-bin-line"></i>';
            removeButton.onclick = function() { this.closest('.mb-2').remove(); };
            
            wrapper.appendChild(videoInput);
            wrapper.appendChild(thumbnailInput);
            wrapper.appendChild(removeButton);
            container.appendChild(wrapper);
        }

        // Slug generation for each language
        document.addEventListener('DOMContentLoaded', function() {
            const slugify = (text) => {
                let trMap = {
                    'çÇ':'c',
                    'ğĞ':'g',
                    'şŞ':'s',
                    'üÜ':'u',
                    'ıİ':'i',
                    'öÖ':'o'
                };
                for(let key in trMap) {
                    text = text.replace(new RegExp('['+key+']','g'), trMap[key]);
                }
                return text
                    .toLowerCase()
                    .replace(/[^-a-zA-Z0-9\s]+/ig, '') // Remove non-alphanumeric chars
                    .replace(/\s/gi, "-") // Convert spaces to dashes
                    .replace(/-+/g, "-") // Remove consecutive dashes
                    .trim();
            };

            // For each language
            ['az', 'en', 'ru'].forEach(lang => {
                const titleInput = document.getElementById(`title_${lang}`);
                const slugInput = document.getElementById(`slug_${lang}`);
                
                titleInput.addEventListener('keyup', function() {
                    if (!slugInput.value || slugInput.value === slugify(this.value)) {
                        slugInput.value = slugify(this.value);
                    }
                });

                // Allow manual slug editing
                slugInput.addEventListener('keyup', function() {
                    this.value = slugify(this.value);
                });
            });
        });
    </script>
    @endpush
@endsection 