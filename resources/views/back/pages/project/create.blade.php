@extends('back.layouts.master')

@section('title', 'Yeni Layihə')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Yeni Layihə</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('back.pages.projects.index') }}">Layihələr</a></li>
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
                        <form action="{{ route('back.pages.projects.store') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Yaradılma Tarixi</label>
                                        <input type="datetime-local" name="created_at" class="form-control" 
                                               value="{{ old('created_at') }}"
                                               placeholder="Boş buraxılsa cari tarix qeyd olunacaq">
                                        <small class="text-muted">Boş buraxılsa avtomatik cari tarix qeyd olunacaq</small>
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
                                        <input type="hidden" name="description_az" id="description_az" value="{{ old('description_az') }}">
                                        <div id="descriptionAZ" class="ck-content">{!! old('description_az') !!}</div>
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
                                        <input type="hidden" name="description_en" id="description_en" value="{{ old('description_en') }}">
                                        <div id="descriptionEN" class="ck-content">{!! old('description_en') !!}</div>
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
                                        <input type="hidden" name="description_ru" id="description_ru" value="{{ old('description_ru') }}">
                                        <div id="descriptionRU" class="ck-content">{!! old('description_ru') !!}</div>
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
                                    <a href="{{ route('back.pages.projects.index') }}" class="btn btn-secondary">Ləğv et</a>
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
<style>
    /* Edit sayfasındaki CKEditor stillerinin aynısı */
    .ck-editor {
        overflow: visible !important;
        z-index: auto !important;
    }
    
    .ck.ck-editor__editable_inline {
        min-height: 400px;
        border: 1px solid #e3e3e3 !important;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05) !important;
    }
    
    .ck.ck-toolbar {
        position: sticky !important;
        top: 0;
        background: white !important;
        z-index: 100 !important;
    }

    .ck-editor__editable {
        min-height: 300px;
        border-radius: 0 0 10px 10px !important;
        padding: 1rem 2rem !important;
        border: 1px solid #e9ecef !important;
    }
    
    .ck.ck-toolbar {
        border-radius: 10px 10px 0 0 !important;
        background: #f8f9fa !important;
        border: 1px solid #e9ecef !important;
    }

    .ck.ck-font-size .ck-dropdown__panel {
        min-width: 140px !important;
        max-height: 400px !important;
        z-index: 10000 !important;
    }
    
    .ck.ck-font-size .ck-button__label {
        font-size: 14px !important;
    }
    
    .ck.ck-font-size .ck-button.ck-on {
        background-color: #e3f2fd;
    }

    .ck.ck-toolbar__separator {
        margin: 0 10px !important;
    }
    
    .ck.ck-toolbar-grouping > .ck-toolbar__items {
        flex-wrap: nowrap !important;
        overflow: visible !important;
    }

    .ck-toolbar-container {
        padding: 10px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .ck-content {
        min-height: 300px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 20px;
        background: white;
    }

    .ck.ck-editor__editable_inline {
        border: 1px solid #ddd !important;
    }

    .ck.ck-toolbar {
        background: transparent !important;
        border: none !important;
    }

    .ck.ck-toolbar__items {
        flex-wrap: wrap !important;
    }

    .ck.ck-dropdown__panel {
        max-height: 300px !important;
        overflow-y: auto !important;
    }

    .ck.ck-button {
        color: #333 !important;
    }

    .ck.ck-button:hover {
        background: #e9ecef !important;
    }

    .ck.ck-button.ck-on {
        background: #e3f2fd !important;
        color: #0d6efd !important;
    }
</style>
@endpush

@push('scripts')
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/decoupled-document/ckeditor.js"></script>

<script>
(function() {
    const editorConfig = {
        toolbar: {
            items: [
                'fontFamily', 'fontSize', '|',
                'bold', 'italic', 'underline', '|',
                'alignment', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'blockQuote', '|',
                'undo', 'redo'
            ]
        },
        fontSize: {
            options: [
                '8pt', '9pt', '10pt', '11pt', '12pt', 
                '14pt', '16pt', '18pt', '20pt', '22pt', 
                '24pt', '26pt', '28pt', '36pt', '48pt'
            ]
        },
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ]
        },
        language: 'tr'
    };

    function initEditor(elementId, hiddenInputId) {
        return DecoupledEditor
            .create(document.querySelector(elementId), editorConfig)
            .then(editor => {
                const toolbarContainer = document.createElement('div');
                toolbarContainer.classList.add('ck-toolbar-container');
                document.querySelector(elementId).parentElement.insertBefore(
                    toolbarContainer,
                    document.querySelector(elementId)
                );
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                editor.model.document.on('change:data', () => {
                    document.querySelector(hiddenInputId).value = editor.getData();
                });

                return editor;
            })
            .catch(error => console.error('Editor hatası:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        // AZ editörünü başlat
        initEditor('#descriptionAZ', '#description_az');

        // Tab değişikliğinde diğer editörleri başlat
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            const target = $(e.target).attr('href');
            const editorMap = {
                '#en': [['#descriptionEN', '#description_en']],
                '#ru': [['#descriptionRU', '#description_ru']]
            };

            if (editorMap[target]) {
                editorMap[target].forEach(([editorId, inputId]) => {
                    if (!window[editorId.substr(1) + 'Editor']) {
                        initEditor(editorId, inputId)
                            .then(editor => {
                                window[editorId.substr(1) + 'Editor'] = editor;
                            });
                    }
                });
            }
        });
    });

    // Slug oluşturma fonksiyonu (Mevcut kodunuz)
    function createSlug(str) {
        str = str || '';
        str = str.toString();
        
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

        for (let key in charMap) {
            str = str.replace(new RegExp(key, 'g'), charMap[key]);
        }

        return str
            .toLowerCase() 
            .trim() 
            .replace(/[^a-z0-9\s-]/g, '') 
            .replace(/\s+/g, '-') 
            .replace(/-+/g, '-') 
            .replace(/^-+/, '') 
            .replace(/-+$/, ''); 
    }

    ['az', 'en', 'ru'].forEach(function(lang) {
        let titleInput = $('input[name="title_' + lang + '"]');
        let slugInput = $('input[name="slug_' + lang + '"]');

        titleInput.on('input', function() {
            let title = $(this).val();
            let slug = createSlug(title);
            slugInput.val(slug);
        });

        let initialTitle = titleInput.val();
        if (initialTitle) {
            slugInput.val(createSlug(initialTitle));
        }
    });
})();
</script>
@endpush 