@extends('layouts.admin.master')

@section('title', __('dashboard.slideshow.create'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.slideshow.index') }}">{{ __('dashboard.slideshow.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.slideshow.create') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.slideshow.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title_en">{{ __('dashboard.slideshow.title_en') }}</label>
                <input type="text" value="{{ old('title_en') }}" autofocus
                    class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en">
                @error('title_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="title_ar">{{ __('dashboard.slideshow.title_ar') }}</label>
                <input type="text" value="{{ old('title_ar') }}"
                    class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" name="title_ar">
                @error('title_ar')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="link">{{ __('dashboard.slideshow.link') }}</label>
                <input type="text" value="{{ old('link') }}"
                    class="form-control @error('link') is-invalid @enderror" id="link" name="link">
                @error('link')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">{{ __('dashboard.slideshow.image') }}</label>
                <input type="file"
                    class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection
