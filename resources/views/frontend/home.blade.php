@extends('frontend.layouts.master')
@section('title',\App\CPU\translate('Welcome To').' '.$web_config['name']->value)

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Best Online Marketplace In Bangladesh {{$web_config['name']->value}} Home"/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

@endpush
@section('content')
    {{-- <div class="overlay"></div>
<div class="popup">
    <div class="popup-header">
        <div>Announcement</div>
        <div class="popup-close">&times;</div>
    </div>
    <div class="popup-body">
        <img src="{{ asset('public/frontend/assets/images/product-banner/popup-image.jpg')}}" class="img-fluid" alt="Banner Image">
    </div>
</div> --}}
    <!------start  header main slider-->
    @include('frontend.layouts.include.slider')
    <section class="category-section my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="category-title-box">
                                <div class="category-title">
                                    <h5>Product Collection</h5>
                                    <h1>Discover our products</h1>
                                </div>
                                <div class="tp-right-btn">
                                    <a href="#">Shop all products <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories owl-carousel owl-theme">
                        <div class="item">
                            <div class="tp-category-item-3 p-relative grey-bg text-center z-index-1 fix mb-30">
                                <div class="tp-category-thumb-3 include-bg"
                                    style="background-image: url('{{ asset('public/frontend') }}/assets/images/category/cate-img1.jpg');">
                                </div>
                                <div class="tp-category-content-3">
                                    <h3 class="tp-category-title-3">
                                        <a href="#">Discover Skincare</a>
                                    </h3>
                                    <span class="tp-categroy-ammount-3">8 products</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tp-category-item-3 p-relative grey-bg text-center z-index-1 fix mb-30">
                                <div class="tp-category-thumb-3 include-bg"
                                    style="background-image: url('{{ asset('public/frontend') }}/assets/images/category/cate-img2.jpg');">
                                </div>
                                <div class="tp-category-content-3">
                                    <h3 class="tp-category-title-3">
                                        <a href="#">Running Shoes</a>
                                    </h3>
                                    <span class="tp-categroy-ammount-3">8 products</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tp-category-item-3 p-relative grey-bg text-center z-index-1 fix mb-30">
                                <div class="tp-category-thumb-3 include-bg"
                                    style="background-image: url('{{ asset('public/frontend') }}/assets/images/category/cate-img3.jpg');">
                                </div>
                                <div class="tp-category-content-3">
                                    <h3 class="tp-category-title-3">
                                        <a href="#">Clothing</a>
                                    </h3>
                                    <span class="tp-categroy-ammount-3">8 products</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tp-category-item-3 p-relative grey-bg text-center z-index-1 fix mb-30">
                                <div class="tp-category-thumb-3 include-bg"
                                    style="background-image: url('{{ asset('public/frontend') }}/assets/images/category/cate-img4.jpg');">
                                </div>
                                <div class="tp-category-content-3">
                                    <h3 class="tp-category-title-3">
                                        <a href="#">Women's Clothing</a>
                                    </h3>
                                    <span class="tp-categroy-ammount-3">8 products</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tp-category-item-3 p-relative grey-bg text-center z-index-1 fix mb-30">
                                <div class="tp-category-thumb-3 include-bg"
                                    style="background-image: url('{{ asset('public/frontend') }}/assets/images/category/cate-img2.jpg');">
                                </div>
                                <div class="tp-category-content-3">
                                    <h3 class="tp-category-title-3">
                                        <a href="#">Running Shoes</a>
                                    </h3>
                                    <span class="tp-categroy-ammount-3">8 products</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------Start Product section----->
    <section class="py-3">
        <div class="container">
            @include('frontend.layouts.include.product_filter')

            <div class="row mb-3">
                <div class="col text-center">
                    <div class="section-heading-title">
                        <h3>Our Latest Product</h3>
                        <div class="heading-border"></div>
                    </div>
                    <div class="grid-controls">
                        <button class="grid-btn" data-columns="6" data-category="category1">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn" data-columns="4" data-category="category1">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn" data-columns="3" data-category="category1">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn" data-columns="2" data-category="category1">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                    </div>
                    <div class="grid-controls mobile-grid-controls">
                        <button class="grid-btn grid-btn-mobile" data-columns="12" data-category="category1">
                            <div class="grid-icon"></div>
                        </button>
                        <button class="grid-btn grid-btn-mobile" data-columns="6" data-category="category1">
                            <div class="grid-icon"></div>
                            <div class="grid-icon"></div>
                        </button>
                    </div>
                </div>
            </div>
            @php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))
            @if ($featured_products->count() > 0)
                <div class="row product-grid">
                    <!-- Your product columns go here -->
                    @foreach ($featured_products as $product)
                        <div class="col-md-3 col-sm-6 product-column" data-category="category1">
                            <div class="product-box">
                                <form id="add-to-cart-form" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="{{ $product->minimum_order_qty ?? 1 }}" min="{{ $product->minimum_order_qty ?? 1 }}" max="100">
                                    <div class="product-image2">
                                        @if ($product->discount > 0)
                                            <div class="discount-box float-end">
                                                <span>
                                                    @if ($product->discount_type == 'percent')
                                                        {{ round($product->discount, $decimal_point_settings) }}%
                                                    @elseif($product->discount_type == 'flat')
                                                        {{ \App\CPU\Helpers::currency_converter($product->discount) }}
                                                    @endif
                                                </span>
                                            </div>
                                        @endif
                                        <a href="{{ route('product', $product->slug) }}">
                                            <img class="pic-1"
                                                src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}">
                                            <img class="pic-2"
                                                src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}">
                                        </a>

                                        <ul class="social">
                                            <li><a href="{{ route('product', $product->slug) }}" data-tip="Quick View"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li><a style="cursor: pointer" onclick="addToCart()" data-tip="Add to Cart"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                        <a class="buy-now" href="">Buy Now</a>

                                    </div>
                                </form>
                                <div class="product-content">
                                    <h3 class="title"><a
                                            href="{{ route('product', $product->slug) }}">{{ Str::limit($product['name'], 23) }}</a>
                                    </h3>
                                    <div class="price d-flex justify-content-center align-content-center">
                                        <span
                                            class="mr-2">{{ \App\CPU\Helpers::currency_converter(
                                                $product->unit_price - \App\CPU\Helpers::get_product_discount($product, $product->unit_price),
                                            ) }}</span>
                                        <del>{{ \App\CPU\Helpers::currency_converter($product->unit_price) }}</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="row my-3">
                <div class="col-md-12">
                    <div class="big-banner">
                        <img src="{{ asset('public/frontend') }}/assets/images/product-banner/main-banner2.jpg"
                            alt="">
                    </div>
                </div>
            </div>
            @foreach ($home_categories as $category)
                <div class="row mb-3">
                    <div class="col text-center">
                        <div class="section-heading-title">
                            <h3>{{ Str::limit($category['name'], 18) }}</h3>
                            <div class="heading-border"></div>
                        </div>
                        <div class="grid-controls">
                            <button class="grid-btn" data-columns="6" data-category="category_{{ $category->id }}">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn" data-columns="4" data-category="category_{{ $category->id }}">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn" data-columns="3" data-category="category_{{ $category->id }}">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn" data-columns="2" data-category="category_{{ $category->id }}">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                        </div>
                        <div class="grid-controls mobile-grid-controls">
                            <button class="grid-btn grid-btn-mobile" data-columns="12" data-category="category2">
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn grid-btn-mobile" data-columns="6" data-category="category2">
                                <div class="grid-icon"></div>
                                <div class="grid-icon"></div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    <!-- Your product columns go here -->
                    @foreach ($category['products'] as $key => $product)
                        @if ($key < 4)
                            <div class="col-md-3 col-sm-6 product-column" data-category="category_{{ $category->id }}">
                                <div class="product-box">
                                    <div class="product-image2">
                                        @if ($product->discount > 0)
                                            <div class="discount-box float-end">
                                                <span>
                                                    @if ($product->discount_type == 'percent')
                                                        {{ round($product->discount, $decimal_point_settings) }}%
                                                    @elseif($product->discount_type == 'flat')
                                                        {{ \App\CPU\Helpers::currency_converter($product->discount) }}
                                                    @endif
                                                </span>
                                            </div>
                                        @endif
                                        <a href="{{ route('product', $product->slug) }}">
                                            <img class="pic-1"
                                                src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}">
                                            <img class="pic-2"
                                                src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}">
                                        </a>
                                        <form id="add-to-cart-form" class="mb-2">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <ul class="social">
                                                <li><a href="{{ route('product', $product->slug) }}"
                                                        data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="#" onclick="addToCart()" data-tip="Add to Cart"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                </li>
                                            </ul>
                                            <a class="buy-now" href="">Buy Now</a>
                                        </form>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a
                                                href="{{ route('product', $product->slug) }}">{{ Str::limit($product['name'], 23) }}</a>
                                        </h3>
                                        <div class="price d-flex justify-content-center align-content-center">
                                            <span
                                                class="mr-2">{{ \App\CPU\Helpers::currency_converter(
                                                    $product->unit_price - \App\CPU\Helpers::get_product_discount($product, $product->unit_price),
                                                ) }}</span>
                                            <del>{{ \App\CPU\Helpers::currency_converter($product->unit_price) }}</del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
            <div class="row my-3">
                <div class="col-md-12">
                    <div class="big-banner">
                        <img src="{{ asset('public/frontend') }}/assets/images/product-banner/main-Banner.jpg"
                            alt="">
                    </div>
                </div>
            </div>
            {{-- <div class="row mb-3">
            <div class="col text-center">
                <div class="section-heading-title">
                    <h3>Accessory</h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img1.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/7.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/8.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/5.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/1.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/2.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/3.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
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
                        <a href="{{ route('product.details')}}">
                            <img class="pic-1"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/4.jpg">
                            <img class="pic-2"
                                src="{{ asset('public/frontend') }}/assets/images/product-img/img2.jpg">
                        </a>
                        <ul class="social">
                            <li><a href="{{ route('product.details')}}" data-tip="Quick View"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a class="add-to-cart" href="">Buy Now</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ route('product.details')}}">Women's Designer Top</a></h3>
                        <div class="price d-flex justify-content-center align-content-center">
                            <span class="mr-2">৳ 599.99</span>
                            <del>৳ 699.99</del>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
            <div class="row my-3">
                <div class="col-md-12">
                    <div class="big-banner">
                        <img src="{{ asset('public/frontend') }}/assets/images/product-banner/main-banner3.jpg"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start customer review Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row my-3">
                        <div class="col text-center">
                            <div class="section-heading-title">
                                <h5>Customers Review</h5>
                                <h3>What our Clients say</h3>
                                <div class="heading-border"></div>
                            </div>
                        </div>
                    </div>
                    <div class="c-review-slider owl-carousel owl-theme">
                        <div class="item">
                            <div class="customer-review-box text-center">
                                <img src="{{ asset('public/frontend') }}/assets/images/slider/customer-review/img1.jpg"
                                    alt="">
                                <div class="customer-name">
                                    <h3>Theodore Handle</h3>
                                    <span>CEO</span>
                                </div>
                                <div class="customer-sms">
                                    <p>How you use the city or town name is up to you. All results may be freely used in
                                        any work.</p>
                                </div>
                                <div class="customer-review">
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="customer-review-box text-center">
                                <img src="{{ asset('public/frontend') }}/assets/images/slider/customer-review/img1.jpg"
                                    alt="">
                                <div class="customer-name">
                                    <h3>Theodore Handle</h3>
                                    <span>CEO</span>
                                </div>
                                <div class="customer-sms">
                                    <p>How you use the city or town name is up to you. All results may be freely used in
                                        any work.</p>
                                </div>
                                <div class="customer-review">
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="customer-review-box text-center">
                                <img src="{{ asset('public/frontend') }}/assets/images/slider/customer-review/img1.jpg"
                                    alt="">
                                <div class="customer-name">
                                    <h3>Theodore Handle</h3>
                                    <span>CEO</span>
                                </div>
                                <div class="customer-sms">
                                    <p>How you use the city or town name is up to you. All results may be freely used in
                                        any work.</p>
                                </div>
                                <div class="customer-review">
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="customer-review-box text-center">
                                <img src="{{ asset('public/frontend') }}/assets/images/slider/customer-review/img1.jpg"
                                    alt="">
                                <div class="customer-name">
                                    <h3>Theodore Handle</h3>
                                    <span>CEO</span>
                                </div>
                                <div class="customer-sms">
                                    <p>How you use the city or town name is up to you. All results may be freely used in
                                        any work.</p>
                                </div>
                                <div class="customer-review">
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Newslater Section -->
    <section class="newslater-section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="newslater-text">
                                <h4>SALE 20% OFF ALL STORE</h4>
                                <h2>Subscribe our Newsletter</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="newslater-input">
                                <div class="input-group mb-3 w-100">
                                    <input type="text" class="form-control" placeholder="Enter email">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-dark" id="basic-addon2">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
