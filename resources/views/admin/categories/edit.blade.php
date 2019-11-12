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
                <label for="name">{{ __('dashboard.categories.name') }}</label>
                <input type="text" autofocus class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}" id="name" name="name">
                @error('name')
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