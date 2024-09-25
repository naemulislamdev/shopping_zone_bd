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
    <style>
        /* Custom CSS */
        .product-image {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .video-section,
        .benefit-section,
        .use-section {
            margin-top: 40px;
        }

        .benefit-list li {
            list-style: none;
            border-bottom: 1px solid #ddd;
            line-height: 34px;
        }

        .benefit-list li i {
            color: #0bc508;
            margin-right: 10px;
        }

        .order-btn {
            background: #f26d21;
            display: block;
            padding: 15px 20px;
            border-radius: 7px;
            color: #fff;
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            transition: 0.3s;
        }

        .order-btn:hover {
            background: #ac4103;
            color: #fff;
            text-decoration: none;
        }

        .slider-img {
            height: 400px;
        }

        .slider-img>img {
            width: 100%;
            height: 100%;
        }

        .section-title {
            background: #f26d21;
            padding: 7px 7px;
            border-radius: 7px;
            margin-bottom: 10px;
        }

        .section-title>h4 {
            color: #fff;
            font-size: 30px;
        }

        .name-price {
            background: #ddd;
            padding: 11px 13px;
            border-radius: 7px;
        }

        .name-price>.title-box {
            border-bottom: 2px solid #fff;
        }

        .p-data-box>p {
            font-weight: 500;
        }

        .p-data-box>img {
            width: 200px;
        }
    </style>
@endpush
@section('content')
    <!-- Header Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="lt-slider">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach (json_decode($productLandingPage->slider_img) as $key => $image)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach (json_decode($productLandingPage->slider_img) as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="slider-img">
                                            <img class="d-block w-100"
                                                onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                src="{{ asset('storage/app/public/landingpage/slider') }}/{{ $image }}"
                                                alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Offer Section -->
    <section class="offer-section">
        <div class="container">
            <h1 class="mb-2">{{ $productLandingPage->product->name }}</h1>
            <div class="p-short-details">
                <p>{!! $productLandingPage->description !!}</p>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <div class="container video-section">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="928" height="522" src="{{ $productLandingPage->video_url }}" title="Western tops"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefit Section -->
    <section class="benefit-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h4 class="text-center">এই পণ্যের বৈশিষ্ট্য</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6">
                            <ul class="benefit-list">
                                @foreach (json_decode($productLandingPage->feature_list) as $title)
                                    <li><i class="fa fa-check-square-o"></i>{{ $title }}</li>
                                @endforeach
                            </ul>
                            <a href="#orderPlace" class="w-100 order-btn">অর্ডার করতে চাই</a>
                        </div>
                        <div class="col-md-6">
                            <div class="benefit-img">
                                <img src="{{ asset('storage/app/public/landingpage/' . $productLandingPage->feature_img) }}"
                                    style="width: 100%; height:400px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Multiple section --}}
    @if ($productLandingPage->landingPageSection)
        @foreach ($productLandingPage->landingPageSection as $key => $section)
            <section class="benefit-section my-4">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section-title">
                                <h4 class="text-center">{{ $section->section_title }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="row align-items-center justify-content-center">
                                @if ($section->section_direction == 'left')
                                    <div class="col-md-6">
                                        <div class="section-dtls">
                                            <p>{{ $section->section_description }}</p>
                                        </div>
                                        @if ($section->order_button == 1)
                                            <a href="#orderPlace" class="w-100 order-btn">অর্ডার করতে চাই</a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="benefit-img">
                                            <img onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                src="{{ asset('storage/app/public/landingpage/' . $section->section_img) }}"
                                                style="width: 100%; height:400px;" alt="">
                                        </div>
                                    </div>
                                @elseif ($section->section_direction == 'right')
                                    <div class="col-md-6">
                                        <div class="benefit-img">
                                            <img onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                src="{{ asset('storage/app/public/landingpage/' . $section->section_img) }}"
                                                style="width: 100%; height:400px;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="section-dtls">
                                            <p>{{ $section->section_description }}</p>
                                        </div>
                                        @if ($section->order_button == 1)
                                            <a href="#orderPlace" class="w-100 order-btn">অর্ডার করতে চাই</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    <!-- Form Section -->
    <section id="orderPlace my-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title">
                                        <h4 class="text-center">অর্ডার করতে নিচের ফর্মটি সঠিক ভাবে পুরন করুন</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('customer.product.checkout.order') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-danger">Choose Shipping Method</label>
                                        <select class="form-control" id="shipping_method_id"
                                            onchange="set_shipping_id(this.value)" name="shipping_method_id">
                                            <option selected disabled>Select Shipping Method</option>
                                            @foreach (\App\Model\ShippingMethod::where(['status' => 1])->get() as $shipping)
                                                <option value="{{ $shipping['id'] }}"
                                                    {{ session()->has('shipping_method_id') ? (session('shipping_method_id') == $shipping['id'] ? 'selected' : '') : '' }}>
                                                    {{ $shipping['title'] . ' ( ' . $shipping['duration'] . ' ) ' . \App\CPU\Helpers::currency_converter($shipping['cost']) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Choose Payment Method</label>
                                            <select class="form-control" name="payment_method">
                                                <option value="cash_on_delivery">Cash on delevery</option>
                                                <option value="online_payment">online payment</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter your name"
                                                name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter your phone"
                                                name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Email </label>
                                            <input type="email" class="form-control" placeholder="Enter your email"
                                                name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Shipping Address <span class="text-danger">*</span></label>
                                            <textarea class="form-control" placeholder="Enter your shipping address" name="address">{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Note </label>
                                            <textarea class="form-control" placeholder="Enter your Note" name="order_note">{{ old('order_note') }}</textarea>
                                            @error('order_note')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <h4 class="">Your Product</h4>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="name-price">
                                        <div class="title-box d-flex justify-content-between">
                                            <h4>Product</h4>
                                            <h4>Price</h4>
                                        </div>
                                        <div class="p-data-box d-flex justify-content-between">
                                            <p>{{ $productLandingPage->product->name }} <i class="fa fa-close"></i> 1</p>
                                            <p>{{ \App\CPU\Helpers::currency_converter($productLandingPage->product->unit_price) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <h4 class="">Your order</h4>
                                </div>
                            </div>

                            @php($sub_total = 0)
                            @php($total_tax = 0)
                            @php($total_shipping_cost = 0)
                            @php($total_discount_on_product = 0)
                            @if (session()->has('cart') && count(session()->get('cart')) > 0)
                            {{-- @dd(session('cart')) --}}
                                @foreach (session('cart') as $key => $cartItem)
                                    @php($sub_total += $cartItem['price'] * $cartItem['quantity'] - $cartItem['quantity'] * $cartItem['discount'])
                                    @php($total_tax += $cartItem['tax'] * $cartItem['quantity'])
                                    @php($total_shipping_cost += $cartItem['shipping_cost'])
                                    @php($total_discount_on_product += $cartItem['discount'] * $cartItem['quantity'])
                                @endforeach
                            @endif
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="name-price">
                                        <div class="title-box d-flex justify-content-between">
                                            <h4>Product</h4>
                                        </div>
                                        <div class="p-data-box d-flex justify-content-between">
                                            <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $productLandingPage->product->thumbnail }}"
                                                alt="">
                                            <div>
                                                <table class="mt-4">
                                                    <tr>
                                                        <td>Subtotal :</td>
                                                        <td>{{ \App\CPU\Helpers::currency_converter($sub_total) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping :</td>
                                                        <td>{{ \App\CPU\Helpers::currency_converter($total_shipping_cost) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total:</td>
                                                        <td>{{ \App\CPU\Helpers::currency_converter($sub_total + $total_tax + $total_shipping_cost) }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
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
        function set_shipping_id(id) {
            @foreach (session()->get('cart') as $key => $item)
                let key = '{{ $key }}';
                @break
            @endforeach
            $.get({
                url: '{{ url('/') }}/customer/set-shipping-method',
                dataType: 'json',
                data: {
                    id: id,
                    key: key
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    console.log(data);

                    if (data.status == 1) {
                        toastr.success('Shipping method selected', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setInterval(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Choose proper shipping method.', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }
    </script>
@endpush
