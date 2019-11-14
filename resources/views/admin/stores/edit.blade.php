@extends('layouts.admin.master')

@section('title', __('dashboard.stores.edit'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.stores.index') }}">{{ __('dashboard.stores.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.stores.edit') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.stores.update', $store->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">{{ __('dashboard.stores.name') }}</label>
                <input type="text" value="{{ $store->name }}" autofocus
                    class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="user_id">{{ __('dashboard.stores.supplier') }}</label>
                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                    <option value="">{{ __('dashboard.stores.choose_supplier') }}</option>
                    @forEach($users as $user)
                    <option {{ $store->user_id == $user->id? 'selected':'' }} value="{{ $user->id }}">{{ $user->fullName() }}</option>
                    @endforeach
                </select>
                @error('user_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">{{ __('dashboard.stores.address') }}</label>
                <input type="text" value="{{ $store->address }}"
                    class="form-control @error('address') is-invalid @enderror" id="address" name="address">
                @error('address')
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
