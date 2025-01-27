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
                        <a href="{{ route('back.pages.gallery-videos.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Yeni əlavə et
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
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
                            <table class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Başlıq</th>
                                        <th>Video</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($galleryVideos as $video)
                                        <tr>
                                            <td>{{ $video->id }}</td>
                                            <td>{{ $video->title_az }}</td>
                                            <td>
                                                @if($video->main_video_thumbnail)
                                                    <img src="{{ asset($video->main_video_thumbnail) }}" alt="Video Thumbnail" style="max-width: 100px;">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('back.pages.gallery-videos.edit', $video->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('back.pages.gallery-videos.destroy', $video->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
    .table img {
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