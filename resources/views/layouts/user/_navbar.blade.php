{{-- Start Navbar --}}
<div class="bottom-nav">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">@lang('user.header.home') <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">@lang('user.title.shop')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">@lang('user.title.blog')</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
{{-- End Navbar --}}