@extends('layouts.admin.master')

@section('title', __('dashboard.slideshow.edit'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.slideshow.index') }}">{{ __('dashboard.slideshow.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.slideshow.edit') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.slideshow.update', $slideshow->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name_en">{{ __('dashboard.slideshow.name_en') }}</label>
                <input type="text" value="{{ $slideshow->title_en }}" autofocus
                    class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="title_en">
                @error('name_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name_ar">{{ __('dashboard.slideshow.name_ar') }}</label>
                <input type="text" value="{{ $slideshow->title_ar }}"
                    class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="title_ar">
                @error('name_ar')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="link">{{ __('dashboard.slideshow.link') }}</label>
                <input type="text" value="{{ $slideshow->link }}"
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
                <img src="{{ url('storage/'.$slideshow->image) }}" class="img-thumbnail img-fluid">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection
