@extends('layouts.user.master')

@section('title', __('user.title.blog'))

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li>@lang('user.title.blog')</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<!-- Start Blog -->
<main class="blog-page">
    <div class="container">
        <div class="header">
            <h1>@lang('user.title.blog')</h1>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="card blog">
                    <div class="card-body">
                        <div class="image">
                            <img class="img-fluid" src="{{ url('storage/'.$blog->image) }}" alt="{{ $blog->{lang('title')} }}"
                                title="{{ $blog->{lang('title')} }}">
                        </div>
                        <h3 class="title"><a href="{{ $blog->url }}">{{ $blog->{lang('title')} }}</a></h3>
                    <p clas="title">
                        <span>
                            <span>@lang('user.blog.by')</span>
                            <a href="#" class="author">{{ $blog->user->first_name }}</a>
                        </span>
                        | {{ $blog->created_at->toFormattedDateString() }}</p>
                        <a href="{{ $blog->url }}" class="btn btn-primary">@lang('user.readmore')</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{ $blogs->links() }}
    </div>
</main>
<!-- End Blog -->
@endsection