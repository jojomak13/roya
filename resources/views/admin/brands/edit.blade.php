@extends('layouts.admin.master')

@section('title', __('dashboard.brands.edit'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">{{ __('dashboard.brands.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.brands.edit') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name_en">{{ __('dashboard.brands.name_en') }}</label>
                <input type="text" value="{{ $brand->name_en }}" autofocus
                    class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en">
                @error('name_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name_ar">{{ __('dashboard.brands.name_ar') }}</label>
                <input type="text" value="{{ $brand->name_ar }}"
                    class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar">
                @error('name_ar')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">{{ __('dashboard.brands.image') }}</label>
                <input type="file"
                    class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ url('storage/'.$brand->image) }}" class="img-thumbnail img-fluid">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection
