<header>
    <div class="top-nav">
        <div class="container d-flex justify-content-between">
            <ul>
                @guest
                <li><a href="{{ route('login') }}" title="@lang('user.header.login')"><i class="fa fa-lock"></i> @lang('user.header.login')</a></li>
                @endguest
                <li><a href="{{ route('wishlist.index') }}" title="@lang('user.header.wishlist')"><i class="fa fa-heart"></i> @lang('user.header.wishlist')</a></li>
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
    </div>
    <div class="container">
        <div class="middle-nav d-flex justify-content-between align-items-center">
            <div class="image">
                <img src="{{ asset('user/images/logo.png') }}" class="img-fluid" alt="@lang('app.name')" title="@lang('app.name')">
            </div>
            <div class="search d-none d-lg-block">
                <div class="form-inline">
                    <div class="search-bar">
                        <input id="search" autocomplete="off" type="text" name="search" placeholder="@lang('user.header.search')...">
                        <div id="result" class="result">
                            <ul></ul>
                            <p class="text-center">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal" title="@lang('user.header.recommend')">@lang('user.header.recommend')</a>
                            </p>
                        </div>
                    </div>
                    <button><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="shopping-cart d-flex">
                <div>
                    <a href="{{ route('wishlist.index') }}" class="text-white" title="@lang('user.header.wishlist')"><i class="fa fa-heart"></i></a>
                    <a class="btn" href="{{ route('cart.index') }}">
                        <i class="fa fa-shopping-cart"></i>
                        @auth
                            <span class="badge badge-danger">{{ auth()->user()->cartQuantity() }}</span>
                        @endauth
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

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('recommend') }}" method="POST" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('user.header.recommend')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="from-group">
                            <label for="title">@lang('user.header.productName')</label>
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('user.header.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('user.header.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</header>
