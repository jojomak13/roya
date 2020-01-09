<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('admin/images/logo.png') }}" alt="{{ config('app.name') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ __('dashboard.title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ auth()->user()->image() }}" class="img-circle elevation-2"
                        alt="{{ auth()->user()->fullName() }}">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->fullName() }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>{{ __('dashboard.title') }}</p>
                        </a>
                    </li>
                    @if(auth()->user()->can('read_orders'))
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-shopping-cart"></i>
                            <p>{{ __('dashboard.orders.title') }}</p>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('read_slideshow'))
                    <li class="nav-item">
                        <a href="{{ route('admin.slideshow.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-image"></i>
                            <p>{{ __('dashboard.slideshow.title') }}</p>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('read_products'))
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-tags"></i>
                            <p>{{ __('dashboard.products.title') }}</p>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('read_products'))
                    <li class="nav-item">
                        <a href="{{ route('admin.offers.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-strikethrough"></i>
                            <p>{{ __('dashboard.offers.title') }}</p>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('read_stores'))
                    <li class="nav-item">
                        <a href="{{ route('admin.stores.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>{{ __('dashboard.stores.title') }}</p>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->can('read_categories'))
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-cubes"></i>
                            <p>{{ __('dashboard.categories.title') }}</p>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->can('read_users'))
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>{{ __('dashboard.users.title') }}</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item has-treeview">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fa fa-sitemap"></i>
                            <p>
                                {{ __('dashboard.groups_and_privileges') }}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read_roles'))
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                    <i class="text-danger fa fa-circle-o nav-icon"></i>
                                    <p>{{ __('dashboard.roles.title') }}</p>
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->can('read_permissions'))
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                                    <i class="text-danger fa fa-circle-o nav-icon"></i>
                                    <p>{{ __('dashboard.permissions.title') }}</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-header">تجريبى</li>
                    <li class="nav-item">
                        <a href="pages/calendar.html" class="nav-link">
                            <i class="nav-icon fa fa-calendar"></i>
                            <p>
                                تقویم
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
