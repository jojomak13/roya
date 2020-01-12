@extends('layouts.auth.master')

@section('title', __('user.title.login'))

@section('content')
<main class="auth">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>@lang('user.title.login')</h1>
                <p>@lang('user.auth.takeCare')</p>
                <form id="needs-validation" method="POST" action="{{ route('login') }}" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="email">@lang('user.auth.email')</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">@lang('user.auth.password')</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <div>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">@lang('user.auth.remember')</label>
                        </div>
                        <a href="{{ route('password.request') }}">@lang('user.auth.forget')</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('user.title.login')</button>
                    </div>
                    <p class="text-right">@lang('user.auth.noAccount') <a href="{{ route('register') }}">@lang('user.title.register')</a></p>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection