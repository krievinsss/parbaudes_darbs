<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{

    public function index() {
        $this->authorize('viewAny', Customer::class);

        $customers = Customer::query()
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers'));
    }

    public function create() {
        $this->authorize('create', Customer::class);

        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request) {
        $this->authorize('create', Customer::class);

        Customer::create($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Klients veiksmīgi izveidots.');
    }

    public function edit(Customer $customer) {
        $this->authorize('update', $customer);

        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer) {
        $this->authorize('update', $customer);

        $customer->update($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Klients veiksmīgi atjaunināts.');
    }

    public function destroy(Customer $customer) {
        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Klients veiksmīgi dzēsts.');
    }
}