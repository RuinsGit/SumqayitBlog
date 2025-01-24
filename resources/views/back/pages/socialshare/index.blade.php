@extends('back.layouts.master')

@section('title', 'Sosial Paylaşım')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Sosial Paylaşım</h4>

                        <div class="page-title-right">
                            <a href="{{ route('back.pages.socialshare.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Yeni əlavə et
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sıra</th>
                                        <th>Ad</th>
                                        <th>İkon</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="sortable" data-url="{{ route('back.pages.socialshare.order') }}">
                                    @foreach($socialshares as $socialshare)
                                        <tr id="order-{{ $socialshare->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $socialshare->name }}</td>
                                            <td>
                                                @if($socialshare->image)
                                                    <img src="{{ asset($socialshare->image) }}" alt="" style="height: 50px; width: 50px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">Şəkil yoxdur</span>
                                                @endif
                                            </td>
                                            <td>{{ $socialshare->link }}</td>
                                            <td>
                                                <form action="{{ route('back.pages.socialshare.toggleStatus', $socialshare->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-{{ $socialshare->status ? 'success' : 'danger' }}">
                                                        {{ $socialshare->status ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('back.pages.socialshare.edit', $socialshare->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('back.pages.socialshare.destroy', $socialshare->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
@endsection

@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $('.sortable').sortable({
                handle: 'tr',
                update: function() {
                    let siralama = $('.sortable').sortable('serialize');
                    let url = $('.sortable').data('url');
                    $.post(url, {order: siralama}, function(response) {});
                }
            });
        });
    </script>
@endsection 