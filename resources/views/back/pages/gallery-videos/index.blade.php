@extends('back.layouts.master')

@section('title', 'Video Qalereya')

@section('content')

<style>
        .swal2-popup {
            border-radius: 50px; /* Modern görünüm için köşe yuvarlama */
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Video Qalereya</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Video Qalereya</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">Video Qalereya Siyahısı</h5>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('back.pages.gallery-videos.create') }}" class="btn btn-primary">
                                        <i class="ri-add-line align-bottom me-1"></i> Yeni Video Qalereya
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
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

                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="text-center" style="width: 50px;">#</th>
                                            <th scope="col" class="text-center" style="width: 150px;">Video</th>
                                            <th scope="col" class="text-center" style="width: 150px;">Video şəkli</th>
                                            <th scope="col">Başlıq</th>
                                            <th scope="col" class="text-center" style="width: 120px;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($galleryVideos as $video)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <video width="150" controls>
                                                        <source src="{{ asset($video->main_video) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </td>
                                                <td>
                                                    <img src="{{ asset($video->main_video_thumbnail) }}" style="width: 150px; height: 80px; object-fit: cover; border-radius: 4px;">
                                                </td>
                                                <td>
                                                    
                                                    <h5 class="mb-1" style="font-size: 14px;">{{ $video->title_az }}</h5>
                                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ Str::limit($video->description_az, 100) }}</p>
                                                </img>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('back.pages.gallery-videos.edit', $video->id) }}" 
                                                           class="btn btn-warning btn-sm" style="background-color: #5bf91b; border-color: green;"
                                                           title="Redaktə et">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                        <form action="{{ route('back.pages.gallery-videos.destroy', $video->id) }}" 
                                                              method="POST"
                                                              id="delete-form-{{ $video->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" title="Sil" onclick="deleteData({{ $video->id }})">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Heç bir məlumat tapılmadı</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            });
        }
    </script>
@endsection

@push('css')
<style>
    .table video {
        object-fit: cover;
        border-radius: 4px;
    }
    .avatar-group {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush
