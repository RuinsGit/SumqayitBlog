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
                                        <label class="form-label">Açıqlama</label>
                                        <input type="hidden" name="description_az" id="description_az" value="{{ old('description_az') }}">
                                        <div id="descriptionAZ" class="ck-content">{!! old('description_az') !!}</div>
                                        @error('description_az')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                            <div class="mb-3">
                                                <label for="text_az" class="form-label">Ana Səhifə Mətni (AZ):</label>
                                                <textarea class="form-control" name="text_az" rows="4">{{ old('text_az') }}</textarea>
                                            </div>
                                        </div>

                                        <!-- EN tab -->
                                        <div class="tab-pane" id="en" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="special_title_en" class="form-label">Special Title (EN):</label>
                                                <input type="text" class="form-control" name="special_title_en" value="{{ old('special_title_en') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title_en" class="form-label">Title (EN):</label>
                                                <input type="text" class="form-control" name="title_en" value="{{ old('title_en') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description_en" class="form-label">Description (EN):</label>
                                                <input type="hidden" name="description_en" id="description_en" value="{{ old('description_en') }}">
                                                <div id="descriptionEN" class="ck-content">{!! old('description_en') !!}</div>
                                                @error('description_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="text_en" class="form-label">Home Page Text (EN):</label>
                                                <textarea class="form-control" name="text_en" rows="4">{{ old('text_en') }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Ru tab -->
                                        <div class="tab-pane" id="ru" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="special_title_ru" class="form-label">Специальный заголовок (RU):</label>
                                                <input type="text" class="form-control" name="special_title_ru" value="{{ old('special_title_ru') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title_ru" class="form-label">Заголовок (RU):</label>
                                                <input type="text" class="form-control" name="title_ru" value="{{ old('title_ru') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description_ru" class="form-label">Описание (RU):</label>
                                                <input type="hidden" name="description_ru" id="description_ru" value="{{ old('description_ru') }}">
                                                <div id="descriptionRU" class="ck-content">{!! old('description_ru') !!}</div>
                                                @error('description_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="text_ru" class="form-label">Текст главной страницы (RU):</label>
                                                <textarea class="form-control" name="text_ru" rows="4">{{ old('text_ru') }}</textarea>
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

@push('styles')
<style>
    /* CKEditor Container Fix */
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

    /* Font boyut dropdown'ı için */
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
<!-- CKEditor CDN Bağlantıları -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/decoupled-document/ckeditor.js"></script>

<script>
(function() {
    if(typeof DecoupledEditor === 'undefined') {
        console.error('CKEditor yüklenemedi!');
        return;
    }

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
                '8pt', '9pt', '10pt', '11pt', '12pt', '14pt', '16pt', '18pt', '20pt', '22pt', '24pt', '26pt', '28pt', '36pt', '48pt'
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
                
                // Form gönderilmeden önce içeriği hidden input'a aktar
                editor.model.document.on('change:data', () => {
                    document.querySelector(hiddenInputId).value = editor.getData();
                });

                return editor;
            })
            .catch(error => console.error('Editor hatası:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        // AZ editörünü başlat
        initEditor('#editorAZ', '#description_az');

        // Tab değişikliğinde diğer editörleri başlat
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            const target = $(e.target).attr('href');
            const editorMap = {
                '#en': ['#editorEN', '#description_en'],
                '#ru': ['#editorRU', '#description_ru']
            };

            if (editorMap[target] && !window[target.substr(1) + 'Editor']) {
                initEditor(editorMap[target][0], editorMap[target][1])
                    .then(editor => {
                        window[target.substr(1) + 'Editor'] = editor;
                    });
            }
        });
    });
})();
</script>
@endpush
