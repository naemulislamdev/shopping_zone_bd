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
                <li><a href="{{ route('product', $product->slug) }}"
                        data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
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
