<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderApiController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $data['customer_id'] = auth()->user()->isAdmin()
            ? $request->validated('customer_id')
            : auth()->user()->customer_id;

        $data['user_id'] = auth()->id();

        $order = Order::create($data);
        $order->load(['customer', 'user']);

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(201);
    }
}