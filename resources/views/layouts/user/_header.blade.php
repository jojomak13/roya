<header>
    <div class="container">
        <div class="top-nav d-flex justify-content-end">
            <ul>
                <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                <li><a href="#"><i class="fa fa-lock"></i> Login</a></li>
            </ul>
        </div>
        <div class="middle-nav d-flex justify-content-between">
            <div class="image">
                <img src="{{ asset('user/images/logo.png') }}" class="img-fluid" alt="logo" title="logo">
            </div>
            <div class="search d-none d-lg-block">
                <div class="form-inline">
                    <select name="search">
                        <option value="d" selected>All</option>
                        <option value="dd">Eelectronics</option>
                    </select>
                    <input type="text" placeholder="Search...">
                    <button><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="shopping-cart d-flex">
                <div>
                    <a class="btn" href="#">
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