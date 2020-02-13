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
