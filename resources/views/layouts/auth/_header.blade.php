<header>
    <div class="container">
        <div class="top-nav d-flex justify-content-end">
            <ul>
            @if(auth()->user())
                <li><a href="#" title="@lang('user.header.myAccount')"><i class="fa fa-user"></i> @lang('user.header.myAccount')</a></li>
            @else
                <li><a href="{{ route('login') }}" title="@lang('user.header.login')"><i class="fa fa-lock"></i> @lang('user.header.login')</a></li>
            @endif
                <li><a href="#" title="@lang('user.header.wishlist')"><i class="fa fa-heart"></i> @lang('user.header.wishlist')</a></li>
                <li><a href="{{ route('cart.index') }}" title="@lang('user.header.mycart')"><i class="fa fa-shopping-cart"></i> @lang('user.header.mycart')</a></li>
            </ul>
        </div>
    </div>
</header>