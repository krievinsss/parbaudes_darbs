<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $this->authorize('viewAny', Order::class);

        $orders = Order::query()
            ->with(['customer', 'user'])
            ->filter($request->only(['status', 'customer_id', 'service_type']))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $customers = Customer::query()->orderBy('name')->get(['id', 'name']);
        $statuses = Order::STATUSES;
        $serviceTypes = Order::SERVICE_TYPES;

        return view('orders.index', compact('orders', 'customers', 'statuses', 'serviceTypes'));
    }

    public function create() {
        $this->authorize('create', Order::class);

        $customers = Customer::query()->orderBy('name')->get();
        $statuses = Order::STATUSES;
        $serviceTypes = Order::SERVICE_TYPES;
        $employmentTypes = Order::EMPLOYMENT_TYPES;

        return view('orders.create', compact('customers', 'statuses', 'serviceTypes', 'employmentTypes'));
    }

    public function store(StoreOrderRequest $request) {
        $this->authorize('create', Order::class);

        Order::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pakalpojuma pieprasījums veiksmīgi izveidots.');
    }

    public function edit(Order $order) {
        $this->authorize('update', $order);

        $customers = Customer::query()->orderBy('name')->get();
        $statuses = Order::STATUSES;
        $serviceTypes = Order::SERVICE_TYPES;
        $employmentTypes = Order::EMPLOYMENT_TYPES;

        return view('orders.edit', compact('order', 'customers', 'statuses', 'serviceTypes', 'employmentTypes'));
    }

    public function update(UpdateOrderRequest $request, Order $order) {
        $this->authorize('update', $order);

        $order->update($request->validated());

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pakalpojuma pieprasījums veiksmīgi atjaunināts.');
    }

    public function destroy(Order $order) {
        $this->authorize('delete', $order);

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pakalpojuma pieprasījums veiksmīgi dzēsts.');
    }
}