<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index() {
        $this->authorize('viewAny', Customer::class);

        $query = Customer::query()->latest();

        if (!auth()->user()->isAdmin()) {
            $query->where('id', auth()->user()->customer_id);
        }

        $customers = $query->paginate(10)->withQueryString();

        return view('customers.index', compact('customers'));
    }

    public function create() {
        $this->authorize('create', Customer::class);

        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request) {
        $this->authorize('create', Customer::class);

        DB::transaction(function () use ($request) {
            $customer = Customer::create([
                'name' => $request->validated('name'),
                'email' => $request->validated('email'),
                'phone' => $request->validated('phone'),
                'address' => $request->validated('address'),
            ]);

            User::create([
                'name' => $request->validated('name'),
                'email' => $request->validated('email'),
                'password' => Hash::make($request->validated('password')),
                'is_admin' => false,
                'customer_id' => $customer->id,
            ]);
        });

        return redirect()
            ->route('customers.index')
            ->with('success', 'Klients un lietotāja konts veiksmīgi izveidots.');
    }

    public function edit(Customer $customer) {
        $this->authorize('update', $customer);

        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer) {
        $this->authorize('update', $customer);

        DB::transaction(function () use ($request, $customer) {
            $customer->update([
                'name' => $request->validated('name'),
                'email' => $request->validated('email'),
                'phone' => $request->validated('phone'),
                'address' => $request->validated('address'),
            ]);

            if ($customer->user) {
                $data = [
                    'name' => $request->validated('name'),
                    'email' => $request->validated('email'),
                ];

                if ($request->filled('password')) {
                    $data['password'] = Hash::make($request->validated('password'));
                }

                $customer->user->update($data);
            }
        });

        return redirect()
            ->route('customers.index')
            ->with('success', 'Klients veiksmīgi atjaunināts.');
    }

    public function destroy(Customer $customer) {
        $this->authorize('delete', $customer);

        DB::transaction(function () use ($customer) {
            if ($customer->user) {
                $customer->user->delete();
            }

            $customer->delete();
        });

        return redirect()
            ->route('customers.index')
            ->with('success', 'Klients veiksmīgi dzēsts.');
    }
}