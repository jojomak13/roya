@extends('layouts.auth.master')

@section('title', __('user.title.verifyEmail'))

@section('content')
<main class="auth">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>@lang('user.title.verifyEmail')</h1>
                <p>@lang('user.auth.checkMailFirst')</p>
                <p>@lang('user.auth.dontGetEmail')</p>
                <form action="{{ route('verification.resend') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('user.auth.sendAgain')</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
