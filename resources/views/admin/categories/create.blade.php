@extends('layouts.admin.master')

@section('title', __('dashboard.categories.create'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('dashboard.categories.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.categories.create') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name_en">{{ __('dashboard.categories.name_en') }}</label>
                <input type="text" value="{{ old('name_en') }}" autofocus
                    class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en">
                @error('name_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name_ar">{{ __('dashboard.categories.name_ar') }}</label>
                <input type="text" value="{{ old('name_ar') }}"
                    class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar">
                @error('name_ar')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">{{ __('dashboard.categories.image') }}</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="parent_id">{{ __('dashboard.categories.parent') }}</label>
                <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="0">{{ __('dashboard.categories.parent_cat') }}</option>
                    @forEach($parents as $parent)
                    <option {{ old('parent_id') == $parent->id? 'selected':'' }} value="{{ $parent->id }}">{{ $parent->{lang('name')} }}</option>
                    @endforeach
                </select>
                @error('parent_id')
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
