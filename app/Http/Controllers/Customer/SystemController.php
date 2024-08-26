<?php

namespace App\Http\Controllers\Customer;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\CartShipping;
use App\Model\Order;
use App\Model\Product;
use App\Model\ShippingAddress;
use App\Model\ShippingMethod;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SystemController extends Controller
{
    public function set_payment_method($name)
    {
        if (auth('customer')->check() || session()->has('mobile_app_payment_customer_id')) {
            session()->put('payment_method', $name);
            return response()->json([
                'status' => 1
            ]);
        }
        return response()->json([
            'status' => 0
        ]);
    }

    public function set_shipping_method(Request $request)
    {
        if ($request['id'] != 0) {
            session()->put('shipping_method_id', $request['id']);

            $cart = $request->session()->get('cart', collect([]));
            $cart = $cart->map(function ($object, $key) use ($request) {
                if ($key == $request['key']) {
                    $object['shipping_method_id'] = $request['id'];
                    $object['shipping_cost'] = ShippingMethod::find($request['id'])->cost;
                }
                return $object;
            });
            $request->session()->put('cart', $cart);

            return response()->json([
                'status' => 1
            ]);
        }
        return response()->json([
            'status' => 0
        ]);
    }
    public function set_pos_shipping_method(Request $request)
    {
        if ($request['id'] != 0) {
            session()->put('shipping_method_id', $request['id']);


            $shipping_cost = ShippingMethod::find($request['id'])->cost;

            $request->session()->put('shipping_cost', $shipping_cost);

            return response()->json([
                'status' => 1
            ]);
        }
        return response()->json([
            'status' => 0
        ]);
    }

    public static function insert_into_cart_shipping($request)
    {
        $shipping = CartShipping::where(['cart_group_id' => $request['cart_group_id']])->first();
        if (isset($shipping) == false) {
            $shipping = new CartShipping();
        }
        $shipping['cart_group_id'] = $request['cart_group_id'];
        $shipping['shipping_method_id'] = $request['id'];
        $shipping['shipping_cost'] = ShippingMethod::find($request['id'])->cost;
        $shipping->save();
    }

    public function choose_shipping_address(Request $request)
    {
        $shipping = [];
        $billing = [];
        parse_str($request->shipping, $shipping);
        parse_str($request->billing, $billing);

        if (isset($shipping['save_address']) && $shipping['save_address'] == 'on') {

            if ($shipping['contact_person_name'] == null || $shipping['address'] == null || $shipping['city'] == null) {
                return response()->json([
                    'errors' => ['']
                ], 403);
            }

            $address_id = DB::table('shipping_addresses')->insertGetId([
                'customer_id' => auth('customer')->id(),
                'contact_person_name' => $shipping['contact_person_name'],
                'address_type' => $shipping['address_type'],
                'address' => $shipping['address'],
                'city' => $shipping['city'],
                'zip' => $shipping['zip'],
                'phone' => $shipping['phone'],
                'latitude' => $shipping['latitude'],
                'longitude' => $shipping['longitude'],
                'is_billing' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else if ($shipping['shipping_method_id'] == 0) {

            if ($shipping['contact_person_name'] == null || $shipping['address'] == null || $shipping['city'] == null) {
                return response()->json([
                    'errors' => ['']
                ], 403);
            }

            $address_id = DB::table('shipping_addresses')->insertGetId([
                'customer_id' => 0,
                'contact_person_name' => $shipping['contact_person_name'],
                'address_type' => $shipping['address_type'],
                'address' => $shipping['address'],
                'city' => $shipping['city'],
                'zip' => $shipping['zip'],
                'phone' => $shipping['phone'],
                'latitude' => $shipping['latitude'],
                'longitude' => $shipping['longitude'],
                'is_billing' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $address_id = $shipping['shipping_method_id'];
        }


        if ($request->billing_addresss_same_shipping == 'false') {

            if (isset($billing['save_address_billing']) && $billing['save_address_billing'] == 'on') {

                if ($billing['billing_contact_person_name'] == null || $billing['billing_address'] == null || $billing['billing_city'] == null) {
                    return response()->json([
                        'errors' => ['']
                    ], 403);
                }

                $billing_address_id = DB::table('shipping_addresses')->insertGetId([
                    'customer_id' => auth('customer')->id(),
                    'contact_person_name' => $billing['billing_contact_person_name'],
                    'address_type' => $billing['billing_address_type'],
                    'address' => $billing['billing_address'],
                    'city' => $billing['billing_city'],
                    'zip' => $billing['billing_zip'],
                    'phone' => $billing['billing_phone'],
                    'latitude' => $billing['billing_latitude'],
                    'longitude' => $billing['billing_longitude'],
                    'is_billing' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else if ($billing['billing_method_id'] == 0) {

                if ($billing['billing_contact_person_name'] == null || $billing['billing_address'] == null || $billing['billing_city'] == null) {
                    return response()->json([
                        'errors' => ['']
                    ], 403);
                }

                $billing_address_id = DB::table('shipping_addresses')->insertGetId([
                    'customer_id' => 0,
                    'contact_person_name' => $billing['billing_contact_person_name'],
                    'address_type' => $billing['billing_address_type'],
                    'address' => $billing['billing_address'],
                    'city' => $billing['billing_city'],
                    'zip' => $billing['billing_zip'],
                    'phone' => $billing['billing_phone'],
                    'latitude' => $billing['billing_latitude'],
                    'longitude' => $billing['billing_longitude'],
                    'is_billing' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $billing_address_id = $billing['billing_method_id'];
            }
        } else {
            $billing_address_id = $shipping['shipping_method_id'];
        }

        session()->put('address_id', $address_id);
        session()->put('billing_address_id', $billing_address_id);

        return response()->json([], 200);
    }
    public function productCheckoutOrder(Request $request)
    {
        // $request->dd();
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'shipping_method_id' => 'required',
            'payment_method' => 'required|in:cash_on_delivery,online_payment'
        ]);
        // Check if user is authenticated
        if (auth('customer')->check()) {
            $authUser = auth('customer')->user();
        } else {
            // Try to find the user by phone number
            $oldCustomer = User::where('phone', $request->phone)->first();
            $remember = true;

            if ($oldCustomer) {
                // Old user but not authenticated, log them in
                auth('customer')->login($oldCustomer, $remember);
                $authUser = auth('customer')->user();
            } else {
                // New user, create an account and log them in
                $email = $request->phone . '_bd@gmail.com';
                if ($request->email) {
                    $email = $request->email;
                }

                $password = bcrypt($request->phone);

                // Create a new user
                $newUser = User::create([
                    'f_name' => $request->name,
                    'l_name' => 'bd' . rand(),
                    'email' => $email,
                    'phone' => $request->phone,
                    'password' => $password
                ]);

                // Log in the new user
                auth('customer')->login($newUser, $remember);
                $authUser = auth('customer')->user();
            }
        }

        if ($authUser) {
            $shippingAddress = new ShippingAddress();
            $shippingAddress->customer_id = auth('customer')->id();
            $shippingAddress->contact_person_name = $request->name;
            $shippingAddress->address = $request->address;
            $shippingAddress->city = 'city';
            $shippingAddress->phone = $request->phone;
            $shippingAddress->created_at = now();
            $shippingAddress->save();

            ///order table code
            $discount = session()->has('coupon_discount') ? session('coupon_discount') : 0;
            $coupon_code = session()->has('coupon_code') ? session('coupon_code') : 0;
            $or = [
            'id' => 100000 + Order::all()->count() + 1,
            'verification_code' => rand(100000, 999999),
            'customer_id' => auth('customer')->id(),
            'customer_type' => 'customer',
            'payment_status' => 'unpaid',
            'order_status' => 'pending',
            'payment_method' => $request->payment_method,
            'transaction_ref' => null,
            'coupon_code' => $coupon_code,
            'discount_amount' => $discount,
            'discount_type' => $discount == 0 ? null : 'coupon_discount',
            'order_amount' => CartManager::cart_grand_total(session('cart')) - $discount,
            'shipping_address' => $shippingAddress->id,
            'shipping_address_data' => ShippingAddress::find($shippingAddress->id),
            'shipping_method_id' => $request->shipping_method_id,
            'shipping_cost' => CartManager::get_shipping_cost($request->shipping_method_id),
            'created_at' => now()
            ];

            $order_id = DB::table('orders')->insertGetId($or);

            foreach (session('cart') as $c) {
                $product = Product::where(['id' => $c['id']])->first();
                $or_d = [
                    'order_id' => $order_id,
                    'product_id' => $c['id'],
                    'seller_id' => $product->added_by == 'seller' ? $product->user_id : '0',
                    'product_details' => $product,
                    'qty' => $c['quantity'],
                    'price' => $c['price'],
                    'tax' => $c['tax'] * $c['quantity'],
                    'discount' => $c['discount'] * $c['quantity'],
                    'discount_type' => 'discount_on_product',
                    'variant' => $c['variant'],
                    'variation' => json_encode($c['variations']),
                    'delivery_status' => 'pending',
                    'shipping_method_id' => $c['shipping_method_id'],
                    'payment_status' => 'unpaid',
                    'created_at' => now()
                ];

                if ($c['variant'] != null) {
                    $type = $c['variant'];
                    $var_store = [];
                    foreach (json_decode($product['variation'], true) as $var) {
                        if ($type == $var['type']) {
                            $var['qty'] -= $c['quantity'];
                        }
                        array_push($var_store, $var);
                    }
                    Product::where(['id' => $product['id']])->update([
                        'variation' => json_encode($var_store),
                    ]);
                }

                // Product::where(['id' => $product['id']])->update([
                //     'current_stock' => $product['current_stock'] - $c['quantity']
                // ]);

                DB::table('order_details')->insert($or_d);
            }

            try {
                $fcm_token = User::where(['id' => auth('customer')->id()])->first()->cm_firebase_token;
                $value = \App\CPU\Helpers::order_status_update_message('pending');
                if ($value) {
                    $data = [
                        'title' => 'Order',
                        'description' => $value,
                        'order_id' => $order_id,
                        'image' => '',
                    ];
                    Helpers::send_push_notif_to_device($fcm_token, $data);
                }
            } catch (\Exception $e) {
                Toastr::error('FCM token config issue.');
            }

            try {
                Mail::to(auth('customer')->user()->email)->send(new \App\Mail\OrderPlaced($order_id));
            } catch (\Exception $mail_exception) {
                Toastr::error('Invalid mail or configuration.');
            }

            session()->forget('cart');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
            session()->forget('payment_method');
            session()->forget('customer_info');
            session()->forget('shipping_method_id');

            return view('web-views.checkout-complete', compact('order_id'));
        } else {
            return "something went wrong please try again";
        }
    }
}
