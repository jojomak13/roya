@extends('layouts.user.master')

@section('title', __('user.title.editProfile'))
@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li><a href="{{ route('profile.edit') }}" title="@lang('user.title.editProfile')">@lang('user.title.editProfile')</a></li>
            <li>{{ $user->fullName() }}</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<!-- Start edit profile -->
<main class="edit-profile-page">
    <div class="container">
        <div class="header">
            <h1>@lang('user.title.editProfile')</h1>
        </div>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="image text-center">
                                <img src="{{ $user->imageUrl() }}" class="img-fluid" alt="{{ $user->fullName() }}" title="{{ $user->fullName() }}">
                            </div>
                            <div class="mt-2 custom-file">
                                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image">
                                <label class="custom-file-label" for="image">@lang('user.auth.chooseImage')</label>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="first_name">@lang('user.auth.firstName')</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                                    @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">@lang('user.auth.lastName')</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                                    @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">@lang('user.auth.phone')</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="postal_code">@lang('user.auth.postalCode')</label>
                                    <input type="number" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ $user->postal_code }}">
                                    @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="email">@lang('user.auth.email')</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password">@lang('user.auth.password')</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password_confirmation">@lang('user.auth.confirmPassowrd')</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="country">@lang('user.auth.country')</label>
                                    <select class="form-control @error('country_id') is-invalid @enderror" id="country" name="country_id">
                                        <option value="">@lang('user.profile.select_country')</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->{lang('name')} }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="city">@lang('user.auth.city')</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $user->city }}">
                                    @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="address">@lang('user.auth.address')</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ $user->address }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <div class="form-check">
                                        <input type="checkbox" {{ $user->news?'checked' : '' }} id="news" name="news" value="1" class="form-check-input">
                                        <label for="news" class="form-check-label">@lang('user.auth.joinNews')</label>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="float-right btn btn-primary">@lang('user.auth.update')</button>
                                </div>
                            </div>          
                        </div>
                    </div>
                </div>
                
            </div>
        </form> 
    </div>
</main>
<!-- End edit profile -->
@endsection