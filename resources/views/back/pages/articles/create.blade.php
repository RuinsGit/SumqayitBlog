@extends('back.layouts.master')

@section('title', 'Yeni Məqalə')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Yeni Məqalə</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('back.pages.articles.index') }}">Məqalələr</a></li>
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
                        <form action="{{ route('back.pages.articles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Ana Şəkil</label>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">AZ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">EN</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">RU</a>
                                </li>
                            </ul>

                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug_az" class="form-control @error('slug_az') is-invalid @enderror" value="{{ old('slug_az') }}">
                                        @error('slug_az')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Başlıq</label>
                                        <input type="text" name="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ old('title_az') }}" required>
                                        @error('title_az')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mətn</label>
                                        <textarea name="text_az" class="form-control @error('text_az') is-invalid @enderror" rows="4" required>{{ old('text_az') }}</textarea>
                                        @error('text_az')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Açıqlama</label>
                                        <textarea name="description_az" class="form-control summernote @error('description_az') is-invalid @enderror" rows="4">{{ old('description_az') }}</textarea>
                                        @error('description_az')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Şəkil ALT</label>
                                        <input type="text" name="image_alt_az" class="form-control @error('image_alt_az') is-invalid @enderror" value="{{ old('image_alt_az') }}" required>
                                        @error('image_alt_az')
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

                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug_en" class="form-control @error('slug_en') is-invalid @enderror" value="{{ old('slug_en') }}">
                                        @error('slug_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}" required>
                                        @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Text</label>
                                        <textarea name="text_en" class="form-control @error('text_en') is-invalid @enderror" rows="4" required>{{ old('text_en') }}</textarea>
                                        @error('text_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description_en" class="form-control summernote @error('description_en') is-invalid @enderror" rows="4">{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Main Image ALT</label>
                                        <input type="text" name="image_alt_en" class="form-control @error('image_alt_en') is-invalid @enderror" value="{{ old('image_alt_en') }}" required>
                                        @error('image_alt_en')
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

                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug_ru" class="form-control @error('slug_ru') is-invalid @enderror" value="{{ old('slug_ru') }}">
                                        @error('slug_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Заголовок</label>
                                        <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ old('title_ru') }}" required>
                                        @error('title_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Текст</label>
                                        <textarea name="text_ru" class="form-control @error('text_ru') is-invalid @enderror" rows="4" required>{{ old('text_ru') }}</textarea>
                                        @error('text_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Описание</label>
                                        <textarea name="description_ru" class="form-control summernote @error('description_ru') is-invalid @enderror" rows="4">{{ old('description_ru') }}</textarea>
                                        @error('description_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">ALT главного изображения</label>
                                        <input type="text" name="image_alt_ru" class="form-control @error('image_alt_ru') is-invalid @enderror" value="{{ old('image_alt_ru') }}" required>
                                        @error('image_alt_ru')
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
                                    <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                                    <a href="{{ route('back.pages.articles.index') }}" class="btn btn-secondary">Ləğv et</a>
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

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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

        // Slug oluşturma fonksiyonu
        function createSlug(str) {
            str = str || '';
            str = str.toString();
            
            // Türkçe ve Azerice karakterleri değiştir
            const charMap = {
                'ə': 'e', 'Ə': 'e',
                'ı': 'i', 'I': 'i', 'İ': 'i',
                'ö': 'o', 'Ö': 'o',
                'ü': 'u', 'Ü': 'u',
                'ş': 's', 'Ş': 's',
                'ç': 'c', 'Ç': 'c',
                'ğ': 'g', 'Ğ': 'g',
                'а': 'a', 'А': 'a',
                'б': 'b', 'Б': 'b',
                'в': 'v', 'В': 'v',
                'г': 'g', 'Г': 'g',
                'д': 'd', 'Д': 'd',
                'е': 'e', 'Е': 'e',
                'ё': 'yo', 'Ё': 'yo',
                'ж': 'zh', 'Ж': 'zh',
                'з': 'z', 'З': 'z',
                'и': 'i', 'И': 'i',
                'й': 'y', 'Й': 'y',
                'к': 'k', 'К': 'k',
                'л': 'l', 'Л': 'l',
                'м': 'm', 'М': 'm',
                'н': 'n', 'Н': 'n',
                'о': 'o', 'О': 'o',
                'п': 'p', 'П': 'p',
                'р': 'r', 'Р': 'r',
                'с': 's', 'С': 's',
                'т': 't', 'Т': 't',
                'у': 'u', 'У': 'u',
                'ф': 'f', 'Ф': 'f',
                'х': 'h', 'Х': 'h',
                'ц': 'ts', 'Ц': 'ts',
                'ч': 'ch', 'Ч': 'ch',
                'ш': 'sh', 'Ш': 'sh',
                'щ': 'sch', 'Щ': 'sch',
                'ъ': '', 'Ъ': '',
                'ы': 'y', 'Ы': 'y',
                'ь': '', 'Ь': '',
                'э': 'e', 'Э': 'e',
                'ю': 'yu', 'Ю': 'yu',
                'я': 'ya', 'Я': 'ya'
            };

            // Karakterleri değiştir
            for (let key in charMap) {
                str = str.replace(new RegExp(key, 'g'), charMap[key]);
            }

            return str
                .toLowerCase() // küçük harfe çevir
                .trim() // başındaki ve sonundaki boşlukları temizle
                .replace(/[^a-z0-9\s-]/g, '') // alfanumerik ve boşluk dışındaki karakterleri temizle
                .replace(/\s+/g, '-') // boşlukları tire ile değiştir
                .replace(/-+/g, '-') // ardışık tireleri tek tireye çevir
                .replace(/^-+/, '') // baştaki tireyi kaldır
                .replace(/-+$/, ''); // sondaki tireyi kaldır
        }

        // Her dil için başlık-slug eşleşmesi
        ['az', 'en', 'ru'].forEach(function(lang) {
            // Input elemanını seç
            let titleInput = $('input[name="title_' + lang + '"]');
            let slugInput = $('input[name="slug_' + lang + '"]');

            // Başlık değiştiğinde
            titleInput.on('input', function() {
                let title = $(this).val();
                let slug = createSlug(title);
                slugInput.val(slug);
            });

            // Sayfa yüklendiğinde mevcut başlıktan slug oluştur
            let initialTitle = titleInput.val();
            if (initialTitle) {
                slugInput.val(createSlug(initialTitle));
            }
        });
    });
</script>
@endpush 