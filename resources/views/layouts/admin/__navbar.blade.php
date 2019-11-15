<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge">20</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
                    <span class="float-left text-muted text-sm">3 دقیقه</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
                    <span class="float-left text-muted text-sm">12 ساعت</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-file ml-2"></i> 3 گزارش جدید
                    <span class="float-left text-muted text-sm">2 روز</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
            </div>
        </li>

        <!-- Languages dropdown menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
				<i class="fa fa-globe"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-left">
				@foreach(LaravelLocalization::getSupportedLocales() as $key => $lang)
				<a href="{{ LaravelLocalization::getLocalizedURL($key, null, [], true) }}" class="dropdown-item">{{ $lang['name'] }}</a>
				@endforeach
            </div>
		</li>
		
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
				<i class="fa fa-th-large"></i>
			</a>
        </li>

        <!-- User Setting dropdown menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                <i class="fa fa-gear"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-left">
                <a href="#" class="dropdown-item">
                    <i class="fa fa-user ml-2"></i> {{ __('dashboard.profile') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ url('/') }}" class="dropdown-item">
                    <i class="fa fa-shopping-cart ml-2"></i> {{ __('dashboard.store') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void" class="dropdown-item" onclick="this.children[1].submit()">
                    <i class="fa fa-sign-out ml-2"></i> {{ __('dashboard.logout') }}
                    <form action="{{ route('logout') }}" method="POST">@csrf</form>
                </a>
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
