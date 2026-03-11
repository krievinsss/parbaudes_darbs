<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function publicIndex(Request $request) {
        $query = Order::query()
            ->with('customer')
            ->where('service_type', 'vacancy_registration')
            ->whereIn('status', ['approved', 'completed'])
            ->latest();

        $query->when(
            $request->filled('q'),
            fn ($q) => $q->where(function ($subQuery) use ($request) {
                $search = $request->string('q');

                $subQuery->where('position_title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($customerQuery) use ($search) {
                        $customerQuery->where('name', 'like', "%{$search}%");
                    });
            })
        );

        $vacancies = $query->paginate(9)->withQueryString();

        return view('welcome', compact('vacancies'));
    }

    public function publicShow(Order $order) {
        abort_unless(
            $order->service_type === 'vacancy_registration'
            && in_array($order->status, ['approved', 'completed'], true),
            404
        );

        $order->load('customer');

        return view('vacancies.show', compact('order'));
    }

    public function index(Request $request) {
        $this->authorize('viewAny', Order::class);

        $query = Order::query()
            ->with(['customer', 'user'])
            ->latest();

        if (auth()->user()->isAdmin()) {
            $query->filter($request->only(['status', 'customer_id', 'service_type']));
        } else {
            $query->where('customer_id', auth()->user()->customer_id)
                ->filter($request->only(['status', 'service_type']));
        }

        $orders = $query->paginate(10)->withQueryString();

        $customers = auth()->user()->isAdmin()
            ? Customer::query()->orderBy('name')->get(['id', 'name'])
            : Customer::query()
                ->where('id', auth()->user()->customer_id)
                ->get(['id', 'name']);

        $statuses = Order::statusOptions();
        $serviceTypes = Order::serviceTypeOptions();
        $employmentTypes = Order::employmentTypeOptions();

        return view('orders.index', compact('orders', 'customers', 'statuses', 'serviceTypes', 'employmentTypes'));
    }

    public function create() {
        $this->authorize('create', Order::class);

        $customers = auth()->user()->isAdmin()
            ? Customer::query()->orderBy('name')->get(['id', 'name'])
            : Customer::query()
                ->where('id', auth()->user()->customer_id)
                ->get(['id', 'name']);

        $statuses = Order::statusOptions();
        $serviceTypes = Order::serviceTypeOptions();
        $employmentTypes = Order::employmentTypeOptions();

        return view('orders.create', compact('customers', 'statuses', 'serviceTypes', 'employmentTypes'));
    }

    public function store(StoreOrderRequest $request) {
        $this->authorize('create', Order::class);

        $data = $request->validated();

        $data['customer_id'] = auth()->user()->isAdmin()
            ? $request->validated('customer_id')
            : auth()->user()->customer_id;

        $data['user_id'] = auth()->id();

        Order::create($data);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pakalpojuma pieprasījums veiksmīgi izveidots.');
    }

    public function edit(Order $order)  {
        $this->authorize('update', $order);

        $customers = auth()->user()->isAdmin()
            ? Customer::query()->orderBy('name')->get(['id', 'name'])
            : Customer::query()
                ->where('id', auth()->user()->customer_id)
                ->get(['id', 'name']);

        $statuses = Order::statusOptions();
        $serviceTypes = Order::serviceTypeOptions();
        $employmentTypes = Order::employmentTypeOptions();

        return view('orders.edit', compact('order', 'customers', 'statuses', 'serviceTypes', 'employmentTypes'));
    }

    public function update(UpdateOrderRequest $request, Order $order) {
        $this->authorize('update', $order);

        $data = $request->validated();

        $data['customer_id'] = auth()->user()->isAdmin()
            ? $request->validated('customer_id')
            : auth()->user()->customer_id;

        $order->update($data);

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