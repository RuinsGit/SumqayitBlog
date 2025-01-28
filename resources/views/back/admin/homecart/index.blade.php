@extends('back.layouts.master')

@section('title', 'Homecart Siyahısı')

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
                        <h4 class="mb-sm-0">Homecart Siyahısı</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Homecart</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-4">
                                <a href="{{ route('back.pages.homecart.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> Yeni Homecart Əlavə Et
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Şəkil</th>
                                            <th>Başlıq (AZ)</th>
                                            <th>Təsvir (AZ)</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($homecart as $homecart)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($homecart->image) }}" 
                                                         alt="{{ $homecart->image_alt_az }}" 
                                                         class="img-thumbnail" 
                                                         style="max-width: 100px;">
                                                </td>
                                                <td>{{ $homecart->title_az }}</td>
                                                <td>{{ Str::limit($homecart->description_az, 100) }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('back.pages.homecart.edit', $homecart->id) }}" 
                                                           class="btn btn-sm btn-primary" style="width: 30px; height: 30px; background-color: #5bf91b;" >
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('back.pages.homecart.destroy', $homecart->id) }}" 
                                                              method="POST" 
                                                              class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-danger" style="width: 30px; height: 30px;"
                                                                    onclick="deleteData({{ $homecart->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Heç bir Homecart tapılmadı</td>
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
                title: 'Bu Homecart-nu silmək istədiyinizə əminsiniz?',
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

<style>
.table {
    vertical-align: middle;
}

.table img {
    transition: transform 0.2s ease;
}

.table img:hover {
    transform: scale(1.1);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.alert {
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: 0.5rem;
}

.card {
    border: none;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
    border-radius: 12px;
}
</style>
@endsection 