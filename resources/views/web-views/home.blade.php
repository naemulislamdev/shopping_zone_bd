@extends('layouts.front-end.app')
@section('title', \App\CPU\translate('Welcome To') . ' ' . $web_config['name']->value)

@push('css_or_js')
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="og:title" content="Best Online Marketplace In Bangladesh {{ $web_config['name']->value }} Home" />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

    <meta property="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="twitter:title" content="Welcome To {{ $web_config['name']->value }} Home" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">
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
                    <div class="homeCategories owl-carousel owl-theme">
                        @foreach ($categories as $category)
                            @php
                                $productCount = $productCounts[$category->id] ?? 0;
                            @endphp
                            <div class="item">
                                <div class="tp-category-item-3 p-relative text-center">
                                    <div class="tp-category-thumb-3">
                                        <img src="{{ asset("storage/app/public/category/$category->icon") }}"
                                            alt="">
                                    </div>
                                    <div class="tp-category-content-3">
                                        <h3 class="tp-category-title-3">
                                            <a
                                                href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $category['name'] }}</a>
                                        </h3>
                                        <span class="tp-categroy-ammount-3">{{ $productCount }} products</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------Start Product section----->
    <section class="py-3">
        <div class="container">
            @include('layouts.front-end.partials.product_filter')

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
                                <input type="hidden" name="quantity" value="{{ $product->minimum_order_qty ?? 1 }}"
                                    min="{{ $product->minimum_order_qty ?? 1 }}" max="100">
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

                                        <li><a style="cursor: pointer" data-toggle="modal"
                                                data-target="#addToCartModal_{{ $product->id }}"data-tip="Add to Cart"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        </li>
                                    </ul>
                                    <button type="button" style="cursor: pointer;" class="buy-now"
                                        onclick="buy_now('form-{{ $product->id }}')">Buy Now</button>
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
                        <!-- AddToCart Modal -->
                        <div class="modal fade" id="addToCartModal_{{ $product->id }}" tabindex="-1" role="dialog"
                            data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <form id="form-{{ $product->id }}" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="product-modal-box d-flex align-items-center mb-3">
                                                <div class="img mr-3">
                                                    <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
                                                        alt="" style="width: 80px;">
                                                </div>
                                                <div class="p-name">
                                                    <h5 class="title">{{ Str::limit($product['name'], 23) }}</h5>
                                                    <span
                                                        class="mr-2">{{ \App\CPU\Helpers::currency_converter(
                                                            $product->unit_price - \App\CPU\Helpers::get_product_discount($product, $product->unit_price),
                                                        ) }}</span>
                                                </div>
                                            </div>
                                            @if (count(json_decode($product->colors)) > 0)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4>Color</h4>
                                                    </div>
                                                    @foreach (json_decode($product->colors) as $key => $color)
                                                        <div class="col-md-3">
                                                            <div class="v-color-box">
                                                                <input type="radio"
                                                                    id="{{ $product->id }}-color-{{ $key }}"
                                                                    checked name="color" value="{{ $color }}"
                                                                    @if ($key == 0) checked @endif>
                                                                <label style="background: {{ $color }}"
                                                                    for="{{ $product->id }}-color-{{ $key }}"
                                                                    class="color-label"></label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if (count(json_decode($product->choice_options)) > 0)
                                                @foreach (json_decode($product->choice_options) as $key => $choice)
                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <h4 style="font-size: 18px; margin:0;">{{ $choice->title }}
                                                            </h4>
                                                        </div>
                                                        @foreach ($choice->options as $key => $option)
                                                            <div class="col-md-4">
                                                                <div class="v-size-box">
                                                                    <input type="radio"
                                                                        id="{{ $choice->name }}-{{ $option }}"
                                                                        checked name="{{ $choice->name }}"
                                                                        value="{{ $option }}"
                                                                        @if ($key == 0) checked @endif>
                                                                    <label for="{{ $choice->name }}-{{ $option }}"
                                                                        class="size-label">{{ $option }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                <div class="col-md-10 mx-auto">
                                                    <div class="product-quantity d-flex align-items-center">
                                                        <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-number" type="button" data-type="minus"
                                                                    data-field="quantity" disabled="disabled"
                                                                    style="padding: 10px">
                                                                    -
                                                                </button>
                                                            </span>
                                                            <input type="text" name="quantity"
                                                                class="form-control input-number text-center cart-qty-field"
                                                                placeholder="1" value="1" min="1" max="100">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-number" type="button" data-type="plus"
                                                                    data-field="quantity" style="padding: 10px">
                                                                    +
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('product', $product->slug) }}"
                                                class="btn btn-secondary">View Details</a>
                                            <button type="button" class="btn btn-danger"
                                                onclick="addToCart('form-{{ $product->id }}')">Add To Cart</button>
                                        </div>
                                    </div>
                                </form>
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
                            <button class="grid-btn grid-btn-mobile" data-columns="12"
                                data-category="category_{{ $category->id }}">
                                <div class="grid-icon"></div>
                            </button>
                            <button class="grid-btn grid-btn-mobile" data-columns="6"
                                data-category="category_{{ $category->id }}">
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
                                        <ul class="social">
                                            <li><a href="{{ route('product', $product->slug) }}" data-tip="Quick View"><i
                                                        class="fa fa-eye"></i></a></li>

                                            <li><a style="cursor: pointer" data-toggle="modal"
                                                    data-target="#addToCartModal_{{ $product->id }}"data-tip="Add to Cart"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                        <button type="button" style="cursor: pointer;" class="buy-now"
                                            onclick="buy_now('form-{{ $product->id }}')">Buy Now</button>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="{{ route('product', $product->slug) }}">{{ Str::limit($product['name'], 23) }}</a>
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
                            <!-- AddToCart Modal -->
                        <div class="modal fade" id="addToCartModal_{{ $product->id }}" tabindex="-1" role="dialog"
                            data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <form id="form-{{ $product->id }}" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="product-modal-box d-flex align-items-center mb-3">
                                                <div class="img mr-3">
                                                    <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
                                                        alt="" style="width: 80px;">
                                                </div>
                                                <div class="p-name">
                                                    <h5 class="title">{{ Str::limit($product['name'], 23) }}</h5>
                                                    <span
                                                        class="mr-2">{{ \App\CPU\Helpers::currency_converter(
                                                            $product->unit_price - \App\CPU\Helpers::get_product_discount($product, $product->unit_price),
                                                        ) }}</span>
                                                </div>
                                            </div>
                                            @if (count(json_decode($product->colors)) > 0)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4>Color</h4>
                                                    </div>
                                                    @foreach (json_decode($product->colors) as $key => $color)
                                                        <div class="col-md-3">
                                                            <div class="v-color-box">
                                                                <input type="radio"
                                                                    id="{{ $product->id }}-color-{{ $key }}"
                                                                    checked name="color" value="{{ $color }}"
                                                                    @if ($key == 0) checked @endif>
                                                                <label style="background: {{ $color }}"
                                                                    for="{{ $product->id }}-color-{{ $key }}"
                                                                    class="color-label"></label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if (count(json_decode($product->choice_options)) > 0)
                                                @foreach (json_decode($product->choice_options) as $key => $choice)
                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <h4 style="font-size: 18px; margin:0;">{{ $choice->title }}
                                                            </h4>
                                                        </div>
                                                        @foreach ($choice->options as $key => $option)
                                                            <div class="col-md-4">
                                                                <div class="v-size-box">
                                                                    <input type="radio"
                                                                        id="{{ $choice->name }}-{{ $option }}"
                                                                        checked name="{{ $choice->name }}"
                                                                        value="{{ $option }}"
                                                                        @if ($key == 0) checked @endif>
                                                                    <label for="{{ $choice->name }}-{{ $option }}"
                                                                        class="size-label">{{ $option }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                <div class="col-md-10 mx-auto">
                                                    <div class="product-quantity d-flex align-items-center">
                                                        <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-number" type="button" data-type="minus"
                                                                    data-field="quantity" disabled="disabled"
                                                                    style="padding: 10px">
                                                                    -
                                                                </button>
                                                            </span>
                                                            <input type="text" name="quantity"
                                                                class="form-control input-number text-center cart-qty-field"
                                                                placeholder="1" value="1" min="1" max="100">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-number" type="button" data-type="plus"
                                                                    data-field="quantity" style="padding: 10px">
                                                                    +
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('product', $product->slug) }}"
                                                class="btn btn-secondary">View Details</a>
                                            <button type="button" class="btn btn-danger"
                                                onclick="addToCart('form-{{ $product->id }}')">Add To Cart</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
            @foreach(\App\Model\Banner::where('banner_type','Footer Banner')->where('published',1)->orderBy('id','desc')->take(3)->get() as $banner)
            <div class="row my-3">
                <div class="col-md-12">
                    <div class="big-banner">
                        <a href="{{$banner['url']}}">
                        <img onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
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
                                <img src="{{ asset('public/assets/front-end') }}/images/slider/customer-review/img1.jpg"
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
                                <img src="{{ asset('public/assets/front-end') }}/images/slider/customer-review/img1.jpg"
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
                                <img src="{{ asset('public/assets/front-end') }}/images/slider/customer-review/img1.jpg"
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
                                <img src="{{ asset('public/assets/front-end') }}/images/slider/customer-review/img1.jpg"
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
@push('scripts')
<script>
    cartQuantityInitialize();
</script>
@endpush
