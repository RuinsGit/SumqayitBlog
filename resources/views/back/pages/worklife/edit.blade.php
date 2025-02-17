@extends('back.layouts.master')

@section('title', 'Worklife Düzəlt')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Worklife Düzəlt</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.worklife.index') }}">Worklife</a></li>
                                <li class="breadcrumb-item active">Düzəlt</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.worklife.update', $worklife->id) }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')

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
                                            <label class="form-label">AZ Məzmun</label>
                                            <input type="hidden" name="description_az" id="description_az" value="{{ old('description_az', $worklife->description_az) }}">
                                            <div id="editorAZ" class="ck-content">{!! old('description_az', $worklife->description_az) !!}</div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane fade" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">EN Content</label>
                                            <input type="hidden" name="description_en" id="description_en" value="{{ old('description_en', $worklife->description_en) }}">
                                            <div id="editorEN" class="ck-content">{!! old('description_en', $worklife->description_en) !!}</div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane fade" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">RU Контент</label>
                                            <input type="hidden" name="description_ru" id="description_ru" value="{{ old('description_ru', $worklife->description_ru) }}">
                                            <div id="editorRU" class="ck-content">{!! old('description_ru', $worklife->description_ru) !!}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save me-2"></i>Yenilə
                                    </button>
                                    <a href="{{ route('back.pages.worklife.index') }}" class="btn btn-light">
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