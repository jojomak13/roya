@extends('layouts.admin.master')

@section('title', __('dashboard.slideshow.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.slideshow.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.slideshow.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.slideshow.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.slideshow.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.slideshow.image') }}</th>
                    <th>{{ __('dashboard.slideshow.title') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($slideshows as $slide)
                <tr>
                    <th><img style="height:50px" src="{{ url('storage/'.$slide->image) }}"></th>
                    <th>{{ $slide->{lang('title')} }}</th>
                    <th>
                        @if($slide->link)
                            <a href="{{ $slide->link }}" class="btn btn-dark"><i class="fa fa-link"></i></a>
                        @endif
                        <a href="{{ route('admin.slideshow.edit', $slide->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.slideshow.destroy', $slide->id) }}" method="POST">
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
        {{ $slideshows->links() }}
    </div>
</section>
@endsection
