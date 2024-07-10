<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <!-- <a class="navbar-brand" href="index.html">Shopping Zone BD</a> -->
                <a href="{{ route('home') }}">
                    <img class="header-logo" src="{{ asset('public/frontend') }}/assets/images/logo/main-logo.png"
                        alt="">
                </a>
            </div>
            <div class="col-md-8">
                <nav class="navbar">
                    <div class="menu-area">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>

                            <li class="dd-btn1"><a href="#"> Categories <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu1">
                                    <ul>
                                        <li class="dd-btn2"><a href="{{ route('category') }}"><i
                                                    class="fa fa-long-arrow-right"></i> Hari Tools <i
                                                    class="fa fa-angle-right float-right mt-1"></i></a>
                                            <div class="dropdown-menu2">
                                                <ul class="w-nav-list level_3">
                                                    <li class="dd-btn3"><a href="#">Hair cutting<i
                                                                class="fa fa-angle-right float-right mt-1"></i></a>
                                                        <div class="dropdown-menu3">
                                                            <ul class="w-nav-list level_3">
                                                                <li><a href="#">Child manue</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="dd-btn2"><a href="#"><i class="fa fa-long-arrow-right"></i>
                                                Face Makup <i class="fa fa-angle-right float-right mt-1"></i></a>
                                            <div class="dropdown-menu2">
                                                <ul>
                                                    <li><a href="#">Makup one</a></li>
                                                    <li><a href="#">Makup two</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="dd-btn2"><a href="#"><i class="fa fa-long-arrow-right"></i>Face
                                                & Body Care<i class="fa fa-angle-right float-right mt-1"></i></a>
                                        </li>
                                        <li class="dd-btn2"><a href="#"><i class="fa fa-long-arrow-right"></i>Lip
                                                Beauty<i class="fa fa-angle-right float-right mt-1"></i></a></li>
                                        <li class="dd-btn2"><a href="#"><i class="fa fa-long-arrow-right"></i>Hari
                                                Care<i class="fa fa-angle-right float-right mt-1"></i></a></li>
                                        <li class="dd-btn2"><a href="#"><i
                                                    class="fa fa-long-arrow-right"></i>Clothing<i
                                                    class="fa fa-angle-right float-right mt-1"></i></a></li>
                                        <li class="dd-btn2"><a href="#"><i class="fa fa-long-arrow-right"></i>Eye
                                                Makeup<i class="fa fa-angle-right float-right mt-1"></i></a></li>
                                        <li class="dd-btn2"><a href="#"><i
                                                    class="fa fa-long-arrow-right"></i>Jewellery<i
                                                    class="fa fa-angle-right float-right mt-1"></i></a></li>
                                        <li class="dd-btn2"><a href="#"><i
                                                    class="fa fa-long-arrow-right"></i>Ladies Bag<i
                                                    class="fa fa-angle-right float-right mt-1"></i></a></li>
                                        <li class="dd-btn2"><a href="#"><i
                                                    class="fa fa-long-arrow-right"></i>Saree<i
                                                    class="fa fa-angle-right float-right mt-1"></i></a></li>
                                        <li class="dd-btn2"><a href="#"><i
                                                    class="fa fa-long-arrow-right"></i>Cosmetics<i
                                                    class="fa fa-angle-right float-right mt-1"></i></a></li>

                                    </ul>
                                </div>

                            </li>
                            <li><a href="{{ route('shop')}}">Shop</i></a>
                            </li>
                            <li><a href="#!">video Shopping</i></a>
                            </li>
                            <li><a href="#!">Campain</i></a>
                            </li>
                            <li><a href="#!">Selling product</i></a>
                            </li>
                            <li><a href="{{ route('outlets')}}">Our outlets</i></a></li>
                        </ul>
                    </div>

                    <i class="fa fa-bars menu-icon"></i>
                </nav>
            </div>
            <div class="col-md-2">
                <div class="header-icon">
                    <a data-bs-toggle="offcanvas" href="#searchOffcanvas" role="button"
                        aria-controls="searchOffcanvas"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i><span
                            class="badge badge-danger">0</span></a>

                    <a data-bs-toggle="offcanvas" href="#shoppingCartOffcanvas" role="button"
                        aria-controls="shoppingCartOffcanvas"><i class="fa fa-shopping-cart"
                            aria-hidden="true"></i><span class="badge badge-danger">0</span></a>
                </div>
            </div>
        </div>
    </div>
</header>
<!--end header-->
<!--start mobile menu-->
<div class="mobile-menu">
    <div class="mm-logo" style="background: #fff; padding: 11px 18px;">
        <a href="{{ route('home') }}">
            <img style="width:220px;" src="{{ asset('public/frontend') }}/assets/images/logo/main-logo.png"
                alt="">
        </a>
        <div class="mm-cross-icon">
            <i class="fa fa-times mm-ci"></i>
        </div>
    </div>
    <div class="mm-menu">
        <div class="accordion" id="accordionExample">
            <div class="menu-box">
                <div class="menu-link">
                    <a href="{{ route('home') }}"><i class="fa fa-ptab3 mr-2"></i> Home</a>
                </div>
            </div>
            <div class="menu-box">
                <div class="menu-link" id="headingOne">
                    <a class="mmenu-btn menu-link-active" type="button" data-toggle="collapse"
                        data-target="#categories" aria-expanded="true">Categories<i class="fa fa-plus"></i></a>
                </div>
                <div id="categories" class="menu-body collapse" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            <li class="mega-dd-btn-2">
                                <div class="menu-link d-flex justify-content-between">
                                    <a href="{{ route('category') }}">Category</a>
                                    <a data-toggle="collapse" type="button" data-target="#category"
                                        aria-expanded="true"><i class="fa fa-plus"></i></a>
                                </div>
                                <div class="collapse" id="category">
                                    <div class="card card-body">
                                        <ul class="mega-item">
                                            <li class="mega-dd-btn-2">
                                                <div class="menu-link d-flex justify-content-between">
                                                    <a href="#">Sub Category</a>
                                                    <a type="button" data-toggle="collapse"
                                                        data-target="#subCategory" aria-expanded="true"><i
                                                            class="fa fa-plus"></i></a>
                                                </div>
                                                <div class="collapse" id="subCategory">
                                                    <div class="card card-body">
                                                        <ul class="mega-item">
                                                            <li><a href="#">Face Makeup</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-box">
                <div class="menu-link">
                    <a href="#"><i class="fa fa-ptab3 mr-2"></i> Shop</a>
                </div>
            </div>
            <div class="menu-box">
                <div class="menu-link">
                    <a href="#"><i class="fa fa-ptab3 mr-2"></i> Video Shopping</a>
                </div>
            </div>
            <div class="menu-box">
                <div class="menu-link">
                    <a href="#"><i class="fa fa-ptab3 mr-2"></i>Campain</a>
                </div>
            </div>
            <div class="menu-box">
                <div class="menu-link">
                    <a href="#"><i class="fa fa-ptab3 mr-2"></i>Selling Product</a>
                </div>
            </div>
            <div class="menu-box">
                <div class="menu-link">
                    <a href="#"><i class="fa fa-ptab3 mr-2"></i>Our Outlets</a>
                </div>
            </div>
        </div>
    </div>
</div>

