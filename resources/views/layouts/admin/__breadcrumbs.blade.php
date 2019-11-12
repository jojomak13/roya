<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('title')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('dashboard.title') }}</a></li>
                    @yield('breadcrumb')
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

@if(session()->has('success'))
<script>
    window.onload = function () {
        toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        })
    }
</script>
@endif
