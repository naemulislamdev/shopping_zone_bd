@extends('frontend.layouts.master')
@section('title', 'Product Details')
@section('content')
    <style>
        .owl-carousel .owl-dots.disabled,
        .owl-carousel .owl-nav.disabled {
            display: block;
        }

        .owl-carousel .owl-nav button.owl-prev,
        .owl-carousel .owl-nav button.owl-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #fff;
            /* Customize as needed */
            border: none;
            padding: 10px;
            /* Customize as needed */
            cursor: pointer;
            z-index: 1000;
            /* Ensure buttons are above other content */
        }

        .owl-carousel .owl-nav button.owl-prev {
            left: -30px;
            color: #f26d21;
            font-size: 35px;
        }

        .owl-carousel .owl-nav button.owl-next {
            right: -30px;
            color: #f26d21;
            font-size: 35px;
        }

        .owl-carousel .owl-nav button.owl-prev,
        .owl-carousel .owl-nav button.owl-next {
            outline: none;
        }

        .card-header {
            padding: 6px 0px;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 0px solid rgba(0, 0, 0, .125);
        }

        .card {
            border: 0px solid rgba(0, 0, 0, .125);
        }

        .card-header {
            cursor: pointer;
        }

        .toggle-icon {
            cursor: pointer;
            background: #343a40;
            padding: 6px 24px;
            border-radius: 5px;
            color: #fff;
            font-size: 17px;
            font-weight: 800;
        }

        .btn-link {
            text-decoration: none;
            font-weight: bold;
            color: #7d7d7d;
        }

        .btn-link:hover {
            text-decoration: none;
            color: #7d7d7d;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 9999;
            border-bottom: 1px solid hsla(0, 0%, 100%, .14);
            background: #fff;
            transition: 0.5s;
        }

        .menu-area>ul>li>a {
            text-decoration: none;
            color: #343a40;
        }

        .menu-icon {
            color: #504f4f;
        }

        .header-icon>a>.fa {
            color: #464545;
        }

        .main-image>img {
            width: 100% !important;
        }
    </style>
    <?php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $rating = \App\CPU\ProductManager::get_rating($product->reviews);
    $decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings');
    ?>
    <section class="" style="margin-top: 88px;">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <div class="p-image">
                        <div class="row mb-2">
                            <div class="col-md-7 mx-auto">
                                <div class="main-image mb-3 float-right" id="img-zoom">
                                    <img id="main-image"
                                        src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
                                        xoriginal="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
                                        class="img-fluid xzoom" alt="Product Image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <div class="p-details-sub-img owl-carousel owl-theme">
                                    @if ($product->images != null)
                                        @foreach (json_decode($product->images) as $key => $photo)
                                            <div class="item">
                                                <a href="{{ asset("storage/app/public/product/$photo") }}">
                                                    <img src="{{ asset("storage/app/public/product/$photo") }}"
                                                        class="xzoom-gallery" alt="product image">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 mb-3">
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <div class="p-details">
                                <h1 class="product-name">{{ $product->name }}</h1>

                                <span class="product-price">{{ \App\CPU\Helpers::get_price_range($product) }}</span>

                                @if ($product->discount > 0)
                                    <span class="discount-price">
                                        <del>{{ \App\CPU\Helpers::currency_converter($product->unit_price) }} </del> -
                                        {{ $product->discount }}%</span>
                                @endif
                                <p class="product-description">This is a great product that you will love. It has many
                                    amazing features and benefits that make it a must-have item.</p>

                                <div class="color-selection mb-3">
                                    <label for="color">Color:</label>
                                    <div class="d-flex">
                                        @foreach (json_decode($product->colors) as $key => $color)
                                            <div>
                                                <li>
                                                    <input type="radio"
                                                        id="{{ $product->id }}-color-{{ $key }}" name="color"
                                                        value="{{ $color }}"
                                                        @if ($key == 0) checked @endif>
                                                    <label style="background: {{ $color }};"
                                                        for="{{ $product->id }}-color-{{ $key }}"
                                                        data-toggle="tooltip"></label>
                                                </li>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="size-selection mb-3">
                                    <label for="size">Size:</label>
                                    <select id="size" class="form-control w-50">
                                        <option>Small</option>
                                        <option>Medium</option>
                                        <option>Large</option>
                                    </select>
                                </div>
                                <form id="add-to-cart-form" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">

                                    <div class="row mb-3">
                                        <div class="col-md-5 mb-2">
                                            <div class="input-group mt-1">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="decrementValue()">-</button>
                                                </div>
                                                <input type="text" id="quantity" class="form-control text-center"
                                                    value="{{ $product->minimum_order_qty ?? 1 }}" readonly
                                                    min="{{ $product->minimum_order_qty ?? 1 }}" max="100">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="incrementValue()">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="d-flex justify-content-center align-content-center mt-2">
                                                <span class="instock">Instock: 5</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <a href="#" class="w-100 common-btn">Order Now</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-dark btn-block" onclick="addToCart()">Add to
                                                Cart</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="accordion mb-3" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between align-items-center"
                                                    id="productDescription">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                            data-target="#description" aria-expanded="true"
                                                            aria-controls="description">
                                                            Description
                                                        </button>
                                                    </h5>
                                                    <span class="toggle-icon" data-toggle="collapse"
                                                        data-target="#description" aria-expanded="true"
                                                        aria-controls="description"><i class="fa fa-plus"></i></span>
                                                </div>

                                                <div id="description" class="collapse" aria-labelledby="productDescription"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <p>
                                                            {!! $product['details'] !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between align-items-center"
                                                    id="review">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                            data-toggle="collapse" data-target="#reviewCollapse"
                                                            aria-expanded="true" aria-controls="reviewCollapse">
                                                            Review
                                                        </button>
                                                    </h5>
                                                    <span class="toggle-icon" data-toggle="collapse"
                                                        data-target="#reviewCollapse" aria-expanded="true"
                                                        aria-controls="reviewCollapse"><i class="fa fa-plus"></i></span>
                                                </div>

                                                <div id="reviewCollapse" class="collapse" aria-labelledby="review"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <p>There have been no reviews for this product yet.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="p-details-contact-section">
                                <div class="contact-box d-flex justify-content-between">
                                    <div class="box1">
                                        <p><i class="fa fa-phone"></i> contact:</p>
                                        <p><i class="fa fa-motorcycle"></i> Inside Dhaka:</p>
                                        <p><i class="fa fa-truck"></i> Outside Dhaka:</p>
                                        <p><i class="fa fa-money"></i> Cash on Delivery:</p>
                                        <p><i class="fa fa-refresh"></i> Refund Rules:</p>
                                    </div>
                                    <div class="box1">
                                        <a href="#">
                                            <p>01406667669</p>
                                        </a>
                                        <p>2-3 working days</p>
                                        <p>3-4 working days</p>
                                        <p>Available</p>
                                        <p>Within 7 Days<a href="#"> View Policy</a></p>
                                    </div>
                                </div>
                                <div class="pay-method">
                                    <span>Payment</span>
                                    <img src="{{ asset('public/frontend') }}/assets/images/payment/payment.png"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col text-center">
                    <div class="section-heading-title">
                        <h3>Related products</h3>
                        <div class="heading-border"></div>
                    </div>
                    <div class="grid-controls">
                        <button class="grid-btn" data-columns="6" data-category="category3">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn" data-columns="4" data-category="category3">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn" data-columns="3" data-category="category3">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn" data-columns="2" data-category="category3">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                    </div>
                    <div class="grid-controls mobile-grid-controls">
                        <button class="grid-btn grid-btn-mobile" data-columns="12" data-category="category3">
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn grid-btn-mobile" data-columns="6" data-category="category3">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row product-grid">
                <!-- Your product columns go here -->
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img1.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1" src="{{ asset('public/frontend') }}/assets/images/product-img/7.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1" src="{{ asset('public/frontend') }}/assets/images/product-img/8.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1" src="{{ asset('public/frontend') }}/assets/images/product-img/5.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1" src="{{ asset('public/frontend') }}/assets/images/product-img/1.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1" src="{{ asset('public/frontend') }}/assets/images/product-img/2.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1" src="{{ asset('public/frontend') }}/assets/images/product-img/3.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
                <div class="col-md-3 col-sm-6 product-column" data-category="category3">
                    <div class="product-box">
                        <div class="product-image2">
                            <div class="discount-box float-end">
                                <span>50%</span>
                            </div>
                            <a href="product_description.html">
                                <img class="pic-1" src="{{ asset('public/frontend') }}/assets/images/product-img/4.jpg">
                                <img class="pic-2"
                                    src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="product_description.html" data-tip="Quick View"><i
                                            class="fa fa-eye"></i></a></li>
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
    </section>
@endsection
@push('scripts')
    <script>
        function incrementValue() {
            const quantityInput = document.getElementById('quantity');
            let value = parseInt(quantityInput.value);
            quantityInput.value = value + 1;
        }

        function decrementValue() {
            const quantityInput = document.getElementById('quantity');
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        }
        //Product description collapse
        $(document).ready(function() {
            $('.collapse').on('show.bs.collapse', function() {
                $(this).prev('.card-header').find('.toggle-icon').html('<i class="fa fa-minus"></i>');
            });

            $('.collapse').on('hide.bs.collapse', function() {
                $(this).prev('.card-header').find('.toggle-icon').html('<i class="fa fa-plus"></i>');
            });
        });
    </script>
@endpush
