@extends('back.layouts.master')

@section('title', 'Xəritələr')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Xəritələr</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Xəritələr</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

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
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 d-flex justify-content-end mb-4">
                                @if($map)
                                    <a href="{{ route('back.pages.maps.edit', $map->id) }}" class="btn btn-primary" style="background-color: #5bf91b; border-color: green;">
                                        <i class="fas fa-edit"></i> Redaktə Et
                                    </a>
                                    <a href="{{ route('back.pages.maps.show', $map->id) }}" class="btn btn-info" style="margin-left: 18px;">
                                        <i class="fas fa-eye"></i> Xəritəni Görüntülə
                                    </a>
                                    <form action="{{ route('back.pages.maps.destroy', $map->id) }}" method="POST" class="d-inline" id="delete-form-{{ $map->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" style="margin-left: 18px;" onclick="deleteData({{ $map->id }})">
                                            <i class="fas fa-trash"></i> Sil
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('back.pages.maps.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Xəritə Əlavə Et
                                    </a>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Xəritə Linki</th>
                                            <th>Yaradılma Tarixi</th>
                                            <th>Yenilənmə Tarixi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($map)
                                            <tr>
                                                <td>1</td>
                                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $map->description }}</td>
                                                <td>{{ $map->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $map->updated_at->format('d-m-Y') }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Bir xəritə yoxdur.</td>
                                            </tr>
                                        @endif
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
            })
        }
    </script>
@endsection 