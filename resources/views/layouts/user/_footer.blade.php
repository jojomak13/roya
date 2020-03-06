@include('layouts.user._brands')

<!-- Start Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 info">
                <h4>@lang('user.footer.contactus')</h4>
                <ul>
                    <li><i class="fa fa-map-marker"></i> <a href="https://www.google.com/maps/place/30%C2%B016'42.3%22N+31%C2%B044'35.5%22E/@30.2784283,31.7410123,17z" target="_blank">@lang('app.address')</a></li>
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
            <p><i class="fa fa-code"></i> with <i class="fa fa-heart"></i> By <a href="https://www.linkedin.com/in/joseph-makram" target="_blank">Joseph Makram</a></p>
        </div>
    </div>
</footer>
<!-- End Footer -->