@extends('layouts.auth.master')

@section('title', __('user.title.register'))

@section('content')
<main class="auth big">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>@lang('user.title.register')</h1>
                <p>@lang('user.auth.takeCare')</p>
                <form id="needs-validation"action="{{ route('register') }}" method="POST" novalidate>
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="first_name">@lang('user.auth.firstName')</label>
                        <input type="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" id="first_name" name="first_name" autofocus required>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="last_name">@lang('user.auth.lastName')</label>
                            <input type="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" id="last_name" name="last_name" required>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="email">@lang('user.auth.email')</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="age">@lang('user.auth.age')</label>
                            <input type="number" min="16" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" id="age" name="age" required>
                            @error('age')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="password">@lang('user.auth.password')</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="password_confirmation">@lang('user.auth.confirmPassowrd')</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="address">@lang('user.auth.address')</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label>@lang('user.auth.gender'):</label>
                            <div class="form-check">
                                <input {{ old('gender') == 'male'? 'checked':'' }} class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                                <label class="form-check-label" for="male">@lang('user.auth.male')</label>
                            </div>
                            <div class="form-check">
                                <input {{ old('gender') == 'female'? 'checked':'' }} class="form-check-input" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">@lang('user.auth.female')</label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input type="checkbox" id="news" name="news" class="form-check-input" value="1">
                                <label for="news" class="form-check-label">@lang('user.auth.joinNews')</label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary">@lang('user.title.register')</button>
                        </div>
                    </div>
                    <p class="text-right">@lang('user.auth.haveAccount') <a href="{{ route('login') }}">@lang('user.title.login')</a></p>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
