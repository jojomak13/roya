@extends('layouts.admin.master')

@section('title', __('dashboard.categories.edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('dashboard.categories.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('dashboard.categories.edit') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name_en">{{ __('dashboard.categories.name_en') }}</label>
                <input type="text" autofocus class="form-control @error('name_en') is-invalid @enderror" value="{{ $category->name_en }}" id="name_en" name="name_en">
                @error('name_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name_ar">{{ __('dashboard.categories.name_ar') }}</label>
                <input type="text" autofocus class="form-control @error('name_ar') is-invalid @enderror" value="{{ $category->name_ar }}" id="name_ar" name="name_ar">
                @error('name_ar')
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