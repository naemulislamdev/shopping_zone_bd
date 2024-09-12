<?php

namespace App\Http\Controllers\Admin;

use App\CPU\ImageManager;
use App\CPU\BackEndHelper;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\LandingPage;
use App\Model\LandingPages;
use App\Model\Product;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LandingPagesController extends Controller
{

    public function landing_index(Request $request)
    {
        $landing_page = DB::table('landing_pages')->get();
        return view('admin-views.landingpages.landing-index', compact('landing_page'));
    }

    public function landing_submit(Request $request)
    {
        $this->validate($request, [
            'images' => 'required',
            'mid_banner' => 'required',
            'left_side_banner' => 'required',
            'right_side_banner' => 'required',
        ], [
            'images.required' => 'Banner image is required!',
            'mid_banner.required'  => 'Mid banner is required!',
            'left_side_banner.required'  => 'Left banner is required!',
            'right_side_banner.required' => 'Right banner is required!',

        ]);

        $images = null;
        if ($request->file('images')) {
            foreach ($request->file('images') as $img) {
                $main_banner_images[] = ImageManager::upload('deal/main-banner/', 'png', $img);
            }
            $images = json_encode($main_banner_images);
        }

        $flash_deal_id = DB::table('landing_pages')->insertGetId([
            'title' => $request['title'][array_search('en', $request->lang)],
            'main_banner' => $images,
            'mid_banner' => $request->has('mid_banner') ? ImageManager::upload('deal/', 'png', $request->file('mid_banner')) : 'def.png',
            'left_side_banner' => $request->has('left_side_banner') ? ImageManager::upload('deal/', 'png', $request->file('left_side_banner')) : 'def.png',
            'right_side_banner' => $request->has('right_side_banner') ? ImageManager::upload('deal/', 'png', $request->file('right_side_banner')) : 'def.png',
            'meta_title' => $request['title'][array_search('en', $request->lang)],
            'meta_description' => $request['meta_description'],
            'slug' => Str::slug($request['title'][array_search('en', $request->lang)]),
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Toastr::success('Land-Pages added successfully!');
        return back();
    }



    public function status_update(Request $request)
    {

        // DB::table('landing_pages')->where(['status' => 1])->update(['status' => 0]);
        DB::table('landing_pages')->where(['id' => $request['id']])->update([
            'status' => $request['status'],
        ]);
        return response()->json([
            'success' => 1,
        ], 200);
    }

    public function edit($landing_id)
    {
        $landing_pages = DB::table('landing_pages')->find($landing_id);
        return view('admin-views.landingpages.landing-pages-update', compact('landing_pages'));
    }
    public function remove_image(Request $request)
    {
        ImageManager::delete('/deal/main-banner/' . $request['image']);
        $landingPage = LandingPages::find($request['id']);
        $array = [];
        if (count(json_decode($landingPage->main_banner)) == 2) {
            Toastr::warning('You cannot delete all images!');
            return back();
        }
        foreach (json_decode($landingPage['main_banner']) as $image) {
            if ($image != $request['name']) {
                array_push($array, $image);
            }
        }
        LandingPages::where('id', $request['id'])->update([
            'main_banner' => json_encode($array),
        ]);
        Toastr::success('Main banner image removed successfully!');
        return back();
    }

    public function update(Request $request, $deal_id)
    {
        $deal = DB::table('landing_pages')->find($deal_id);

        $images = json_decode($deal->main_banner, true) ?? []; // Decode existing images or start with an empty array

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $uploaded_image = ImageManager::upload('deal/main-banner/', 'png', $img);
                $images[] = $uploaded_image;
            }
        }
        $finalImage = json_encode($images);

        if ($request->mid_banner) {
            $deal->mid_banner = ImageManager::update('deal/', $deal->mid_banner, 'png', $request->file('mid_banner'));
        }
        if ($request->left_side_banner) {
            $deal->left_side_banner = ImageManager::update('deal/', $deal->left_side_banner, 'png', $request->file('left_side_banner'));
        }
        if ($request->right_side_banner) {
            $deal->right_side_banner = ImageManager::update('deal/', $deal->right_side_banner, 'png', $request->file('right_side_banner'));
        }

        DB::table('landing_pages')->where(['id' => $deal_id])->update([
            'title' => $request['title'],
            'main_banner' => $finalImage,
            'mid_banner' => $deal->mid_banner,
            'left_side_banner' => $deal->left_side_banner,
            'right_side_banner' => $deal->right_side_banner,
            'slug' => Str::slug($request['title']),
            'status' => $deal->status,
            'updated_at' => now(),
        ]);
        Toastr::success('Landing pages  updated successfully!');
        return back();
    }

    public function add_product($deal_id)
    {
        $flash_deal_products = DB::table('landing_pages_products')->where('landing_id', $deal_id)->pluck('product_id');
        // dd($flash_deal_products);

        $products = Product::whereIn('id', $flash_deal_products)->paginate(Helpers::pagination_limit());

        $deal = DB::table('landing_pages')->where('id', $deal_id)->first();

        return view('admin-views.landingpages.add-product', compact('deal', 'products', 'flash_deal_products'));
    }

    public function add_product_submit(Request $request, $deal_id)
    {

        $flash_deal_products = DB::table('landing_pages_products')->where('landing_id', $deal_id)->where('product_id', $request['product_id'])->first();


        if (!isset($flash_deal_products)) {
            $campaing_detalie = [];
            for ($i = 0; $i < count($request->product_id); $i++) {
                $campaing_detalie[] = [
                    'product_id' => $request['product_id'][$i],
                    'landing_id' => $deal_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('landing_pages_products')->insert($campaing_detalie);
            Toastr::success('Product added successfully!');
            return back();
        } else {
            Toastr::info('Product already added!');
            return back();
        }
    }

    public function delete_product(Request $request)
    {
        DB::table('landing_pages_products')->where('product_id', $request->id)->delete();

        return response()->json();
    }
}
