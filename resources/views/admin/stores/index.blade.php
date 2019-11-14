@extends('layouts.admin.master')

@section('title', __('dashboard.stores.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.stores.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.stores.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.stores.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.stores.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.stores.name') }}</th>
                    <th>{{ __('dashboard.stores.supplier') }}</th>
                    <th>{{ __('dashboard.stores.address') }}</th>
                    <th>{{ __('dashboard.stores.products_count') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stores as $store)
                <tr>
                    <th>{{ $store->name }}</th>
                    <th>{{ $store->user->fullName() }}</th>
                    <th>{{ $store->address }}</th>
                    <th>------</th>
                    <th>
                        <a href="{{ route('admin.stores.show', $store->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST">
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
        {{ $stores->links() }}
    </div>
</section>
@endsection
