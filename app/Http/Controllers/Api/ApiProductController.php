<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

class ApiProductController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::paginate(1000));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_upc' => 'required|string|max:50',
            'product_cat_id' => 'required|exists:category,cat_id',
            'product_price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }

        $product = Product::firstOrNew(["product_id" => $request->product_id]);
        $product->fill($request->all());
        $product->save();

        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Product created successfully'
        ], 200);
    }

    public function uploadImage(Request $request)
    {
        // Form validation
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,product_id',
            'product_image' => 'required|mimes:jpeg,png,jpg,gif'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }


        // Get image file
        $image = $request->file('product_image');
        // Make a image name based on user name and current timestamp
        $name = Str::slug($request->input('name')) . '_' . time();
        // Define folder path
        $folder = '/uploads/images/';
        $imageName = sha1(now()) . "_" . $name;
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $imageName;
        // Upload image

        $result = $this->uploadOne($image, $folder, 'public', $imageName);

        if ($result) {
            $product = Product::find($request->get("product_id"));
            $product->product_image = $imageName . "." . $image->getClientOriginalExtension();
            $product->save();


            return response()->json([
                'status' => true,
                'message' => "Success",
                'data' => $product
            ], 200);
        } else {
            // Set user profile image path in database to filePath
            return response()->json([
                'status' => false,
                'message' => "Can't upload file"
            ], 200);
        }

    }
}
