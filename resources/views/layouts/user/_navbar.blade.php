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
                        <a class="nav-link" href="{{ route('blog.index') }}">@lang('user.title.blog')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Eelectronics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Watches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Phones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shoes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pages
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./category.html">Category</a>
                            <a class="dropdown-item" href="./product.html">Product</a>
                            <a class="dropdown-item" href="./cart.html">Cart</a>
                            <a class="dropdown-item" href="./checkout.html">Checkout</a>
                            <a class="dropdown-item" href="#">Profile</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
{{-- End Navbar --}}