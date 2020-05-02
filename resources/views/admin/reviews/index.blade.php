@extends('layouts.admin.master')

@section('title', __('dashboard.reviews.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.reviews.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.reviews.content') }}</th>
                    <th>{{ __('dashboard.reviews.user') }}</th>
                    <th>{{ __('dashboard.reviews.product') }}</th>
                    <th>{{ __('dashboard.reviews.stars') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                <tr>
                    <th>{{ $review->feedback }}</th>
                    <th>{{ $review->first_name }} {{ $review->last_name }}</th>
                    <th>{{ $review->{lang('name')} }}</th>
                    <th>{{ $review->stars }}</th>
                    <th>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST">
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
        {{ $reviews->links() }}
    </div>
</section>
@endsection
