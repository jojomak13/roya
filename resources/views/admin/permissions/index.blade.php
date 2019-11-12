@extends('layouts.admin.master')

@section('title', __('dashboard.permissions.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.permissions.title') }}</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.permissions.name') }}</th>
                    <th>{{ __('dashboard.permissions.description') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <th>{{ $permission->name }}</th>
                    <th>{{ $permission->description }}</th>
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