@extends('layouts.auth.master')

@section('content')
<main class="auth">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>@lang('user.title.forgetpass')</h1>
                <p>@lang('user.auth.takeCare')</p>
                <form id="needs-validation" method="POST" action="{{ route('password.email') }}" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="email">@lang('user.auth.email')</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus required>
                        @error('email')
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
