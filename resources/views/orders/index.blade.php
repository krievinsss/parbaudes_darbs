@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Pakalpojuma pieprasījumi</h1>
        <a href="{{ route('orders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Jauns pieprasījums</a>
    </div>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block mb-1">Statuss</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="">Visi</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Darba devējs</label>
            <select name="customer_id" class="w-full border rounded px-3 py-2">
                <option value="">Visi</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected((string) request('customer_id') === (string) $customer->id)>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Pakalpojuma tips</label>
            <select name="service_type" class="w-full border rounded px-3 py-2">
                <option value="">Visi</option>
                @foreach($serviceTypes as $serviceType)
                    <option value="{{ $serviceType }}" @selected(request('service_type') === $serviceType)>{{ $serviceType }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button class="bg-gray-800 text-white px-4 py-2 rounded">Filtrēt</button>
            <a href="{{ route('orders.index') }}" class="bg-gray-300 px-4 py-2 rounded">Notīrīt</a>
        </div>
    </form>

    <table class="w-full border-collapse">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Nr.</th>
                <th class="text-left py-2">Darba devējs</th>
                <th class="text-left py-2">Pakalpojums</th>
                <th class="text-left py-2">Amats</th>
                <th class="text-left py-2">Statuss</th>
                <th class="text-left py-2">Vakances</th>
                <th class="text-left py-2">Īpašnieks</th>
                <th class="text-left py-2">Darbības</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="border-b align-top">
                    <td class="py-2">{{ $order->request_number }}</td>
                    <td class="py-2">{{ $order->customer->name }}</td>
                    <td class="py-2">{{ $order->service_type }}</td>
                    <td class="py-2">{{ $order->position_title }}</td>
                    <td class="py-2">{{ $order->status }}</td>
                    <td class="py-2">{{ $order->vacancies_count }}</td>
                    <td class="py-2">{{ $order->user->name }}</td>
                    <td class="py-2 flex gap-2">
                        @can('update', $order)
                            <a href="{{ route('orders.edit', $order) }}" class="text-blue-600">Rediģēt</a>
                        @endcan

                        @can('delete', $order)
                            <form method="POST" action="{{ route('orders.destroy', $order) }}" onsubmit="return confirm('Tiešām dzēst pieprasījumu?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Dzēst</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-4">Nav neviena pieprasījuma.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection