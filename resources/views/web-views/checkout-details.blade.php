@extends('layouts.front-end.app')
@section('title', 'Checkout')
@section('content')
    <style>
        .card-header {
            padding: 6px 0px;
            margin-bottom: 0;
            border-bottom: 0px solid rgba(0, 0, 0, .125);
            background: #f26d21;
            color: #fff;
            text-align: center;
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
    </style>
    <div class="page-content m-5">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="row">
                            <div class="col-lg-8">
                                <table class="table table-cart table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (session()->has('cart') && count(session()->get('cart')) > 0)
                                            @foreach (session()->get('cart') as $key => $cartItem)
                                                <tr>
                                                    <td class="product-col">
                                                        <div class="checkout-product">
                                                            <a href="{{ route('product', $cartItem['slug']) }}">
                                                                <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $cartItem['thumbnail'] }}"
                                                                    alt="Product image">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td><a
                                                            href="{{ route('product', $cartItem['slug']) }}">{{ Str::limit($cartItem['name'], 30) }}</a>
                                                    </td>
                                                    <td class="price-col">
                                                        {{ \App\CPU\Helpers::currency_converter($cartItem['price'] - $cartItem['discount']) }}
                                                    </td>
                                                    <td class="quantity-col">
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
                                                    </td>
                                                    <td class="total-col">
                                                        <div class="product-description-label" id="chosen_price_div">
                                                            <strong id="chosen_price"></strong>
                                                        </div>
                                                    </td>
                                                    <td class="remove-col"><a href="javascript:voide(0);"
                                                            onclick="removeFromCart({{ $key }})"
                                                            class="btn-remove"><i class="fa fa-trash-o"></i></a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <div class="empty-cart-box">
                                                <i class="fa fa-shopping-bag"></i>
                                                <h4>Your cart is empty.</h4>
                                                <a href="/" class="btn btn-dark">Return to shop</a>
                                            </div>
                                        @endif
                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Shipping Address</h4>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label>Name:</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter your name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label>Phone:</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter your phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-danger">Choose Shipping Method</label>
                                                    <select class="form-control" id="shipping_method_id"
                                                        onchange="set_shipping_id(this.value)">
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
                                                            <option value="cach on delevery">Cach on delevery</option>
                                                            <option>online payment</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label>Shipping Address:</label>
                                                        <textarea class="form-control" placeholder="Enter your shipping address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        </form>
                                    </div>
                                </div>

                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-4">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->
                                    <table class="table table-summary">

                                        <tbody>
                                            @php($sub_total = 0)
                                            @php($total_tax = 0)
                                            @php($total_shipping_cost = 0)
                                            @php($total_discount_on_product = 0)
                                            @if (session()->has('cart') && count(session()->get('cart')) > 0)
                                                @foreach (session('cart') as $key => $cartItem)

                                                    @php($sub_total += $cartItem['price'] * $cartItem['quantity'])
                                                    @php($total_tax += $cartItem['tax'] * $cartItem['quantity'])
                                                    @php($total_shipping_cost += $cartItem['shipping_cost'])
                                                    @php($total_discount_on_product += $cartItem['discount'] * $cartItem['quantity'])
                                                @endforeach
                                            @else
                                                <span>Empty Cart</span>
                                            @endif
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>{{ \App\CPU\Helpers::currency_converter($sub_total) }}</td>
                                            </tr><!-- End .summary-subtotal -->
                                            <tr class="summary-shipping">
                                                <td>Shipping:</td>
                                                <td>{{ \App\CPU\Helpers::currency_converter($total_shipping_cost) }}</td>
                                            </tr>
                                            @if (session()->has('coupon_discount'))
                                                <div class="d-flex justify-content-between">
                                                    <span class="cart_title">Coupon Discount</span>
                                                    <span class="cart_value" id="coupon-discount-amount">
                                                        -
                                                        {{ session()->has('coupon_discount') ? \App\CPU\Helpers::currency_converter(session('coupon_discount')) : 0 }}
                                                    </span>
                                                </div>
                                                @php($coupon_dis = session('coupon_discount'))
                                            @else
                                                <div class="mt-2">
                                                    <form class="needs-validation" method="post" novalidate
                                                        id="coupon-code-ajax">
                                                        <div class="form-group">
                                                            <input class="form-control input_code" type="text"
                                                                name="code" id="couponcod"
                                                                placeholder="Coupon code (Optional)" required>
                                                            <div class="invalid-feedback">Please provide coupon code.</div>
                                                        </div>
                                                        <button class="btn btn-primary btn-block" type="button"
                                                            onclick="couponCode()">Apply Code
                                                        </button>
                                                    </form>
                                                </div>
                                                @php($coupon_dis = 0)
                                            @endif

                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>{{ \App\CPU\Helpers::currency_converter($sub_total + $total_tax + $total_shipping_cost - $coupon_dis - $total_discount_on_product) }}
                                                </td>
                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </div>
                </div>
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
@endsection
@push('scripts')

    <script>
        cartQuantityInitialize();

        function set_shipping_id(id) {
            @foreach(session()->get('cart') as $key => $item)
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
