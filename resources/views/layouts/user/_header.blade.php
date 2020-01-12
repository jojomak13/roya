<header>
    <div class="container">
        <div class="top-nav d-flex justify-content-end">
            <ul>
            @if(auth()->user())
                <li><a href="{{ route('profile') }}" title="@lang('user.header.myAccount')"><i class="fa fa-user"></i> @lang('user.header.myAccount')</a></li>
            @else
                <li><a href="{{ route('login') }}" title="@lang('user.header.login')"><i class="fa fa-lock"></i> @lang('user.header.login')</a></li>
            @endif
                <li><a href="#" title="@lang('user.header.wishlist')"><i class="fa fa-heart"></i> @lang('user.header.wishlist')</a></li>
                <li><a href="{{ route('cart.index') }}" title="@lang('user.header.mycart')"><i class="fa fa-shopping-cart"></i> @lang('user.header.mycart')</a></li>
            </ul>
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