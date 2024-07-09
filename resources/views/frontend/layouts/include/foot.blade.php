<script src="{{ asset('public/frontend') }}/assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/bootstrap_v4.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/bs_v5.js"></script>
    <!-- Owl-carosul js file cdn link -->
    <script src="{{ asset('public/frontend') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/owl-extra-code.js"></script>
    <script src="{{ asset('public/frontend') }}/https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/simple-lightbox.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/xzoom.min.js"></script>

    <script>
        $(document).ready(function() {
            /*mobile menu*/
            $('.menu-icon').on('click', function() {
                $('.mobile-menu').toggleClass('mobile-menu-active');
            });
            $('.mm-ci').on('click', function() {
                $('.mobile-menu').toggleClass('mobile-menu-active');
            });


        });
    </script>
    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".menu-link").find(".fa-minus").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".menu-link").find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".menu-link").find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
            });
            /*mobile-menu-click*/
            $('.mmenu-btn').click(function() {
                $(this).toggleClass("menu-link-active");

            });
        });
    </script>
    <script>
        // Product price filter input in min and max
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
    <script>
        new WOW().init();
    </script>
    <script>
        //Grid view system on product
        $(document).ready(function() {
            $('.grid-btn').on('click', function() {
                var columns = $(this).data('columns');
                var category = $(this).data('category');
                // console.log(columns);
                $('.product-column[data-category="' + category + '"]')
                    .removeClass('col-md-2 col-md-3 col-md-4 col-md-5 col-md-6')
                    .addClass('col-md-' + columns);

                $('.grid-btn[data-category="' + category + '"]').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
    <script>
        //Grid view system on product in mobile responsive
        $(document).ready(function() {
            $('.grid-btn-mobile').on('click', function() {
                var columns = $(this).data('columns');
                var category = $(this).data('category');
                // console.log(columns);
                $('.product-column[data-category="' + category + '"]')
                    .removeClass('col-md-2 col-md-3 col-md-4 col-md-5 col-md-6 col-sm-12 col-sm-6')
                    .addClass('col-sm-' + columns);

                $('.grid-btn-mobile[data-category="' + category + '"]').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
    <script>
        //When scroll on window
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    <script>
        //When scroll display block in filter section other wise display none
        window.addEventListener('scroll', function() {
            const header = document.getElementById('filter-box');
            if (window.scrollY > 750) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    <script>
        //category filter category show and hide
        $(document).ready(function() {
            $('.category-header').on('click', function() {
                var toggleId = $(this).find('.toggle-icon').data('toggle');
                $('#' + toggleId).slideToggle();
                var icon = $(this).find('.toggle-icon');
                icon.text(icon.text() === '+' ? '-' : '+');
            });

            $('.sub-category-header').on('click', function() {
                var toggleId = $(this).find('.toggle-icon').data('toggle');
                if (toggleId) {
                    $('#' + toggleId).slideToggle();
                    var icon = $(this).find('.toggle-icon');
                    icon.text(icon.text() === '+' ? '-' : '+');
                }
            });
        });
    </script>
