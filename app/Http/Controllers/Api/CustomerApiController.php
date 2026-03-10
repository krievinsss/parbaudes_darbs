<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;

class CustomerApiController extends Controller
{
    public function index() {
        $customers = Customer::query()->latest()->paginate(10);

        return CustomerResource::collection($customers);
    }

    public function orders(Customer $customer) {
        $orders = $customer->orders()
            ->with(['customer', 'user'])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
    }
}