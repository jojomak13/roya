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
        <form autocomplete="off" action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('dashboard.categories.name') }}</label>
                <input type="text" value="{{ old('name') }}" autofocus
                    class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="parent_id">{{ __('dashboard.categories.parent') }}</label>
                <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="0">{{ __('dashboard.categories.parent_cat') }}</option>
                    @forEach($parents as $parent)
                    <option {{ old('parent_id') == $parent->id?? 'selected':'' }} value="{{ $parent->id }}">{{ $parent->name }}</option>
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
