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
                        <div class="category">
                            <div class="category-header">
                                <a href="#">Electronics</a>
                                <span class="toggle-icon" data-toggle="electronics">+</span>
                            </div>
                            <div class="sub-categories" id="electronics">
                                <div class="sub-category">
                                    <div class="sub-category-header">
                                        <a href="#">Mobiles</a>
                                        <span class="toggle-icon" data-toggle="mobiles">+</span>
                                    </div>
                                    <div class="child-categories" id="mobiles">
                                        <a href="#">Smartphones</a><br>
                                        <a href="#">Feature Phones</a>
                                    </div>
                                </div>
                                <div class="sub-category">
                                    <div class="sub-category-header">
                                        <a href="#">Televisions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="category">
                            <div class="category-header">
                                <a href="#">Fashion</a>
                                <span class="toggle-icon" data-toggle="fashion">+</span>
                            </div>
                            <div class="sub-categories" id="fashion">
                                <div class="sub-category">
                                    <div class="sub-category-header">
                                        <a href="#">Men</a>
                                        <span class="toggle-icon" data-toggle="men">+</span>
                                    </div>
                                    <div class="child-categories" id="men">
                                        <a href="#">Clothing</a><br>
                                        <a href="#">Shoes</a>
                                    </div>
                                </div>
                                <div class="sub-category">
                                    <div class="sub-category-header">
                                        <a href="#">Women</a>
                                        <span class="toggle-icon" data-toggle="women">+</span>
                                    </div>
                                    <div class="child-categories" id="women">
                                        <a href="#">Clothing</a><br>
                                        <a href="#">Accessories</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand"
                                    id="brandNike" value="nike">
                                <label class="form-check-label" for="brandNike">
                                    <span class="brand-logo"
                                        style="background-image: url('https://via.placeholder.com/20x20?text=N');"></span>
                                    Nike
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand"
                                    id="brandAdidas" value="adidas">
                                <label class="form-check-label" for="brandAdidas">
                                    <span class="brand-logo"
                                        style="background-image: url('https://via.placeholder.com/20x20?text=A');"></span>
                                    Adidas
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand"
                                    id="brandPuma" value="puma">
                                <label class="form-check-label" for="brandPuma">
                                    <span class="brand-logo"
                                        style="background-image: url('https://via.placeholder.com/20x20?text=P');"></span>
                                    Puma
                                </label>
                            </div>
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
