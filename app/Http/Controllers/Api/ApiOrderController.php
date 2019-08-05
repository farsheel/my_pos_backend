<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Order::paginate(100));
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
            'items.*.order_product_name' => 'required',
            'items.*.order_product_id' => 'required|numeric|exists:product,product_id',
            'items.*.order_price' => 'required|numeric',
            'items.*.quantity' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }

        $order = new Order();
        $order->save();

        $items = $request->get('items');
        $order->order_items()->createMany($items);

        return response()->json([
            'status' => true,
            'message' => "Success",
            'order_id' => $order->order_id,
            'item' => $order->order_items
        ], 200);

    }


    /**
     * Send email receipt
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmailReceipt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|numeric|exists:orders,order_id',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }
        return response()->json([
            'status' => true,
            'message' => "Receipt sent!",
        ], 200);
    }
}
