@extends('layouts.admin.master')

@section('title', __('dashboard.brands.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.brands.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.brands.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.brands.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.brands.image') }}</th>
                    <th>{{ __('dashboard.brands.title') }}</th>
                    <th>{{ __('dashboard.brands.products_count') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brands as $brand)
                <tr>
                    <th><img style="height:50px" src="{{ url('storage/'.$brand->image) }}"></th>
                    <th>{{ $brand->{lang('name')} }}</th>
                    <th>{{ $brand->products->count() }}</th>
                    <th>
                        <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn btn-dark"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
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
        {{ $brands->links() }}
    </div>
</section>
@endsection
