<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon-32x32.png" type="image/x-icon">
    @include('frontend.layouts.include.head')
    @yield('customcss')
</head>
<body>
    <section class="topbar-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <span class="topbar-contact">Need any help: <a href="tel:/0255020580">0255020580</a></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="topbar-left">
                        <div class="topbar-box">
                            <ul>
                                <li><a href="#">Complain</a></li>
                                <li><a href="#">Place Manual Order</a></li>
                                <li><a href="#">Order Track</a></li>
                                <li><a href="#">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Header & Navigation Section -->
    @include('frontend.layouts.include.header')
    <!--end mobile menu-->
    <!------Search canva-->
    @include('frontend.layouts.include.offcanvas')
    <!------End shopping cart canva-->
    <!------start Category section-->
    @yield('content')
    <!-- Start  Footer Section -->
    @include('frontend.layouts.include.footer')
    <!-- End Copyright Section -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('frontend.layouts.include.foot')
    @stack('scripts')
    <script>
        $(document).ready(function() {
            // Show the popup when the window has fully loaded
            $(window).on('load', function() {
                $('.overlay, .popup').fadeIn('slow');
            });

            // Close the popup smoothly
            $('.popup-close, .overlay').on('click', function() {
                $('.popup, .overlay').fadeOut('slow');
            });
        });
    </script>
    <script>
        function addToCart(form_id = 'add-to-cart-form', redirect_to_checkout=false) {
            console.log("Ok");
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
    </script>
</body>

</html>
