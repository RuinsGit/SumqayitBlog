@extends('back.layouts.master')

@section('title', 'Məqalələr')

@section('content')

<style>
        .swal2-popup {
            border-radius: 50px;
        }
    </style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Məqalələr</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">Məqalələr</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1">Məqalələr Cədvəli</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('back.pages.articles.create') }}" class="btn btn-primary">
                                    <i class="ri-add-line align-bottom me-1"></i> Yeni Məqalə
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

                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Başlıq</th>
                                        <!-- <th scope="col" class="text-center">Açıqlama</th> -->
                                        <th scope="col" class="text-center">Şəkil</th>
                                        <th scope="col" class="text-center">İşlər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($articles as $article)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $article->title_az }}</td>
                                            <!-- <td>{{ $article->description_az }}</td> -->
                                            <td class="text-center">
                                                <img src="{{ asset('storage/' . $article->image) }}" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover; border-radius: 4px;">
                                            </td>
                                            <td class="text-center">
                                            <a href="{{ route('back.pages.articles.edit', $article->id) }}" class="btn btn-primary btn-sm" style="background-color: #5bf91b; border-color: green">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                <form action="{{ route('back.pages.articles.destroy', $article->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $article->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $article->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Məqalə yoxdur</td>
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
            title: 'Silmək istədiyinizə əminsiniz?',
            text: "Bu məqalə silinəcək!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection 