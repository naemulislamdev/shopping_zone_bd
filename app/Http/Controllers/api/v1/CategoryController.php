<?php

namespace App\Http\Controllers\api\v1;

use App\CPU\CategoryManager;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_categories()
    {
        try {
            $categories = Category::with(['childes.childes'])->where(['position' => 0])->priority()->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

     public function get_subcategories($id)
    {
        try {
            $categories = Category::with(['childes.childes'])->where(['position' => 1])->where(['parent_id' => $id])->priority()->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products(Request $request, $id)
    {

        return response()->json(Helpers::product_data_formatting(CategoryManager::products($id,$request['limit'], $request['offset']), true), 200);
    }

    public function get_products_slug($slug)

    {

            return response()->json(Helpers::product_data_formatting(CategoryManager::products_slug($slug), true), 200);
    }
}
