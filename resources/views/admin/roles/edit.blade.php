@extends('layouts.admin.master')

@section('title', __('dashboard.roles.edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ __('dashboard.roles.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('dashboard.roles.edit') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">{{ __('dashboard.roles.name') }}</label>
                <input type="text" autofocus class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}" id="name" name="name">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">{{ __('dashboard.roles.description') }}</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ $role->description }}" id="description" name="description">
                @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('dashboard.roles.permissions') }}</label>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <div class="checkbox">
                                    <label>
                                        {{ $permission->description }}
                                        <input type="checkbox" {{ $role->hasPermission($permission->name)? 'checked':'' }} name="permissions[]" value="{{ $permission->name}}">
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection