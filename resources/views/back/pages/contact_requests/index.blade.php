@extends('back.layouts.master')

@section('title', 'Əlaqə Tələbləri')

@section('content')

<style>
        .swal2-popup {
            border-radius: 50px; 
        }
    </style>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Əlaqə Tələbləri</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Contact Requests</li>
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
                            <h5 class="card-title mb-0 flex-grow-1">Əlaqə Tələbləri Siyahısı</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('back.pages.contact_requests.create') }}" class="btn btn-primary">
                                    <i class="ri-add-line align-bottom me-1"></i> Create New Request
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
                                        confirmButtonText: 'Okay',
                                        timer: 1500
                                    });
                                });
                            </script>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Text</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contactRequests as $request)
                                        <tr>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->number }}</td>
                                            <td>{{ $request->text }}</td>
                                            <td>

                                            <form action="{{ route('back.pages.contact_requests.update', $request->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="form-select" onchange="this.form.submit()" style="background-color: {{ $request->status == 'pending' ? 'orange' : ($request->status == 'approved' ? 'green' : 'red') }}; color: white;">
                                                            <option value="pending" {{ $request->status == 'pending' ? 'selected ' : '' }}  >Gözləyir</option>
                                                            <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }} >Oxundu</option>


                                                            <option  value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }} >Redd edildi</option>
                                                        </select>
                                                    </form>


                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('back.pages.contact_requests.show', $request->id) }}" class="btn btn-info btn-sm">
                                                        <i class="ri-eye-line"></i> Show
                                                    </a>
                                                    <form id="delete-form-{{ $request->id }}" action="{{ route('back.pages.contact_requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $request->id }})">
                                                            <i class="ri-delete-bin-line"></i> Sil
                                                        </button>
                                                    </form>
                                                   
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Məlumat tapılmadı</td>
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
            title: 'Are you sure you want to delete?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection 