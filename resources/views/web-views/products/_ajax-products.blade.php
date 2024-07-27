@foreach($products as $product)
    @if(!empty($product['product_id']))
        @php($product=$product->product)
    @endif
    <div class="col-md-3 col-sm-6 product-column" data-category="category">
        @if(!empty($product))
            @include('web-views.partials._category_product',['p'=>$product])
        @endif
        <hr class="d-sm-none">
    </div>
@endforeach
