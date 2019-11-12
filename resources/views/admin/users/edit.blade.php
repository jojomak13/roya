@extends('layouts.admin.master')

@section('title', __('dashboard.users.edit'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('dashboard.users.title') }}</a></li>
<li class="breadcrumb-item active">{{ __('dashboard.users.edit') }}</li>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row">

        <div class="col-md-8">
            <section class="card">
                <div class="card-body">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="first_name">{{ __('dashboard.users.first_name') }}</label>
                            <input type="text" value="{{ $user->first_name }}" autofocus
                                class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                name="first_name">
                            @error('first_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="last_name">{{ __('dashboard.users.last_name') }}</label>
                            <input type="text" value="{{ $user->last_name }}"
                                class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name">
                            @error('last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="email">{{ __('dashboard.users.email') }}</label>
                            <input type="email" value="{{ $user->email }}"
                                class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="age">{{ __('dashboard.users.age') }}</label>
                            <input type="number" min="15" value="{{ $user->age }}"
                                class="form-control @error('age') is-invalid @enderror" id="age" name="age">
                            @error('age')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="password">{{ __('dashboard.users.password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="password_confirmation">{{ __('dashboard.users.password_confirm') }}</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="address">{{ __('dashboard.users.address') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address">{{ $user->address }}</textarea>
                            @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="image text-center">
                        <img class="img-fluid" src="{{ $user->image() }}" alt="{{ $user->fullName() }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="image">{{ __('dashboard.users.image') }}</label>
                        <input type="file" value="{{ $user->image }}"
                            class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">{{ __('dashboard.users.gender') }}</label>
                        <div class="checkbox">
                            <label>
                                <input type="radio" {{ $user->gender == 'male'? 'checked':'' }} name="gender" value="male"> {{ __('dashboard.users.male') }}
                            </label>
                            <label>
                                <input type="radio" {{ $user->gender == 'female'? 'checked':'' }} name="gender" value="female"> {{ __('dashboard.users.female') }}
                            </label>
                        </div>
                        @error('gender')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="group">{{ __('dashboard.users.group') }}</label>
                        <select class="form-control @error('group') is-invalid @enderror" id="group" name="group">
                            <option value="">{{ __('dashboard.users.select_group') }}</option>
                            @foreach ($roles as $role)
                            <option {{ $user->hasRole($role->name)? 'selected':'' }} value="{{ $role->name }}">
                                {{ $role->description }}</option>
                            @endforeach
                        </select>
                        @error('group')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection
