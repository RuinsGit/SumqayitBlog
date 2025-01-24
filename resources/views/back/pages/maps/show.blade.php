@extends('back.layouts.master')

@section('title', 'Xəritə Detalları')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Xəritə Detalları</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.maps.index') }}">Xəritələr</a></li>
                                <li class="breadcrumb-item active">Xəritə Detalları</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Xəritə Linki:</h5>
                            <p>{{ $map->description }}</p>
                            <h5>Yaradılma Tarixi:</h5>
                            <p>{{ $map->created_at->format('d-m-Y') }}</p>
                            <h5>Yenilənmə Tarixi:</h5>
                            <p>{{ $map->updated_at->format('d-m-Y') }}</p>

                            <h5>Harita:</h5>
                            <div class="embed-responsive embed-responsive-16by9 mb-3">
                                {!! $map->description !!}
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="{{ route('back.pages.maps.index') }}" class="btn btn-secondary">Geri</a>
                                    <a href="{{ route('back.pages.maps.edit', $map->id) }}" class="btn btn-primary">Redaktə Et</a>
                                    <form action="{{ route('back.pages.maps.destroy', $map->id) }}" method="POST" class="d-inline" id="delete-form-{{ $map->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="deleteData({{ $map->id }})">Sil</button>
                                    </form>
                                </div>
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