@extends('layouts.front-end.app')
@section('title', 'Shop')
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
            <div class="row">
                <div class="col-md-3">
                    <div class="shop-filter-box">
                        <!------shopping cart canva-->
                        <div class="" id="productFilter">
                            <div class="filter-header">
                                <h5 class="shop-filter-title">Filter the product you want</h5>
                            </div>
                            <div class="filter-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="wrapper">
                                            <h4 class="color-heading">Price</h4>
                                            <div class="price-input">
                                                <div class="field">
                                                    <span>Min</span>
                                                    <input type="number" class="input-min" value="2500" id="min_price">
                                                </div>
                                                <div class="separator">-</div>
                                                <div class="field">
                                                    <span>Max</span>
                                                    <input type="number" class="input-max" value="7500" id="max_price">
                                                </div>
                                            </div>
                                            <div class="slider">
                                                <div class="progress"></div>
                                            </div>
                                            <div class="range-input">
                                                <input type="range" class="range-min" min="0" max="10000"
                                                    value="2500" step="100">
                                                <input type="range" class="range-max" min="0" max="10000"
                                                    value="7500" step="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 mx-auto">
                                        <a href="javascript:void(0);" onclick="searchByPrice();" class="w-100 common-btn">Search</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="color-heading">Categories:</h4>
                                        <!--start Filter Category-->
                                        <div class="category-filter">
                                            @foreach(\App\CPU\CategoryManager::parents() as $category)
                                            <div class="category">
                                                <div class="category-header">
                                                    <a href="#">{{$category['name']}}</a>
                                                    <span class="toggle-icon" data-toggle="category_{{$category['id']}}">+</span>
                                                </div>
                                                <div class="sub-categories" id="category_{{$category['id']}}">
                                                    @foreach($category->childes as $child)
                                                    <div class="sub-category">
                                                        <div class="sub-category-header">
                                                            <a href="#">{{$child['name']}}</a>
                                                            <span class="toggle-icon" data-toggle="subCategory_{{$child['name']}}">+</span>
                                                        </div>
                                                        <div class="child-categories" id="subCategory_{{$child['name']}}">
                                                            @foreach($child->childes as $ch)
                                                            <a href="#">{{$ch['name']}}</a><br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <!--end category filter-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="color-selection mb-3">
                                            <h4 class="color-heading">Color:</h4>
                                            <div class="color-filter">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="color"
                                                        id="colorRed" value="red">
                                                    <label class="form-check-label" for="colorRed">
                                                        <span class="color-box" style="background-color: red;"></span> Red
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="color"
                                                        id="colorGreen" value="green">
                                                    <label class="form-check-label" for="colorGreen">
                                                        <span class="color-box" style="background-color: green;"></span>
                                                        Green
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="color"
                                                        id="colorBlue" value="blue">
                                                    <label class="form-check-label" for="colorBlue">
                                                        <span class="color-box" style="background-color: blue;"></span>
                                                        Blue
                                                    </label>
                                                </div>
                                                <!-- Add more colors as needed -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="color-selection mb-3">
                                            <h4 class="color-heading">Brand:</h4>
                                            <div class="brand-filter">
                                                @foreach(\App\CPU\BrandManager::get_brands() as $brand)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="brand"
                                                        id="brandNike__{{ $brand['id'] }}" value="{{ $brand['name'] }}">
                                                    <label class="form-check-label" for="brandNike__{{ $brand['id'] }}">
                                                        <span class="brand-logo"></span>
                                                            {{ $brand['name'] }}
                                                    </label>
                                                </div>
                                                @endforeach
                                                <!-- Add more brands as needed -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------End shopping cart canva-->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row mb-3">
                        <div class="col text-center">
                            <div class="section-heading-title">
                                <h3>Shopping</h3>
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
                        @if (count($shop_products) > 0)
                        <div class="row product-grid" id="ajax-products">
                            <!-- Your product columns go here -->
                                @include('web-views.products._ajax-products',['products'=>$shop_products])
                        </div>
                        <hr class="my-3">
                    @else
                        <div class="text-center pt-5">
                            <h2>Product Coming Soon!</h2>
                        </div>
                    @endif
                </div>
            </div>

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
        url: '{{url('/')}}/products',
        data: {
            sort_by: value
        },
        dataType: 'json',
        beforeSend: function () {
            $('#loading').show();
        },
        success: function (response) {
            $('#ajax-products').html(response.view);
        },
        complete: function () {
            $('#loading').hide();
        },
    });
}

function searchByPrice() {
    let min = $('#min_price').val();
    let max = $('#max_price').val();
    $.get({
        url: '{{url('/')}}/products',
        data: {
            min_price: min,
            max_price: max,
        },
        dataType: 'json',
        beforeSend: function () {
            $('#loading').show();
        },
        success: function (response) {
            $('#ajax-products').html(response.view);
            $('#paginator-ajax').html(response.paginator);
        },
        complete: function () {
            $('#loading').hide();
        },
    });
}

$("#search-brand").on("keyup", function () {
    var value = this.value.toLowerCase().trim();
    $("#lista1 div>li").show().filter(function () {
        return $(this).text().toLowerCase().trim().indexOf(value) == -1;
    }).hide();
});
$("#search-brand-m").on("keyup", function () {
    var value = this.value.toLowerCase().trim();
    $("#lista1 div>li").show().filter(function () {
        return $(this).text().toLowerCase().trim().indexOf(value) == -1;
    }).hide();
});
</script>
<script>
    cartQuantityInitialize();
</script>
@endpush
