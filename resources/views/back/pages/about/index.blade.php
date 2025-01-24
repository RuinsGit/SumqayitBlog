@extends('back.layouts.master')

@section('title', 'Haqqımızda')

@section('content')
    <style>
        .swal2-popup {
            border-radius: 50px;
        }
    </style>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'Tamam',
                    timer: 1500
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'Tamam',
                    timer: 1500
                });
            });
        </script>
    @endif

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Haqqımızda</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Haqqımızda</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 d-flex justify-content-end mb-4">
                                @if($aboutCount === 0)
                                    <a href="{{ route('back.pages.about.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                @else
                                    <div class="alert alert-warning">
                                        Hal hazırda about mövcuddur. Yeni about yaratmaq üçün əvvəlcə əvvəlcəki about'u silin ya da redaktə edin.
                                    </div>
                                @endif
                            </div>

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block" style=" color: #ff8a33;">AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block" style=" color: #ff8a33;">EN</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block" style=" color: #ff8a33;">RU</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Xüsusi Başlıq (AZ)</th>
                                                    <th>Başlıq (AZ)</th>
                                                    <th>Təsvir (AZ)</th>
                                                    <th>Sənəd</th>
                                                    <th>Status</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($about as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div class="image-preview">
                                                                <img src="{{ asset($item->image) }}" alt="About Image" class="about-img">
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->special_title_az }}</td>
                                                        <td>{{ $item->title_az }}</td>
                                                        <td>{{ Str::limit($item->description_az, 50) }}</td>
                                                        <td>
                                                            @if($item->document_file)
                                                                <a href="{{ asset($item->document_file) }}" target="_blank" class="btn btn-info btn-sm">
                                                                    <i class="fas fa-file-download"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $item->status == 1 ? 'Aktif' : 'Deaktif' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('back.pages.about.edit', $item->id) }}" class="btn btn-primary btn-sm" style="background-color: #5bf91b; border-color: green">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" onclick="deleteData({{ $item->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <form id="delete-form-{{ $item->id }}" action="{{ route('back.pages.about.destroy', $item->id) }}" method="POST" class="d-none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Xüsusi Başlıq (EN)</th>
                                                    <th>Başlıq (EN)</th>
                                                    <th>Təsvir (EN)</th>
                                                    <th>Sənəd</th>
                                                    <th>Status</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($about as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div class="image-preview">
                                                                <img src="{{ asset($item->image) }}" alt="About Image" class="about-img">
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->special_title_en }}</td>
                                                        <td>{{ $item->title_en }}</td>
                                                        <td>{{ Str::limit($item->description_en, 50) }}</td>
                                                        <td>
                                                            @if($item->document_file)
                                                                <a href="{{ asset($item->document_file) }}" target="_blank" class="btn btn-info btn-sm">
                                                                    <i class="fas fa-file-download"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('back.pages.about.edit', $item->id) }}" class="btn btn-primary btn-sm" style="background-color: #5bf91b; border-color: green">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" onclick="deleteData({{ $item->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Xüsusi Başlıq (RU)</th>
                                                    <th>Başlıq (RU)</th>
                                                    <th>Təsvir (RU)</th>
                                                    <th>Sənəd</th>
                                                    <th>Status</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($about as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div class="image-preview">
                                                                <img src="{{ asset($item->image) }}" alt="About Image" class="about-img">
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->special_title_ru }}</td>
                                                        <td>{{ $item->title_ru }}</td>
                                                        <td>{{ Str::limit($item->description_ru, 50) }}</td>
                                                        <td>
                                                            @if($item->document_file)
                                                                <a href="{{ asset($item->document_file) }}" target="_blank" class="btn btn-info btn-sm">
                                                                    <i class="fas fa-file-download"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $item->status == 1 ? 'Активный' : 'Неактивный' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('back.pages.about.edit', $item->id) }}" class="btn btn-primary btn-sm" style="background-color: #5bf91b; border-color: green">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" onclick="deleteData({{ $item->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .image-preview {
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin: 0 auto;
    }

    .about-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
    }

    .image-preview:hover .about-img {
        transform: scale(1.05);
    }

    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        border-radius: 12px;
        overflow: hidden;
    }

    .nav-tabs {
        border-bottom: 2px solid #eee;
        margin-bottom: 20px;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 12px 20px;
        transition: all 0.2s ease;
    }

    .nav-tabs .nav-link.active {
        color: #2c3e50;
        border-bottom: 2px solid #3498db;
        background: transparent;
    }

    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #3498db;
    }
    </style>
@endsection

@push('js')
<script>
    function deleteData(id) {
        Swal.fire({
            title: 'Silmək istədiyinizdən əminsiniz?',
            text: "Bu əməliyyat geri alına bilməz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Bəli, sil!',
            cancelButtonText: 'Xeyr'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
            }
        });
    });
</script>
@endpush 