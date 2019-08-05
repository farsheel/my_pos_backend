<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::paginate(10));
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

        $product = Product::firstOrNew(["product_id"=> $request->product_id]);
        $product->fill($request->all());
        $product->save();

        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Product created successfully'
        ], 200);
    }
}
