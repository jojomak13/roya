@extends('layouts.user.master')

@section('content')

<main>
    <!-- Start Head -->
    <section class="head">
        <div class="container">
            <div class="row">
                <!-- Start Categories -->
                <div class="col-lg-3 col-md-12">
                    <div class="cats card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-bars"></i> Categories</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li class="category-dropdown">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-truck"></i>
                                        <span>Fashion</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="category-dropdown-items">
                                        <li><a href="#">Home 1</a></li>
                                        <li><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li class="category-dropdown">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-shopping-bag"></i>
                                        <span>Clothing</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="category-dropdown-items">
                                        <li><a href="#">Home 1</a></li>
                                        <li><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-laptop"></i>
                                        <span>Eelectronics</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-paw"></i>
                                        <span>Shoes</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-clock-o"></i>
                                        <span>Watches</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-diamond"></i>
                                        <span>Jewellery</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-heartbeat"></i>
                                        <span>Health & Beauty</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-futbol-o"></i>
                                        <span>Sports</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-envira"></i>
                                        <span>Home and Garden</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Categories -->

                <!-- Start Slideshow -->
                <div class="col-lg-9 col-md-12">
                    <div class="slideshow">
                        <button class="prev"><i class="fa fa-chevron-left"></i></button>
                        <button class="next"><i class="fa fa-chevron-right"></i></button>
                        <div id="slideshow" class="owl-carousel  owl-theme">
                        @foreach($slideshows as $slide)
                            <div class="item">
                                <img class="owl-lazy" data-src="{{ url('storage/'.$slide->image) }}" class="img-fluid" alt="">
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="options bg-primary d-flex justify-content-between p-3 text-center text-white">
                        <div class="item">
                            <h5>Money Back</h5>
                            <p>30 Days Money Back Guarantee</p>
                        </div>
                        <div class="item">
                            <h5>Free Shiping</h5>
                            <p>Shipping on orders over $99</p>
                        </div>
                        <div class="item">
                            <h5>Special Sale</h5>
                            <p>Extra $5 off on all items</p>
                        </div>
                    </div>
                </div>
                <!-- End Slideshow -->

            </div>
        </div>
    </section>
    <!-- End Head -->

    <div class="container">
        <div class="row">

            <!-- Start Hot Deal -->
            <div class="col-lg-3">
                <section class="hot-deal">
                    <div class="section-head">
                        <h3>Special Offer</h3>
                    </div>
                    <div class="product-card active">
                        <div class="card-head">
                            <p class="category"><a href="#">Audio Speakers</a></p>
                            <h4><a href="#">Wireless Audio System</a></h4>
                            <span class="tag bg-danger">Hot</span>
                        </div>
                        <div class="image">
                            <img class="img-fluid" src="{{ asset('user/images/p-1.jpg') }}" alt="product name" title="product name">
                        </div>
                        <div class="info d-flex justify-content-between">
                            <p class="price">
                                <span class="text-danger">$1,999.00</span>
                                <del>$2,999.00</del>
                            </p>
                            <div class="d-flex align-self-center">
                                <a href="#" title="add to cart" class="cart"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="stars">
                            <span class="star checked"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End Hot Deal -->

            <!-- Start New Products -->
            <div class="col-lg-9">
                <section class="new-products">
                    <div class="section-head d-flex justify-content-between">
                        <h3>New Products</h3>
                        <div class="carousel-control d-flex align-self-center">
                            <button class="prev btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                            <button class="next btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div id="new-products" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="product-card">
                                <div class="card-head">
                                    <p class="category"><a href="#">Audio Speakers</a></p>
                                    <h4><a href="#">Wireless Audio System</a></h4>
                                </div>
                                <div class="image">
                                    <img class="img-fluid owl-lazy" data-src="{{ asset('user/images/p-1.jpg') }}" alt="product name"
                                        title="product name">
                                </div>
                                <div class="info d-flex justify-content-between">
                                    <p class="price">
                                        <span class="text-danger">$1,999.00</span>
                                        <del>$2,999.00</del>
                                    </p>
                                    <div class="d-flex align-self-center">
                                        <a href="#" title="add to cart" class="cart"><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <div class="stars">
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-card">
                                <div class="card-head">
                                    <p class="category"><a href="#">Audio Speakers</a></p>
                                    <h4><a href="#">Wireless Audio System</a></h4>
                                    <span class="tag bg-primary">NEW</span>
                                </div>
                                <div class="image">
                                    <img class="img-fluid owl-lazy" data-src="{{ asset('user/images/p-2.jpg') }}" alt="product name"
                                        title="product name">
                                </div>
                                <div class="info d-flex justify-content-between">
                                    <p class="price">
                                        <span>$1,999.00</span>
                                    </p>
                                    <div class=" d-flex align-self-center">
                                        <a href="#" title="add to cart" class="cart"><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <div class="stars">
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star"><i class="fa fa-star"></i></span>
                                    <span class="star"><i class="fa fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-card">
                                <div class="card-head">
                                    <p class="category"><a href="#">Audio Speakers</a></p>
                                    <h4><a href="#">Wireless Audio System</a></h4>
                                </div>
                                <div class="image">
                                    <img class="img-fluid owl-lazy" data-src="{{ asset('user/images/p-3.jpg') }}" alt="product name"
                                        title="product name">
                                </div>
                                <div class="info d-flex justify-content-between">
                                    <p class="price">
                                        <span class="text-danger">$1,999.00</span>
                                        <del>$2,999.00</del>
                                    </p>
                                    <div class="d-flex align-self-center">
                                        <a href="#" title="add to cart" class="cart"><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <div class="stars">
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star checked"><i class="fa fa-star"></i></span>
                                    <span class="star"><i class="fa fa-star"></i></span>
                                    <span class="star"><i class="fa fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End New Products -->

        </div>
    </div>

    <!-- Start Deals -->
    <section class="deals">
        <div class="container">
            <div class="deal-ad">
                <img src="{{ asset('user/images/ad.jpg') }}" class="img-fluid" alt="ad" title="ad">
                <div class="mask">
                    <div class="content">
                        <h3>Black Friday Offer</h3>
                        <h4>Up To <span class="text-warning">50%</span></h4>
                        <a href="#" class="btn btn-primary">Show More</a>
                    </div>
                </div>
            </div>
            <div class="deal-products">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card">
                            <div class="card-head">
                                <p class="category"><a href="#">Audio Speakers</a></p>
                                <h4><a href="#">Wireless Audio System</a></h4>
                                <span class="tag bg-warning">offer</span>
                            </div>
                            <div class="image">
                                <img class="img-fluid" src="{{ asset('user/images/p-2.jpg') }}" alt="product name" title="product name">
                            </div>
                            <div class="info d-flex justify-content-between">
                                <p class="price">
                                    <span>$1,999.00</span>
                                </p>
                                <div class=" d-flex align-self-center">
                                    <a href="#" title="add to cart" class="cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="stars">
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card">
                            <div class="card-head">
                                <p class="category"><a href="#">Audio Speakers</a></p>
                                <h4><a href="#">Wireless Audio System</a></h4>
                                <span class="tag bg-warning">offer</span>
                            </div>
                            <div class="image">
                                <img class="img-fluid" src="{{ asset('user/images/p-2.jpg') }}" alt="product name" title="product name">
                            </div>
                            <div class="info d-flex justify-content-between">
                                <p class="price">
                                    <span>$1,999.00</span>
                                </p>
                                <div class=" d-flex align-self-center">
                                    <a href="#" title="add to cart" class="cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="stars">
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card">
                            <div class="card-head">
                                <p class="category"><a href="#">Audio Speakers</a></p>
                                <h4><a href="#">Wireless Audio System</a></h4>
                                <span class="tag bg-warning">offer</span>
                            </div>
                            <div class="image">
                                <img class="img-fluid" src="{{ asset('user/images/p-2.jpg') }}" alt="product name" title="product name">
                            </div>
                            <div class="info d-flex justify-content-between">
                                <p class="price">
                                    <span>$1,999.00</span>
                                </p>
                                <div class=" d-flex align-self-center">
                                    <a href="#" title="add to cart" class="cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="stars">
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card">
                            <div class="card-head">
                                <p class="category"><a href="#">Audio Speakers</a></p>
                                <h4><a href="#">Wireless Audio System</a></h4>
                                <span class="tag bg-warning">offer</span>
                            </div>
                            <div class="image">
                                <img class="img-fluid" src="{{ asset('user/images/p-2.jpg') }}" alt="product name" title="product name">
                            </div>
                            <div class="info d-flex justify-content-between">
                                <p class="price">
                                    <span>$1,999.00</span>
                                </p>
                                <div class=" d-flex align-self-center">
                                    <a href="#" title="add to cart" class="cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="stars">
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star checked"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                                <span class="star"><i class="fa fa-star"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Deals -->

    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <div class="news-letter">
                    <div class="section-head">
                        <h3>News Letter</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-2 text-muted">Sign Up for Our Newsletter!</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Your Email" class="form-control">
                                </div>
                                <button type="submit" class="pull-right btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tags">
                    <div class="section-head">
                        <h3>Products Tags</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <span class="tag"><a href="">Phone</a></span>
                            <span class="tag"><a href="">Vest</a></span>
                            <span class="tag"><a href="">T-Shirt</a></span>
                            <span class="tag"><a href="">SmartPhones</a></span>
                            <span class="tag"><a href="">Toys</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Best Seller -->
            <div class="col-lg-9">
                <section class="best-seller new-products">
                    <div class="section-head d-flex justify-content-between">
                        <h3>Best Seller</h3>
                        <div class="carousel-control d-flex align-self-center">
                            <button class="prev btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                            <button class="next btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div class="row">
                        <div id="best-seller" class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="product-card">
                                    <div class="card-head">
                                        <p class="category"><a href="#">Audio Speakers</a></p>
                                        <h4><a href="#">Wireless Audio System</a></h4>
                                    </div>
                                    <div class="image">
                                        <img class="img-fluid owl-lazy" data-src="{{ asset('user/images/p-1.jpg') }}" alt="product name"
                                            title="product name">
                                    </div>
                                    <div class="info d-flex justify-content-between">
                                        <p class="price">
                                            <span class="text-danger">$1,999.00</span>
                                            <del>$2,999.00</del>
                                        </p>
                                        <div class="d-flex align-self-center">
                                            <a href="#" title="add to cart" class="cart"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="stars">
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="product-card">
                                    <div class="card-head">
                                        <p class="category"><a href="#">Audio Speakers</a></p>
                                        <h4><a href="#">Wireless Audio System</a></h4>
                                    </div>
                                    <div class="image">
                                        <img class="img-fluid owl-lazy" data-src="{{ asset('user/images/p-2.jpg') }}" alt="product name"
                                            title="product name">
                                    </div>
                                    <div class="info d-flex justify-content-between">
                                        <p class="price">
                                            <span>$1,999.00</span>
                                        </p>
                                        <div class=" d-flex align-self-center">
                                            <a href="#" title="add to cart" class="cart"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="stars">
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star"><i class="fa fa-star"></i></span>
                                        <span class="star"><i class="fa fa-star"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="product-card">
                                    <div class="card-head">
                                        <p class="category"><a href="#">Audio Speakers</a></p>
                                        <h4><a href="#">Wireless Audio System</a></h4>
                                    </div>
                                    <div class="image">
                                        <img class="img-fluid owl-lazy" data-src="{{ asset('user/images/p-3.jpg') }}" alt="product name"
                                            title="product name">
                                    </div>
                                    <div class="info d-flex justify-content-between">
                                        <p class="price">
                                            <span class="text-danger">$1,999.00</span>
                                            <del>$2,999.00</del>
                                        </p>
                                        <div class="d-flex align-self-center">
                                            <a href="#" title="add to cart" class="cart"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="stars">
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                        <span class="star checked"><i class="fa fa-star"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End Best Seller -->

        </div>
    </div>

    <!-- Start Latest Blogs -->
    <section class="latest-blogs">
        <div class="container">
            <div class="section-head d-flex justify-content-between">
                <h3>Latest Blogs</h3>
                <div class="carousel-control d-flex align-self-center">
                    <button class="prev btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                    <button class="next btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
            <div id="latest-blogs" class="owl-carousel owl-theme">
                <div class="item card blog">
                    <div class="card-body">
                        <div class="image">
                            <img class="owl-lazy" data-src="{{ asset('user/images/blog-2.jpg') }}" alt="article title"
                                title="article title">
                        </div>
                        <h3 class="title"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                        <p clas="title">By <a href="#" class="author">Joseph</a> | 21 March 2019</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, nulla.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                <div class="item card blog">
                    <div class="card-body">
                        <div class="image">
                            <img class="owl-lazy" data-src="{{ asset('user/images/blog-1.jpg') }}" alt="article title"
                                title="article title">
                        </div>
                        <h3 class="title"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                        <p clas="title">By <a href="#" class="author">Joseph</a> | 21 March 2019</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, nulla.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End Latest Blogs -->
</main>
@endsection
