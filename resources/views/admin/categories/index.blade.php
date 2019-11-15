@extends('layouts.admin.master')

@section('title', __('dashboard.categories.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.categories.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.categories.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.categories.name') }}</th>
                    <th>{{ __('dashboard.categories.children_count') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $key => $category)
                <tr>
                    <th>{{ $category->name }}</th>
                    <th>{{ $category->children_count }}</th>
                    <th>
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
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
        {{ $categories->links() }}
    </div>
</section>
@endsection
