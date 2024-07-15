@extends('frontend.layouts.master')
@section('title', 'Checkout')
@section('content')
    <div class="page-content">
        <div class="cart">
            <div class="container">
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
                                <tr>
                                    <td class="product-col">
                                        <div class="checkout-product">
                                            <a href="#">
                                                <img src="{{ asset('public/frontend') }}/assets/images/product-img/3.jpg"
                                                    alt="Product image">
                                            </a>
                                        </div>
                                    </td>
                                    <td><a href="#">Beige knitted elastic runner shoes</a></td>
                                    <td class="price-col">$84.00</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity">
                                            <div class="input-group mt-1">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="decrementValue()">-</button>
                                                </div>
                                                <input type="text" id="quantity" class="form-control text-center w-10"
                                                    value="1" readonly min="1" max="100">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="incrementValue()">+</button>
                                                </div>
                                            </div>
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col">$84.00</td>
                                    <td class="remove-col"><a href="javascript:voide(0);" class="btn-remove"><i
                                                class="fa fa-trash-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table><!-- End .table table-wishlist -->


                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-4">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>$160.00</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>$70.00</td>
                                    </tr>

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>$160.00</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                                <div class="cart-coupon">
                                    <form action="#">
                                        <label>Have a Coupon code?</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" required placeholder="coupon code">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary-2" type="submit"><i
                                                        class="fa fa-arrow-right"></i></button>
                                            </div><!-- .End .input-group-append -->
                                        </div><!-- End .input-group -->
                                    </form>
                                </div><!-- End .cart-discount -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
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
    </script>
@endpush
