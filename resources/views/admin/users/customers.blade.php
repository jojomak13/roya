@extends('layouts.admin.master')

@section('title', __('dashboard.users.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.users.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.customers.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2 mr-2"><i class="fa fa-plus"></i> {{ __('dashboard.users.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.users.first_name') }}</th>
                    <th>{{ __('dashboard.users.last_name') }}</th>
                    <th>{{ __('dashboard.users.email') }}</th>
                    <th>{{ __('dashboard.users.last_login') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <th>{{ $user->first_name }}</th>
                    <th>{{ $user->last_name }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->last_login->diffForHumans() }}</th>
                    <th>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="6">{{ __('dashboard.no_record') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</section>
@endsection