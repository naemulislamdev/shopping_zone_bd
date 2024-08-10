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
            {{$sub_total}}
            <td>{{ \App\CPU\Helpers::currency_converter($sub_total) }}</td>
        </tr>
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
                <form class="needs-validation" method="post" novalidate id="coupon-code-ajax">
                    <div class="form-group">
                        <input class="form-control input_code" type="text" name="code" id="couponcod"
                            placeholder="Coupon code (Optional)" required>
                        <div class="invalid-feedback">Please provide coupon code.</div>
                    </div>
                    <button class="btn btn-primary btn-block" type="button" onclick="couponCode()">Apply Code
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
