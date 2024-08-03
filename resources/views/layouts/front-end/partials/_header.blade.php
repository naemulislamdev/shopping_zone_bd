<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <!-- <a class="navbar-brand" href="index.html">Shopping Zone BD</a> -->
                <a href="{{ route('home') }}">
                    <img class="header-logo" src="{{ asset('public/assets/front-end') }}/images/logo/main-logo.png"
                        alt="">
                </a>
            </div>
            <div class="col-md-8">
                @php($categories = \App\CPU\CategoryManager::parents())
                <nav class="navbar">
                    <div class="menu-area">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>

                            <li class="dd-btn1"><a href="#"> Categories <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu1">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li class="dd-btn2"><a
                                                    href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                                    <img src="{{ asset("storage/app/public/category/$category->icon") }}"
                                                        onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                        style="width: 18px; height: 18px; ">
                                                    {{ $category['name'] }} <i
                                                        class="fa fa-angle-right float-right mt-1"></i></a>
                                                @if ($category->childes->count() > 0)
                                                    <div class="dropdown-menu2">
                                                        <ul class="w-nav-list level_3">
                                                            @foreach ($category['childes'] as $subCategory)
                                                                <li class="dd-btn3"><a
                                                                        href="{{ route('products', ['id' => $subCategory['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $subCategory['name'] }}
                                                                        <i
                                                                            class="fa fa-angle-right float-right mt-1"></i></a>
                                                                    @if ($subCategory->childes->count() > 0)
                                                                        <div class="dropdown-menu3">
                                                                            <ul class="w-nav-list level_3">
                                                                                @foreach ($subCategory['childes'] as $subSubCategory)
                                                                                    <li><a
                                                                                            href="{{ route('products', ['id' => $subSubCategory['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $subSubCategory['name'] }}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </li>
                            <li><a href="{{ route('shop') }}">Shop</i></a>
                            </li>
                            <li><a href="#!">video Shopping</i></a>
                            </li>
                            <li><a href="#!">Campain</i></a>
                            </li>
                            <li><a href="#!">Selling product</i></a>
                            </li>
                            <li><a href="{{ route('outlets') }}">Our outlets</i></a></li>
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
                            aria-hidden="true"></i><span class="badge badge-danger" id="total_cart_count">
                                {{session()->has('cart') ? count(session()->get('cart')) : 0}}
                        </span></a>
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
