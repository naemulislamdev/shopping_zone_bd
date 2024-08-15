@extends('layouts.front-end.app')
@section('title', 'Shop')
@section('content')
    <section class="py-3">
        <div class="container">
            {{-- Product Filter section --}}
            @include('layouts.front-end.partials.product_filter')

            <div class="row mb-3">
                <div class="col text-center">
                    <div class="section-heading-title">
                        <h3>Selling Products</h3>
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
            @if (count($selling_products) > 0)
                <div class="row product-grid" id="ajax-products">
                    @foreach ($selling_products as $product)
                        @if ($product->discount > 0)
                            <div class="col-md-3 col-sm-6 product-column" data-category="category">
                                <div class="product-box product-box-col-3" data-category="category">
                                    <div class="product-image2 product-image2-col-3" data-category="category">
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
                                        <ul class="social">
                                            <li><a href="{{ route('product', $product->slug) }}" data-tip="Quick View"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li><a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#addToCartModal_{{ $product->id }}"
                                                    data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                        <a class="buy-now" href="javascript:void(0);"
                                            onclick="buy_now('form-{{ $product->id }}')">Buy Now</a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a
                                                href="{{ route('product', $product->slug) }}">{{ Str::limit($product['name'], 23) }}</a>
                                        </h3>
                                        <div class="price d-flex justify-content-center align-content-center">
                                            @if ($product->discount > 0)
                                                <span
                                                    class="mr-2">{{ \App\CPU\Helpers::currency_converter(
                                                        $product->unit_price - \App\CPU\Helpers::get_product_discount($product, $product->unit_price),
                                                    ) }}</span>
                                                <del>{{ \App\CPU\Helpers::currency_converter($product->unit_price) }}</del>
                                            @else
                                                <span>{{ \App\CPU\Helpers::currency_converter($product->unit_price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- AddToCart Modal -->
                        <div class="modal fade" id="addToCartModal_{{ $product->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form id="form-{{ $product->id }}" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                        <div class="col">
                                                            <div class="v-color-box">
                                                                <input type="radio"
                                                                    id="{{ $product->id }}-color-{{ $key }}"
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

                                            @if (count(json_decode($product->choice_options)) > 0)
                                                @foreach (json_decode($product->choice_options) as $key => $choice)
                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <h4 style="font-size: 18px; margin:0;">{{ $choice->title }}
                                                            </h4>
                                                        </div>
                                                        @foreach ($choice->options as $key => $option)
                                                            <div class="col">
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
                                                            </div>
                                                        @endforeach
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
                <hr class="my-3">
            @else
                <div class="text-center pt-5">
                    <h2>Product Coming Soon!</h2>
                </div>
            @endif

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
@endsection
@push('scripts')
    <script>
        function filter(value) {
            $.get({
                url: '{{ url('/') }}/products',
                data: {
                    sort_by: value
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    $('#ajax-products').html(response.view);
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function searchByPrice() {
            let min = $('#min_price').val();
            let max = $('#max_price').val();
            $.get({
                url: '{{ url('/') }}/products',
                data: {
                    min_price: min,
                    max_price: max,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    $('#ajax-products').html(response.view);
                    $('#paginator-ajax').html(response.paginator);
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        $("#search-brand").on("keyup", function() {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function() {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        $("#search-brand-m").on("keyup", function() {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function() {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
    </script>
    <script>
        cartQuantityInitialize();
    </script>
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
@endpush
