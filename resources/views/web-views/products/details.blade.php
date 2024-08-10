@extends('layouts.front-end.app')

@section('title', $product['name'])

@push('css_or_js')
    <meta name="description" content="{{ $product->slug }}">
    <meta name="keywords" content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
    @if ($product->added_by == 'seller')
        <meta name="author" content="{{ $product->seller->shop ? $product->seller->shop->name : $product->seller->f_name }}">
    @elseif($product->added_by == 'admin')
        <meta name="author" content="{{ $web_config['name']->value }}">
    @endif
    <!-- Viewport-->

    @if ($product['meta_image'] != null)
        <meta property="og:image" content="{{ asset('storage/app/public/product/meta') }}/{{ $product->meta_image }}" />
        <meta property="twitter:card" content="{{ asset('storage/app/public/product/meta') }}/{{ $product->meta_image }}" />
    @else
        <meta property="og:image" content="{{ asset('storage/app/public/product/thumbnail') }}/{{ $product->thumbnail }}" />
        <meta property="twitter:card"
            content="{{ asset('storage/app/public/product/thumbnail/') }}/{{ $product->thumbnail }}" />
    @endif

    @if ($product['meta_title'] != null)
        <meta property="og:title" content="{{ $product->meta_title }}" />
        <meta property="twitter:title" content="{{ $product->meta_title }}" />
    @else
        <meta property="og:title" content="{{ $product->name }}" />
        <meta property="twitter:title" content="{{ $product->name }}" />
    @endif
    <meta property="og:url" content="{{ route('product', [$product->slug]) }}">

    @if ($product['meta_description'] != null)
        <meta property="twitter:description" content="{!! $product['meta_description'] !!}">
        <meta property="og:description" content="{!! $product['meta_description'] !!}">
    @else
        <meta property="og:description"
            content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
        <meta property="twitter:description"
            content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
    @endif
    <meta property="twitter:url" content="{{ route('product', [$product->slug]) }}">

    <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/product-details.css') }}" />

@endpush

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

        .quantity-wise-price {
            color: #f26d21;
            font-size: 15px;
            font-weight: 600;
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
                                <form id="form-{{ $product->id }}" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">

                                    @if (count(json_decode($product->colors)) > 0)
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>Color</h4>
                                            </div>
                                            @foreach (json_decode($product->colors) as $key => $color)
                                                <div class="col-md-3">
                                                    <div class="v-color-box">
                                                        <input type="radio"
                                                            id="{{ $product->id }}-color-{{ $key }}" checked
                                                            name="color" value="{{ $color }}"
                                                            @if ($key == 0) checked @endif>
                                                        <label style="background: {{ $color }}"
                                                            for="{{ $product->id }}-color-{{ $key }}"
                                                            class="color-label"></label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @php
                                        $qty = 0;
                                        if (!empty($product)) {
                                            foreach (json_decode($product->variation) as $key => $variation) {
                                                $qty += $variation->qty;
                                            }
                                        }
                                    @endphp
                                    @foreach (json_decode($product->choice_options) as $key => $choice)
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 style="font-size: 18px; margin:0;">{{ $choice->title }}</h4>
                                            </div>
                                            @foreach ($choice->options as $key => $option)
                                                <div class="col-md-4">
                                                    <div class="v-size-box">
                                                        <input type="radio"
                                                            id="{{ $choice->name }}-{{ $option }}" checked
                                                            name="{{ $choice->name }}" value="{{ $option }}"
                                                            @if ($key == 0) checked @endif>
                                                        <label for="{{ $choice->name }}-{{ $option }}"
                                                            class="size-label">{{ $option }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                    <div class="row mb-3">
                                        <div class="col-md-4 mb-2">
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
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between mt-2" id="chosen_price_div">
                                                <div class="product-description-label"
                                                    style="font-size: 17PX; line-height: 2rem">{{ __('Total Price') }}:
                                                    <strong
                                                        id="chosen_price">{{ \App\CPU\Helpers::get_price_range($product) }}</strong>
                                                </div>
                                                <span class="instock">Instock: 5</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <a onclick="buy_now('form-{{ $product->id }}')" href="javascript:void(0);"
                                                class="w-100 common-btn">Order Now</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-dark btn-block"
                                                onclick="addToCart('form-{{ $product->id }}')">Add to
                                                Cart</button>
                                        </div>
                                        <button type="button" onclick="addWishlist('{{ $product['id'] }}')"
                                            class="btn for-hover-bg p-wishlist" style="">
                                            <i class="fa fa-heart-o mr-2" aria-hidden="true"></i>
                                            <span class="countWishlist-{{ $product['id'] }}">{{ $countWishlist }}</span>
                                        </button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="accordion mb-3" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between align-items-center"
                                                    id="productDescription">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                            data-toggle="collapse" data-target="#description"
                                                            aria-expanded="true" aria-controls="description">
                                                            Description
                                                        </button>
                                                    </h5>
                                                    <span class="toggle-icon" data-toggle="collapse"
                                                        data-target="#description" aria-expanded="true"
                                                        aria-controls="description"><i class="fa fa-plus"></i></span>
                                                </div>

                                                <div id="description" class="collapse"
                                                    aria-labelledby="productDescription" data-parent="#accordionExample">
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
                @if (count($relatedProducts) > 0)
                    @foreach ($relatedProducts as $key => $product)
                        <div class="col-md-3 col-sm-6 product-column" data-category="category3">
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
                                            <li><a href="{{ route('product', $product->slug) }}" data-tip="Quick View"><i
                                                        class="fa fa-eye"></i></a></li>
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
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-danger text-center">{{ trans('messages.similar') }}
                                    {{ trans('messages.product_not_available') }}</h6>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
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
    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        $('#add-to-cart-form input').on('change', function() {
            getVariantPrice();
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }
    </script>

    {{-- Messaging with shop seller --}}
    <script>
        $('#contact-seller').on('click', function(e) {
            // $('#seller_details').css('height', '200px');
            $('#seller_details').animate({
                'height': '276px'
            });
            $('#msg-option').css('display', 'block');
        });
        $('#sendBtn').on('click', function(e) {
            e.preventDefault();
            let msgValue = $('#msg-option').find('textarea').val();
            let data = {
                message: msgValue,
                shop_id: $('#msg-option').find('textarea').attr('shop-id'),
                seller_id: $('.msg-option').find('.seller_id').attr('seller-id'),
            }
            if (msgValue != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: '{{ route('messages_store') }}',
                    data: data,
                    success: function(respons) {
                        console.log('send successfully');
                    }
                });
                $('#chatInputBox').val('');
                $('#msg-option').css('display', 'none');
                $('#contact-seller').find('.contact').attr('disabled', '');
                $('#seller_details').animate({
                    'height': '125px'
                });
                $('#go_to_chatbox').css('display', 'block');
            } else {
                console.log('say something');
            }
        });
        $('#cancelBtn').on('click', function(e) {
            e.preventDefault();
            $('#seller_details').animate({
                'height': '114px'
            });
            $('#msg-option').css('display', 'none');
        });
    </script>

    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
        async="async"></script>
@endpush
