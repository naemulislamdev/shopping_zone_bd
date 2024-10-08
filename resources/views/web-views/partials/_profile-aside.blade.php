<style>
    body {
        font-family: sans-serif;
    }

    .footer span {
        font-size: 12px
    }

    .product-qty span {
        font-size: 12px;
        color: #6A6A6A;
    }

    label {
        font-size: 16px;
    }

    .divider-role {
        border-bottom: 1px solid whitesmoke;
    }

    .sidebarL h3:hover + .divider-role {
        border-bottom: 3px solid {{$web_config['secondary_color']}}    !important;
        transition: .2s ease-in-out;
    }

    .price_sidebar {
        padding: 20px;
    }
    .box-shadow-sm {
    box-shadow: 0 0.125rem 0.3rem -0.0625rem rgba(0, 0, 0, 0.03), 0 0.275rem 0.75rem -0.0625rem rgba(0, 0, 0, 0.06) !important;
}

    @media (max-width: 600px) {

        .sidebar_heading h1 {
            text-align: center;
            color: aliceblue;
            padding-bottom: 17px;
            font-size: 19px;
        }

        .sidebarR {
            padding: 24px;
        }

        .price_sidebar {
            padding: 20px;
        }
    }

</style>

<div class="sidebarR col-lg-3 col-md-3">
    <!--Price Sidebar-->
    <div class="price_sidebar rounded-lg box-shadow-sm" id="shop-sidebar" style="margin-bottom: -10px;background: white">
        <div class="box-shadow-sm">

        </div>
        <div class="pb-0" style="padding-top: 12px;">
            <!-- Filter by price-->
            <div class="sidebarL">
                <h3 class="widget-title btnF" style="font-weight: 700;">
                    <a class="{{Request::is('account-oder*') || Request::is('account-order-details*') ? 'active-menu' :''}}" href="{{route('account-oder') }} ">{{\App\CPU\translate('my_order')}}</a>
                </h3>
                <div class="divider-role"
                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                </div>
            </div>
        </div>
        @php
            $wallet_status = App\CPU\Helpers::get_business_settings('wallet_status');
            $loyalty_point_status = App\CPU\Helpers::get_business_settings('loyalty_point_status');
        @endphp
        @if ($wallet_status == 1)
            <div class="pb-0">
                <!-- Filter by price-->
                <div class="sidebarL">
                    <h3 class="widget-title btnF" style="font-weight: 700;">
                        <a class="{{Request::is('wallet')?'active-menu':''}}" href="{{route('wallet') }} ">{{\App\CPU\translate('my_wallet')}} </a>
                    </h3>
                    <div class="divider-role"
                        style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                    </div>
                </div>
            </div>
        @endif
        @if ($loyalty_point_status == 1)
            <div class="pb-0">
                <!-- Filter by price-->
                <div class="sidebarL">
                    <h3 class="widget-title btnF" style="font-weight: 700;">
                        <a class="{{Request::is('loyalty')?'active-menu':''}}" href="{{route('loyalty') }} ">{{\App\CPU\translate('my_loyalty_point')}}</a>
                    </h3>
                    <div class="divider-role"
                        style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                    </div>
                </div>
            </div>
        @endif
        <div class="pb-0">
            <!-- Filter by price-->
            <div class="sidebarL">
                <h3 class="widget-title btnF" style="font-weight: 700;">
                    <a class="{{Request::is('track-order*')?'active-menu':''}}" href="{{route('track-order.index') }} ">{{\App\CPU\translate('track_your_order')}}</a>
                </h3>
                <div class="divider-role"
                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                </div>
            </div>
        </div>
        <div class="pb-0">
            <!-- Filter by price-->
            <div class="sidebarL">
                <h3 class="widget-title btnF " style="font-weight: 700;">
                    <a class="{{Request::is('wishlists*')?'active-menu':''}}" href="{{route('wishlists')}}"> {{\App\CPU\translate('wish_list')}}  </a></h3>
                <div class="divider-role"
                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                </div>
            </div>
        </div>

        {{--to do--}}
        @php($business_mode=\App\CPU\Helpers::get_business_settings('business_mode'))
        @if ($business_mode == 'multi')
            <div class="pb-0">
                <!-- Filter by price-->
                <div class="sidebarL">
                    <h3 class="widget-title btnF" style="font-weight: 700;">
                        <a class="{{Request::is('chat*')?'active-menu':''}}" href="{{route('chat-with-seller')}}">{{\App\CPU\translate('chat_with_seller')}}</a>
                    </h3>
                    <div class="divider-role"
                        style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                    </div>
                </div>
            </div>
        @endif

        <div class="pb-0">
            <!-- Filter by price-->
            <div class=" sidebarL">
                <h3 class="widget-title btnF" style="font-weight: 700;">
                    <a class="{{Request::is('user-account*')?'active-menu':''}}" href="{{route('user-account')}}">
                        {{\App\CPU\translate('profile_info')}}
                    </a>
                </h3>
                <div class="divider-role"
                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                </div>
            </div>
        </div>
        <div class="pb-0">
            <!-- Filter by price-->
            <div class=" sidebarL">
                <h3 class="widget-title btnF" style="font-weight: 700;">
                    <a class="{{Request::is('account-address*')?'active-menu':''}}"
                       href="{{ route('account-address') }}">{{\App\CPU\translate('address')}} </a>
                </h3>
                <div class="divider-role"
                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                </div>
            </div>
        </div>
        <div class="pb-0">
            <!-- Filter by price-->
            <div class=" sidebarL">
                <h3 class="widget-title btnF" style="font-weight: 700;">
                    <a class="{{(Request::is('account-ticket*') || Request::is('support-ticket*'))?'active-menu':''}}"
                       href="{{ route('account-tickets') }}">{{\App\CPU\translate('support_ticket')}}</a></h3>
                <div class="divider-role"
                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                </div>
            </div>
        </div>
        <div class="pb-0">
            <!-- Filter by price-->
            <div class=" sidebarL">
                <h3 class="widget-title btnF" style="font-weight: 700;">
                    <a class=""
                       href="{{ route('account-logout') }}">{{\App\CPU\translate('Logout')}}</a></h3>
                <div class="divider-role"
                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;">
                </div>
            </div>
        </div>

    </div>
</div>


















