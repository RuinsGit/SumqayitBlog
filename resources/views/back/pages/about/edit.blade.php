@extends('back.layouts.master')

@section('title', 'Haqqımızda Redaktə et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Haqqımızda Redaktə et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.about.index') }}">Haqqımızda</a></li>
                                <li class="breadcrumb-item active">Redaktə et</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('back.pages.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

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
                                <div class="tab-content p-3 text-muted">
                                    <!-- Az tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label for="special_title_az" class="form-label">Xüsusi Başlıq (AZ):</label>
                                            <input type="text" class="form-control" name="special_title_az" value="{{ $about->special_title_az }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_az" class="form-label">Başlıq (AZ):</label>
                                            <input type="text" class="form-control" name="title_az" value="{{ $about->title_az }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description_az" class="form-label">Təsvir (AZ):</label>
                                            <textarea class="form-control summernote" name="description_az" rows="4" required>{{ $about->description_az }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="text_az" class="form-label">Ana Səhifə Mətni (AZ):</label>
                                            <textarea class="form-control" name="text_az" rows="4">{{ $about->text_az }}</textarea>
                                        </div>
                                    </div>

                                    <!-- En tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label for="special_title_en" class="form-label">Özel Başlık (EN):</label>
                                            <input type="text" class="form-control" name="special_title_en" value="{{ $about->special_title_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_en" class="form-label">Başlık (EN):</label>
                                            <input type="text" class="form-control" name="title_en" value="{{ $about->title_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description_en" class="form-label">Açıklama (EN):</label>
                                            <textarea class="form-control summernote" name="description_en" rows="4" required>{{ $about->description_en }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="text_en" class="form-label">Home Page Text (EN):</label>
                                            <textarea class="form-control" name="text_en" rows="4">{{ $about->text_en }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Ru tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label for="special_title_ru" class="form-label">Özel Başlık (RU):</label>
                                            <input type="text" class="form-control" name="special_title_ru" value="{{ $about->special_title_ru }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_ru" class="form-label">Başlık (RU):</label>
                                            <input type="text" class="form-control" name="title_ru" value="{{ $about->title_ru }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description_ru" class="form-label">Açıklama (RU):</label>
                                            <textarea class="form-control summernote" name="description_ru" rows="4" required>{{ $about->description_ru }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="text_ru" class="form-label">Текст главной страницы (RU):</label>
                                            <textarea class="form-control" name="text_ru" rows="4">{{ $about->text_ru }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Şəkil:</label>
                                    @if($about->image)
                                        <div class="mb-2">
                                            <img src="{{ asset($about->image) }}" alt="Mövcud Şəkil" style="max-width: 200px; height: auto;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="image" accept=".jpeg,.png,.jpg,.gif,.svg">
                                </div>

                                <div class="mb-3">
                                    <label for="document_file" class="form-label">Sənəd:</label>
                                    @if($about->document_file)
                                        <div class="mb-2">
                                            <a href="{{ asset($about->document_file) }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-file-download"></i> Mövcud Sənədi Gör
                                            </a>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="document_file" accept=".pdf,.doc,.docx">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.about.index') }}" class="btn btn-secondary">Ləğv et</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @endpush

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
    @endpush
@endsection 