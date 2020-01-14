<header>
    <div class="container">
        <div class="top-nav d-flex justify-content-between">
            <ul>
                @guest
                <li><a href="{{ route('login') }}" title="@lang('user.header.login')"><i class="fa fa-lock"></i> @lang('user.header.login')</a></li>
                @endguest
                <li><a href="#" title="@lang('user.header.wishlist')"><i class="fa fa-heart"></i> @lang('user.header.wishlist')</a></li>
                <li><a href="{{ route('cart.index') }}" title="@lang('user.header.mycart')"><i class="fa fa-shopping-cart"></i> @lang('user.header.mycart')</a></li>
                <li>
                    <div class="nav-dropdown dropdown">
                        <button class="dropdown-toggle" type="button" id="language" data-toggle="dropdown" aria-haspopup="true">
                            <i class="fa fa-globe"></i> {{ LaravelLocalization::getCurrentLocaleName() }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="language">
                            @foreach(LaravelLocalization::getSupportedLocales() as $key => $lang)
                                <a href="{{ LaravelLocalization::getLocalizedURL($key, null, [], true) }}" class="dropdown-item">{{ $lang['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
            @auth
            <ul>
                <li>
                    <div class="nav-dropdown dropdown">
                        <button class="dropdown-toggle" title="@lang('user.header.myAccount')" type="button" id="profile" data-toggle="dropdown" aria-haspopup="true">
                            <i class="fa fa-user"></i> {{ auth()->user()->first_name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="profile">
                            <a href="{{ route('profile') }}" class="dropdown-item">@lang('user.header.myAccount')</a>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">@lang('user.header.editProfile')</a>
                            <a href="javascript:void(0)" class="dropdown-item" onclick="this.children[0].submit()">@lang('user.header.logout')
                                <form action="{{ route('logout') }}" method="POST">@csrf</form>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            @endauth
        </div>
        <div class="middle-nav d-flex justify-content-between">
            <div class="image">
                <img src="{{ asset('user/images/logo.png') }}" class="img-fluid" alt="logo" title="logo">
            </div>
            <div class="search d-none d-lg-block">
                <div class="form-inline">
                    <select name="search">
                        <option value="d" selected>@lang('user.header.all')</option>
                        <option value="dd">Eelectronics</option>
                    </select>
                    <input type="text" placeholder="@lang('user.header.search')...">
                    <button><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="shopping-cart d-flex">
                <div>
                    <a class="btn" href="{{ route('cart.index') }}">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge badge-primary">15</span>
                    </a>
                </div>
                <button class="d-lg-none navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>