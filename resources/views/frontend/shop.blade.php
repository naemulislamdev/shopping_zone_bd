@extends('frontend.layouts.master')
@section('title','Shop')
@section('content')
<style>
    .menu-area > ul > li > a {
    color: #1a1919;
}
.header-icon > a > .fa {
    color: #1a1919;
}
</style>
<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="shop-filter-box">
                    <!------shopping cart canva-->
                    <div class="" id="productFilter">
                        <div class="filter-header">
                            <h5 class="shop-filter-title">Filter the product you want</h5>
                        </div>
                        <div class="filter-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="wrapper">
                                        <h4 class="color-heading">Price</h4>
                                        <div class="price-input">
                                            <div class="field">
                                                <span>Min</span>
                                                <input type="number" class="input-min" value="2500">
                                            </div>
                                            <div class="separator">-</div>
                                            <div class="field">
                                                <span>Max</span>
                                                <input type="number" class="input-max" value="7500">
                                            </div>
                                        </div>
                                        <div class="slider">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <input type="range" class="range-min" min="0" max="10000"
                                                value="2500" step="100">
                                            <input type="range" class="range-max" min="0" max="10000"
                                                value="7500" step="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 mx-auto">
                                    <a href="#" class="w-100 common-btn">Search</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="color-heading">Categories:</h4>
                                    <!--start Filter Category-->
                                    <div class="category-filter">
                                        <div class="category">
                                            <div class="category-header">
                                                <a href="#">Electronics</a>
                                                <span class="toggle-icon" data-toggle="electronics">+</span>
                                            </div>
                                            <div class="sub-categories" id="electronics">
                                                <div class="sub-category">
                                                    <div class="sub-category-header">
                                                        <a href="#">Mobiles</a>
                                                        <span class="toggle-icon" data-toggle="mobiles">+</span>
                                                    </div>
                                                    <div class="child-categories" id="mobiles">
                                                        <a href="#">Smartphones</a><br>
                                                        <a href="#">Feature Phones</a>
                                                    </div>
                                                </div>
                                                <div class="sub-category">
                                                    <div class="sub-category-header">
                                                        <a href="#">Televisions</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category">
                                            <div class="category-header">
                                                <a href="#">Fashion</a>
                                                <span class="toggle-icon" data-toggle="fashion">+</span>
                                            </div>
                                            <div class="sub-categories" id="fashion">
                                                <div class="sub-category">
                                                    <div class="sub-category-header">
                                                        <a href="#">Men</a>
                                                        <span class="toggle-icon" data-toggle="men">+</span>
                                                    </div>
                                                    <div class="child-categories" id="men">
                                                        <a href="#">Clothing</a><br>
                                                        <a href="#">Shoes</a>
                                                    </div>
                                                </div>
                                                <div class="sub-category">
                                                    <div class="sub-category-header">
                                                        <a href="#">Women</a>
                                                        <span class="toggle-icon" data-toggle="women">+</span>
                                                    </div>
                                                    <div class="child-categories" id="women">
                                                        <a href="#">Clothing</a><br>
                                                        <a href="#">Accessories</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end category filter-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="color-selection mb-3">
                                        <h4 class="color-heading">Color:</h4>
                                        <div class="color-filter">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="color"
                                                    id="colorRed" value="red">
                                                <label class="form-check-label" for="colorRed">
                                                    <span class="color-box" style="background-color: red;"></span> Red
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="color"
                                                    id="colorGreen" value="green">
                                                <label class="form-check-label" for="colorGreen">
                                                    <span class="color-box" style="background-color: green;"></span>
                                                    Green
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="color"
                                                    id="colorBlue" value="blue">
                                                <label class="form-check-label" for="colorBlue">
                                                    <span class="color-box" style="background-color: blue;"></span>
                                                    Blue
                                                </label>
                                            </div>
                                            <!-- Add more colors as needed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="color-selection mb-3">
                                        <h4 class="color-heading">Brand:</h4>
                                        <div class="brand-filter">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="brand"
                                                    id="brandNike" value="nike">
                                                <label class="form-check-label" for="brandNike">
                                                    <span class="brand-logo"
                                                        style="background-image: url('https://via.placeholder.com/20x20?text=N');"></span>
                                                    Nike
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="brand"
                                                    id="brandAdidas" value="adidas">
                                                <label class="form-check-label" for="brandAdidas">
                                                    <span class="brand-logo"
                                                        style="background-image: url('https://via.placeholder.com/20x20?text=A');"></span>
                                                    Adidas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="brand"
                                                    id="brandPuma" value="puma">
                                                <label class="form-check-label" for="brandPuma">
                                                    <span class="brand-logo"
                                                        style="background-image: url('https://via.placeholder.com/20x20?text=P');"></span>
                                                    Puma
                                                </label>
                                            </div>
                                            <!-- Add more brands as needed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!------End shopping cart canva-->
                </div>
            </div>
            <div class="col-md-9">
                <div class="row mb-3">
                    <div class="col text-center">
                        <div class="section-heading-title">
                            <h3>Shopping</h3>
                            <div class="heading-border"></div>
                        </div>
                        <div class="grid-controls">
                            <button class="grid-btn" data-columns="6" data-category="category">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn" data-columns="4" data-category="category">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn" data-columns="3" data-category="category">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn" data-columns="2" data-category="category">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                        </div>
                        <div class="grid-controls mobile-grid-controls">
                            <button class="grid-btn grid-btn-mobile" data-columns="12" data-category="category">
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn grid-btn-mobile" data-columns="6" data-category="category">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-grid">
                    <div class="row">
                        <!-- Your product columns go here -->
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/1.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/2.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/3.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/4.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/5.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/6.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/7.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                <div class="product-box">
                    <div class="product-image2">
                        <div class="discount-box float-end">
                            <span>50%</span>
                        </div>
                        <a href="product_description.html">
                            <img class="pic-1" src="{{ asset('public/frontend')}}/assets/images/product-img/8.jpg">
                            <img class="pic-2" src="{{ asset('public/frontend')}}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="product_description.html" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="product_description.html">Women's Designer Top</a></h3>
                       <div class="price d-flex justify-content-center align-content-center">
                        <span class="mr-2">৳ 599.99</span>
                        <del>৳ 699.99</del>
                       </div>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-12">
                <div class="big-banner">
                    <img src="{{ asset('public/frontend')}}/assets/images/product-banner/main-banner3.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush
