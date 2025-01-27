@extends('back.layouts.master')

@section('title', 'Sosial Media Redaktə')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sosial Media Redaktə</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('back.pages.socialshare.index') }}">Sosial Media</a></li>
                        <li class="breadcrumb-item active">Redaktə</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('back.pages.socialshare.update', $socialshare->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Ad</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $socialshare->name) }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">İkon (Şəkil)</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if($socialshare->image)
                                <div class="mt-2">
                                    <img src="{{ asset($socialshare->image) }}" alt="{{ $socialshare->name }}" style="max-height: 50px;">
                                </div>
                            @endif
                            <small class="form-text text-muted">İkon üçün şəkil və ya SVG fayl yükləyin. Boş buraxsanız köhnə şəkil qalacaq.</small>
                        </div>

                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $socialshare->link) }}" required>
                            @error('link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- <div class="form-group">
                            <label for="sitelink">Site Linki</label>
                            <input type="text" name="sitelink" id="sitelink" class="form-control @error('sitelink') is-invalid @enderror" value="{{ old('sitelink', $socialshare->sitelink) }}" placeholder="https://example.com">
                            @error('sitelink')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->

                        <div class="form-group" style="display: flex; align-items: center; justify-content: flex-start; margin: 24px 0; gap: 28px;">
                            <label for="background_color" style="margin: 0; color: #303030; font-weight: 500; font-size: 16px;">Arxa plan Rengi</label>
                            <input type="color" name="background_color" id="background_color" class="color-picker @error('background_color') is-invalid @enderror" style="margin: 0; width: 46px; height: 46px; border-radius: 50%; outline: none; border: none; padding: 0;" value="{{ old('background_color', $socialshare->background_color) }}">
                            @error('background_color')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">Sıra</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $socialshare->order) }}" min="0">
                            @error('order')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', $socialshare->status) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">Status</label>
                            </div>
                        </div> -->

                        <button type="submit" class="btn btn-primary" style="margin-top: 24px;">Yadda saxla</button>
                        <a href="{{ route('back.pages.socialshare.index') }}" style="margin-top: 24px;" class="btn btn-secondary">Ləğv et</a>
                    </form>
                </div>
            </div>

            <!-- Site Link güncelleme formu -->
            <div class="card mt-4" style="margin-top: 24px;">
                <div class="card-header">
                    <h4>Sayt Linkini Dəyişdir</h4>
                    
                </div>
                <div class="card-body" style="margin-bottom: 50px;">
                    <form action="{{ route('back.pages.socialshare.updatesitelink') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="global_sitelink">Site Linki</label>
                            <input type="text" name="sitelink" id="global_sitelink" 
                                class="form-control @error('sitelink') is-invalid @enderror" 
                                value="{{ old('sitelink', $sitelink) }}" 
                                placeholder="https://example.com">
                            @error('sitelink')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 24px; background-color: orange; color: white;">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush 