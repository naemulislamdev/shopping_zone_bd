<div class="filter-box" id="filter-box">
    <a data-bs-toggle="offcanvas" href="#productFilter" role="button"
        aria-controls="productFilter"><i class="fa fa-filter"></i> Filter</a>
    <!------shopping cart canva-->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="productFilter"
        aria-labelledby="offcanvaProductFilterCard">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvaProductFilterCard">FILTER</h5>
            <i class="fa fa-close offcanvasClose" data-bs-dismiss="offcanvas" aria-label="Close"></i>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="wrapper">
                        <h4 class="color-heading">Price</h4>
                        <div class="price-input">
                            <div class="field">
                                <span>Min</span>
                                <input type="number" class="input-min" value="2500">
                            </div>
                            <div class="separator">-</div>
                            <div class="field">
                                <span>Max</span>
                                <input type="number" class="input-max" value="7500">
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
                    <a href="#" class="w-100 common-btn">Search</a>
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

{{-- <div class="select-box d-flex">
    <select class="form-control" name="filter">
        <option>Low to High Price</option>
        <option>High to Low Price</option>
        <option>A to Z Order</option>
        <option>Z to A Order</option>
    </select>
</div> --}}
