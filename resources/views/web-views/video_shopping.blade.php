@extends('layouts.front-end.app')
@section('title', ' products')
@push('css_or_js')
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="og:title" content="Products of {{ $web_config['name'] }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

    <meta property="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="twitter:title" content="Products of {{ $web_config['name'] }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">
@endpush
@section('content')
    <style>
        .menu-area>ul>li>a {
            color: #1a1919;
        }

        .header-icon>a>.fa {
            color: #1a1919;
        }
    </style>
    <section class="py-3">
        <div class="container">
            {{-- Product Filter section --}}
            @include('layouts.front-end.partials.product_filter')
            {{-- Product grid system section --}}
            <div class="row mb-3">
                <div class="col text-center">
                    <div class="section-heading-title">
                        <h3>{{ $categoryName }}</h3>
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

            @if (count($allProducts) > 0)
                <div class="row product-grid" id="ajax-products">
                    <!-- Your product columns go here -->
                    @include('web-views.products._ajax-products', ['products' => $allProducts])
                </div>
            @else
                <div class="text-center pt-5">
                    <h2>Product Coming Soon!</h2>
                </div>
            @endif

            <div class="row my-3">
                <div class="col-md-12">
                    <div class="big-banner">
                        <img src="{{ asset('public/asstes/front-end') }}/images/product-banner/main-banner3.jpg"
                            alt="">
                    </div>
                </div>
            </div>
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
@endpush
