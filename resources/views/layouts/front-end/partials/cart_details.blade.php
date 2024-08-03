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
                                            <select name="quantity[{{ $key }}]"
                                                id="cartQuantity{{ $key }}"
                                                onchange="updateCartQuantity('{{ $key }}')">
                                                @for ($i = 1; $i <= 100; $i++)
                                                    <option value="{{ $i }}" <?php if ($cartItem['quantity'] == $i) {
                                                        echo 'selected';
                                                    } ?>>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </td>
                                    <td class="total-col">
                                        {{ \App\CPU\Helpers::currency_converter(($cartItem['price'] - $cartItem['discount']) * $cartItem['quantity']) }}
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
                    @include('web-views.partials._order-summary')
                </div>
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div>
</div>


<script>
    cartQuantityInitialize();

    function set_shipping_id(id) {
        @foreach(session()->get('cart') as $key => $item)
        let key = '{{$key}}';
        @break
        @endforeach
        $.get({
            url: '{{url('/')}}/customer/set-shipping-method',
            dataType: 'json',
            data: {
                id: id,
                key: key
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                if (data.status == 1) {
                    toastr.success('Shipping method selected', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setInterval(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error('Choose proper shipping method.', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
