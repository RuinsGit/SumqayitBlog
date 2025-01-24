@extends('back.layouts.master')

@section('title', 'Worklife İdarəsi')

@section('content')
    <style>
        .swal2-popup {
            border-radius: 50px; /* Modern görünüm için köşe yuvarlama */
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
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Worklife Siyahısı</h4>
                        <div class="page-title-right">
                            <a href="{{ route('back.pages.worklife.create') }}" class="btn btn-primary" >
                                <i class="fas fa-plus me-2"></i> Yeni Əlavə Et
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>AZ</th>
                                            <th>EN</th>
                                            <th>RU</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($worklife as $worklife)
                                            <tr>
                                                <td>{{ $worklife->id }}</td>
                                                <td>{{ $worklife->description_az }}</td>
                                                <td>{{ $worklife->description_en }}</td>
                                                <td>{{ $worklife->description_ru }}</td>
                                                <td>
                                                    <a href="{{ route('back.pages.worklife.edit', $worklife->id) }}" class="btn btn-warning" style="background-color: #5bf91b; border-color: green;">Düzəlt</a>
                                                    <form action="{{ route('back.pages.worklife.destroy', $worklife->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="deleteData({{ $worklife->id }})">Sil</button>
                                                    </form>
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