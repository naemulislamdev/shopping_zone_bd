<?php

namespace App\Http\Controllers\api\v1;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function complainStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:140',
            'phone' => ['required', function ($attribute, $value, $fail) {
                if (!preg_match('/^(?:\+88|88)?(01[3-9]\d{8})$/', $value)) {
                    $fail('The ' . $attribute . ' must be a valid Bangladesh phone number.');
                }
            }],
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'complain_details' => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $imagePath = ImageManager::upload('complaints/', 'png', $request->file('image'));
        try {
            $complain = Complaint::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'reasons' => $request->complain_details,
                'images' => $imagePath,
                'status' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'failed',
                'message' => 'Something went wrong',
            ], 403);
        }
        return response()->json([
            'message' => 'Complain is created successfully',
            'status' => 200
        ]);
    }
}
