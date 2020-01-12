@extends('layouts.user.master')

@section('title', $blog->{lang('title')} . ' - ' . __('user.title.blog'))

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li><a href="{{ route('blog.index') }}" title="@lang('user.title.blog')">@lang('user.title.blog')</a></li>
            <li>{{ $blog->{lang('title')} }}</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<!-- Start Single Blog -->
<main class="single-blog-page">
    <div class="banner">
        <div class="image" style="background-image: url({{ url('storage/'.$blog->image) }})"></div>
        <div class="info">
            <h1>{{ $blog->{lang('title')} }}</h1>
            <p><a href="#">{{ $blog->user->first_name . ' ' .  $blog->user->last_name }}</a> | {{ $blog->created_at->toFormattedDateString() }}</p>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body article">
               {!! $blog->{lang('content')} !!}
            </div>
        </div>
    </div>
</main>
<!-- End Single Blog -->
@endsection