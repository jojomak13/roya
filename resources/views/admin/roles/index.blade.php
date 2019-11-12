@extends('layouts.admin.master')

@section('title', __('dashboard.roles.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.roles.title') }}</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __('dashboard.roles.create') }}</a>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.roles.name') }}</th>
                    <th>{{ __('dashboard.roles.description') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key => $role)
                <tr>
                    <th>{{ $role->name }}</th>
                    <th>{{ $role->description }}</th>
                    <th>
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.bootstrap4.js') }}"></script>
<script>
$(document).ready(function(){
    $('table').DataTable({
        "language": {
            "paginate": {
                "next": "{{ __('dashboard.next') }}",
                "previous": "{{ __('dashboard.previous') }}",
            },
            "search": '{{ __('dashboard.search') }}',
            "zeroRecords": '{{ __('dashboard.infoEmpty') }}'
        }
    });
})
</script>
@endsection