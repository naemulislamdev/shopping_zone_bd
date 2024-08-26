@extends('layouts.front-end.app')
@section('title', 'Campain products')
@push('css_or_js')
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="og:title" content="Products of {{ $web_config['name'] }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

    <meta property="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="twitter:title" content="Products of {{ $web_config['name'] }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">
    <style>
        .countdown {
        display: flex;
        gap: 15px;
      }

      .time {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 2rem;
      }

      .label {
        font-size: 1rem;
        margin-top: 5px;
      }
    </style>
@endpush
@section('content')
    <section class="py-3">
        <div class="container">
            {{-- Product Filter section --}}
            @include('layouts.front-end.partials.product_filter')
            {{-- Product grid system section --}}
            <div class="row mb-3">
                <div class="col text-center">
                    <div class="section-heading-title">
                        <h3>Campaing Products</h3>
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

            @if (count($products) > 0)
                <div class="row product-grid" id="ajax-products">
                    @foreach ($products as $product)
                    @php
                        $startDay = \Carbon\Carbon::parse($product->end_day)->format('Y-m-d H:i:s');
                    @endphp
                        <div class="col-md-3 col-sm-6 product-column" data-category="category">
                            <div class="product-box">
                                <div class="product-image2">
                                    @php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))
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
                                            <li><a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#addToCartModal_{{ $product->id }}"
                                                    data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                        <a class="buy-now" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#addToCartModal_{{ $product->id }}">Buy Now</a>
                                    </form>
                                </div>
                                <div class="countdown" data-product-id="{{ $product->id }}">
                                    <div class="time">
                                        <span id="days-{{ $product->id }}">00</span>
                                        <div class="label">Days</div>
                                    </div>
                                    <div class="time">
                                        <span id="hours-{{ $product->id }}">00</span>
                                        <div class="label">Hours</div>
                                    </div>
                                    <div class="time">
                                        <span id="minutes-{{ $product->id }}">00</span>
                                        <div class="label">Minutes</div>
                                    </div>
                                    <div class="time">
                                        <span id="seconds-{{ $product->id }}">00</span>
                                        <div class="label">Seconds</div>
                                    </div>
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
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            @foreach (json_decode($product->colors) as $key => $color)
                                                                <div class="v-color-box">
                                                                    <input type="radio"
                                                                        id="{{ $product->id }}-color-{{ $key }}"
                                                                        name="color" value="{{ $color }}"
                                                                        @if ($key == 0) checked @endif>
                                                                    <label style="background: {{ $color }}"
                                                                        for="{{ $product->id }}-color-{{ $key }}"
                                                                        class="color-label"></label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (count(json_decode($product->choice_options)) > 0)
                                                @foreach (json_decode($product->choice_options) as $key => $choice)
                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <h4 style="font-size: 18px; margin:0;">{{ $choice->title }}
                                                            </h4>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="d-flex">
                                                                @foreach ($choice->options as $key => $option)
                                                                    <div class="v-size-box">
                                                                        <input type="radio"
                                                                            id="{{ $product->id }}-size-{{ $key }}"
                                                                            name="{{ $choice->name }}"
                                                                            value="{{ $option }}"
                                                                            @if ($key == 0) checked @endif>
                                                                        <label
                                                                            for="{{ $product->id }}-size-{{ $key }}"
                                                                            class="size-label">{{ $option }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                <div class="col-md-10 mx-auto">
                                                    <div class="product-quantity d-flex align-items-center">
                                                        <div class="input-group input-group--style-2 pr-3"
                                                            style="width: 160px;">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-number" type="button"
                                                                    data-type="minus" data-field="quantity"
                                                                    disabled="disabled" style="padding: 10px">
                                                                    -
                                                                </button>
                                                            </span>
                                                            <input type="text" name="quantity"
                                                                class="form-control input-number text-center cart-qty-field"
                                                                placeholder="1" value="1" min="1"
                                                                max="100">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-number" type="button"
                                                                    data-type="plus" data-field="quantity"
                                                                    style="padding: 10px">
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
            @else
                <div class="text-center pt-5">
                    <h2>Product Coming Soon!</h2>
                </div>
            @endif

            {{-- <div class="row my-3">
                <div class="col-md-12">
                    <div class="big-banner">
                        <img src="{{ asset('public/asstes/front-end') }}/images/product-banner/main-banner3.jpg"
                            alt="">
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        //When scroll display block in filter section other wise display none
        window.addEventListener('scroll', function() {
            const header = document.getElementById('filter-box');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    <script>
        cartQuantityInitialize();
    </script>
    <script>
        $(document).ready(function () {
    // Iterate through each countdown element
    $('.countdown').each(function() {
        var $this = $(this);
        var productId = $this.data('product-id');
        var endDate = new Date("{{ \Carbon\Carbon::parse($product->end_day)->format('Y-m-d H:i:s') }}").getTime();

        // Update the countdown every 1 second
        var x = setInterval(function () {
            // Get current date and time
            var now = new Date().getTime();

            // Find the distance between now and the end date
            var distance = endDate - now;

            // Time calculations for days, hours, minutes, and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the corresponding elements
            $("#days-" + productId).text(days);
            $("#hours-" + productId).text(hours);
            $("#minutes-" + productId).text(minutes);
            $("#seconds-" + productId).text(seconds);

            // If the countdown is finished, display expired text
            if (distance < 0) {
                clearInterval(x);
                $this.html("EXPIRED");
            }
        }, 1000);
    });
});

      </script>
@endpush
