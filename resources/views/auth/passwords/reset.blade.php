@extends('layouts.auth.master')

@section('title', __('user.title.resetpass'))

@section('content')
<main class="auth">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>@lang('user.title.resetpass')</h1>
                <p>@lang('user.auth.takeCare')</p>
                <form id="needs-validation" method="POST" action="{{  route('password.update') }}" novalidate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email">@lang('user.auth.email')</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">@lang('user.auth.password')</label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">@lang('user.auth.confirmPassowrd')</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="float-right btn btn-primary">@lang('user.auth.reset')</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
