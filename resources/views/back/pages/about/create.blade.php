@extends('back.layouts.master')

@section('title', 'Yeni Haqqımızda')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Haqqımızda Əlavə Et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.about.index') }}">Haqqımızda</a></li>
                                <li class="breadcrumb-item active">Yeni</li>
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

                            @if($aboutCount >= 1)
                                <div class="alert alert-danger">
                                    Artıq bir haqqımızda mövcuddur. Yeni haqqımızda əlavə edə bilməzsiniz.
                                </div>
                            @else
                                <form action="{{ route('back.pages.about.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Tab başlıkları -->
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

                                    <!-- Tab içerikleri -->
                                    <div class="tab-content p-3 text-muted">
                                        <!-- AZ tab -->
                                        <div class="tab-pane active" id="az" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="special_title_az" class="form-label">Xüsusi Başlıq (AZ):</label>
                                                <input type="text" class="form-control" name="special_title_az" value="{{ old('special_title_az') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title_az" class="form-label">Başlıq (AZ):</label>
                                                <input type="text" class="form-control" name="title_az" value="{{ old('title_az') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description_az" class="form-label">Təsvir (AZ):</label>
                                                <textarea class="form-control" name="description_az" rows="4" required>{{ old('description_az') }}</textarea>
                                            </div>
                                        </div>

                                        <!-- EN tab -->
                                        <div class="tab-pane" id="en" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="special_title_en" class="form-label">Özel Başlık (EN):</label>
                                                <input type="text" class="form-control" name="special_title_en" value="{{ old('special_title_en') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title_en" class="form-label">Başlıq (EN):</label>
                                                <input type="text" class="form-control" name="title_en" value="{{ old('title_en') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description_en" class="form-label">Açıklama (EN):</label>
                                                <textarea class="form-control" name="description_en" rows="4" required>{{ old('description_en') }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Ru tab -->
                                        <div class="tab-pane" id="ru" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="special_title_ru" class="form-label">Özel Başlık (RU):</label>
                                                <input type="text" class="form-control" name="special_title_ru" value="{{ old('special_title_ru') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title_ru" class="form-label">Başlıq (RU):</label>
                                                <input type="text" class="form-control" name="title_ru" value="{{ old('title_ru') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description_ru" class="form-label">Açıklama (RU):</label>
                                                <textarea class="form-control" name="description_ru" rows="4" required>{{ old('description_ru') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Şəkil:</label>
                                        <input type="file" class="form-control" name="image" accept=".jpeg,.png,.jpg,.gif,.svg">
                                    </div>

                                    <div class="mb-3">
                                        <label for="document_file" class="form-label">Sənəd:</label>
                                        <input type="file" class="form-control" name="document_file" accept=".pdf,.doc,.docx">
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                            <a href="{{ route('back.pages.about.index') }}" class="btn btn-secondary">Ləğv et</a>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 