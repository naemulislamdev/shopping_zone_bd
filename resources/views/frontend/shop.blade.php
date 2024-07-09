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
        <div class="row product-grid">
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
