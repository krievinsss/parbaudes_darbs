<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderApiController extends Controller
{
    public function store(StoreOrderRequest $request) {
        $order = Order::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        $order->load(['customer', 'user']);

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(201);
    }
}