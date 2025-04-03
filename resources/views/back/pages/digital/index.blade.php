@extends('back.layouts.master')

@section('title', 'Digital')

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
                    <h4 class="mb-sm-0">Digital</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">Digital</li>
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
                            <h5 class="card-title mb-0 flex-grow-1">Digital Cədvəli</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('back.pages.digitals.create') }}" class="btn btn-primary">
                                    <i class="ri-add-line align-bottom me-1"></i> Yeni Digital
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
                                     
                                        <th scope="col" class="text-center">AZ Şəkil</th>
                                        <th scope="col" class="text-center">EN Şəkil</th>
                                        <th scope="col" class="text-center">RU Şəkil</th>
                                        <th scope="col" class="text-center">Əməliyyatlar</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($digitals as $digital)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                        
                                            <td class="text-center">
                                                @if($digital->image_az)
                                                    <img src="{{ asset('storage/' . $digital->image_az) }}" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <span class="badge bg-light text-dark">Şəkil yoxdur</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($digital->image_en)
                                                    <img src="{{ asset('storage/' . $digital->image_en) }}" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <span class="badge bg-light text-dark">Şəkil yoxdur</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($digital->image_ru)
                                                    <img src="{{ asset('storage/' . $digital->image_ru) }}" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <span class="badge bg-light text-dark">Şəkil yoxdur</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('back.pages.digitals.edit', $digital->id) }}" class="btn btn-sm btn-success"><i class="ri-pencil-line"></i></a>
                                                    <form id="delete-form-{{ $digital->id }}" action="{{ route('back.pages.digitals.destroy', $digital->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteData({{ $digital->id }})"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Layihə yoxdur</td>
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
            text: "Bu digital silinəcək!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sil',
            cancelButtonText: 'Ləğv et'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection 