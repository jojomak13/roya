@include('layouts.user._brands')

<!-- Start Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4>@lang('user.footer.contactus')</h4>
                <ul>
                    <li><i class="fa fa-map-marker"></i> @lang('app.address')</li>
                    <li><i class="fa fa-phone"></i> @lang('app.phone')</li>
                    <li><i class="fa fa-envelope"></i> @lang('app.mail')</li>
                </ul>
            </div>
            <div class="col-lg-4 site-map">
                <h4>@lang('user.footer.siteMap')</h4>
                <ul>
                    <li><a href="{{ route('home') }}">@lang('user.title.home')</a></li>
                    <li><a href="{{ route('shop') }}">@lang('user.title.shop')</a></li>
                    <li><a href="{{ route('blog.index') }}">@lang('user.title.blog')</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4 latest-blogs">
                <h4>@lang('user.footer.latestProducts')</h4>
                <ul>
                    @foreach($products as $product)
                    <li><a href="{{ $product->url }}">{{ $product->{lang('name')} }}<a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p><i class="fa fa-code"></i> with <i class="fa fa-heart"></i> By <a href="#">Joseph Makram</a></p>
        </div>
    </div>
</footer>
<!-- End Footer -->