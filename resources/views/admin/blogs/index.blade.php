@extends('layouts.admin.master')

@section('title', __('dashboard.blogs.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.blogs.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.blogs.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.blogs.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.blogs.image') }}</th>
                    <th>{{ __('dashboard.blogs.'. lang('title')) }}</th>
                    <th>{{ __('dashboard.blogs.author') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                <tr>
                    <th><img style="height:50px" src="{{ url('storage/'.$blog->image) }}"></th>
                    <th>{{ $blog->{lang('title')} }}</th>
                    <th>{{ $blog->user->fullName() }}</th>
                    <th>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="2">{{ __('dashboard.no_record') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $blogs->links() }}
    </div>
</section>
@endsection
