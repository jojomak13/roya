@extends('layouts.admin.master')

@section('title', __('dashboard.offers.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.offers.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.offers.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.offers.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.offers.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.offers.image') }}</th>
                    <th>{{ __('dashboard.offers.title') }}</th>
                    <th>{{ __('dashboard.offers.products_count') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($offers as $offer)
                <tr>
                    <th><img style="height:50px" src="{{ url('storage/'.$offer->image) }}"></th>
                    <th>{{ $offer->{lang('name')} }}</th>
                    <th>{{ $offer->products->count() }}</th>
                    <th>
                        <a href="{{ route('admin.offers.show', $offer->id) }}" class="btn btn-dark"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST">
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
        {{ $offers->links() }}
    </div>
</section>
@endsection
