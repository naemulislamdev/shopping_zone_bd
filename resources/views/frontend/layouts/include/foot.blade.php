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
    <script src="{{ asset('public/frontend') }}/assets/js/xzoom_setup.js"></script>
    <script src={{asset("public/assets/back-end/js/toastr.js")}}></script>
    {!! Toastr::message() !!}
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
    {{-- Product js --}}
    <script>
        function addWishlist(product_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('store-wishlist')}}",
                method: 'POST',
                data: {
                    product_id: product_id
                },
                success: function (data) {
                    if (data.value == 1) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.countWishlist').html(data.count);
                        $('.countWishlist-' + product_id).text(data.product_count);
                        $('.tooltip').html('');

                    } else if (data.value == 2) {
                        Swal.fire({
                            type: 'info',
                            title: 'WishList',
                            text: data.error
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'WishList',
                            text: data.error
                        });
                    }
                }
            });
        }

        function removeWishlist(product_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('delete-wishlist')}}",
                method: 'POST',
                data: {
                    id: product_id
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    Swal.fire({
                        type: 'success',
                        title: 'WishList',
                        text: data.success
                    });
                    $('.countWishlist').html(data.count);
                    $('#set-wish-list').html(data.wishlist);
                    $('.tooltip').html('');
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function quickView(product_id) {
            $.get({
                url: '{{route('quick-view')}}',
                dataType: 'json',
                data: {
                    product_id: product_id
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    console.log("success...")
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function addToCart(form_id = 'add-to-cart-form', redirect_to_checkout=false) {
            if (checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.post({
                    url: '{{ route('cart.add') }}',
                    data: $('#' + form_id).serializeArray(),
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status == 1) {
                            updateNavCart();
                            toastr.success(response.message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            $('.call-when-done').click();
                            if(redirect_to_checkout)
                            {
                                location.href = "{{route('checkout-details')}}";
                            }
                            return false;
                        } else if (response.status == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cart',
                                text: response.message
                            });
                            return false;
                        }
                    },
                    complete: function () {
                        $('#loading').hide();

                    }
                });
            } else {
                Swal.fire({
                    type: 'info',
                    title: 'Cart',
                    text: '{{\App\CPU\translate('please_choose_all_the_options')}}'
                });
            }
        }

        function buy_now() {
            addToCart('add-to-cart-form',true);
            /* location.href = "{{route('checkout-details')}}"; */
        }

        function currency_change(currency_code) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{route('currency.change')}}',
                data: {
                    currency_code: currency_code
                },
                success: function (data) {
                    toastr.success('{{\App\CPU\translate('Currency changed to')}}' + data.name);
                    location.reload();
                }
            });
        }

        function removeFromCart(key) {
            $.post('{{ route('cart.remove') }}', {_token: '{{ csrf_token() }}', key: key}, function (response) {
                console.log(response)
                updateNavCart();
                $('#cart-summary').empty().html(response.data);
                toastr.info('{{\App\CPU\translate('Item has been removed from cart')}}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            });
        }

        function updateNavCart() {
            $.post('{{route('cart.nav-cart')}}', {_token: '{{csrf_token()}}'}, function (response) {
                $('#cart_items').html(response.data);
            });
        }

        function cartQuantityInitialize() {
            $('.btn-number').click(function (e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function () {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function () {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                var name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: '{{\App\CPU\translate('Sorry, the minimum order quantity does not match')}}'
                    });
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: '{{\App\CPU\translate('Sorry, stock limit exceeded')}}.'
                    });
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

        function updateQuantity(key, element) {
            $.post('<?php echo e(route('cart.updateQuantity')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                key: key,
                quantity: element.value
            }, function (data) {
                updateNavCart();
                $('#cart-summary').empty().html(data);
            });
        }

        function updateCartQuantity(minimum_order_qty, key) {
            /* var quantity = $("#cartQuantity" + key).children("option:selected").val(); */
            var quantity = $("#cartQuantity" + key).val();
            if(minimum_order_qty > quantity ) {
                toastr.error('{{\App\CPU\translate("minimum_order_quantity_cannot_be_less_than_")}}' + minimum_order_qty);
                $("#cartQuantity" + key).val(minimum_order_qty);
                return false;
            }

            $.post('{{route('cart.updateQuantity')}}', {
                _token: '{{csrf_token()}}',
                key: key,
                quantity: quantity
            }, function (response) {
                if (response.status == 0) {
                    toastr.error(response.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $("#cartQuantity" + key).val(response['qty']);
                } else {
                    updateNavCart();
                    $('#cart-summary').empty().html(response);
                }
            });
        }

        $('#add-to-cart-form input').on('change', function () {
            getVariantPrice();
        });

        function getVariantPrice() {
            if ($('#add-to-cart-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.variant_price') }}',
                    data: $('#add-to-cart-form').serializeArray(),
                    success: function (data) {
                        console.log(data)
                        $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                        $('#add-to-cart-form #chosen_price_div #chosen_price').html(data.price);
                        $('#set-tax-amount').html(data.tax);
                        $('#set-discount-amount').html(data.discount);
                        $('#available-quantity').html(data.quantity);
                        $('.cart-qty-field').attr('max', data.quantity);
                    }
                });
            }
        }

        function checkAddToCartValidity() {
            var names = {};
            $('#add-to-cart-form input:radio').each(function () { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function () { // then count them
                count++;
            });
            if ($('input:radio:checked').length == count) {
                return true;
            }
            return false;
        }

        @if(Request::is('/') &&  \Illuminate\Support\Facades\Cookie::has('popup_banner')==false)
        $(document).ready(function () {
            $('#popup-modal').appendTo("body").modal('show');
        });
        @php(\Illuminate\Support\Facades\Cookie::queue('popup_banner', 'off', 1))
        @endif

        $(".clickable").click(function () {
            window.location = $(this).find("a").attr("href");
            return false;
        });
    </script>

    @if ($errors->any())
        <script>
            @foreach($errors->all() as $error)
            toastr.error('{{$error}}', Error, {
                CloseButton: true,
                ProgressBar: true
            });
            @endforeach
        </script>
    @endif

    <script>
        function couponCode() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('coupon.apply') }}',
                data: $('#coupon-code-ajax').serializeArray(),
                success: function (data) {
                    /* console.log(data);
                    return false; */
                    if (data.status == 1) {
                        let ms = data.messages;
                        ms.forEach(
                            function (m, index) {
                                toastr.success(m, index, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        );
                    } else {
                        let ms = data.messages;
                        ms.forEach(
                            function (m, index) {
                                toastr.error(m, index, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        );
                    }
                    setInterval(function () {
                        location.reload();
                    }, 2000);
                }
            });
        }

        jQuery(".search-bar-input").keyup(function () {
            $(".search-card").css("display", "block");
            let name = $(".search-bar-input").val();
            if (name.length > 0) {
                $.get({
                    url: '{{url('/')}}/searched-products',
                    dataType: 'json',
                    data: {
                        name: name
                    },
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        $('.search-result-box').empty().html(data.result)
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                });
            } else {
                $('.search-result-box').empty();
            }
        });

        jQuery(".search-bar-input-mobile").keyup(function () {
            $(".search-card").css("display", "block");
            let name = $(".search-bar-input-mobile").val();
            if (name.length > 0) {
                $.get({
                    url: '{{url('/')}}/searched-products',
                    dataType: 'json',
                    data: {
                        name: name
                    },
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        $('.search-result-box').empty().html(data.result)
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                });
            } else {
                $('.search-result-box').empty();
            }
        });

        jQuery(document).mouseup(function (e) {
            var container = $(".search-card");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });

        const img = document.getElementByTagName("img")
        img.addEventListener("error", function (event) {
            event.target.src = '{{asset('public/assets/front-end/img/image-place-holder.png')}}';
            event.onerror = null
        })

        function route_alert(route, message) {
            Swal.fire({
                title: '{{\App\CPU\translate('Are you sure')}}?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '{{$web_config['primary_color']}}',
                cancelButtonText: '{{\App\CPU\translate('No')}}',
                confirmButtonText: '{{\App\CPU\translate('Yes')}}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = route;
                }
            })
        }
    </script>
