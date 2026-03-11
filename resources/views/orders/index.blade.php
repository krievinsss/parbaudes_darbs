@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col xl:flex-row xl:items-start xl:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">Pakalpojuma pieprasījumi</h1>
        <p class="mt-1 text-slate-500">Pārvaldi vakances un citus pakalpojuma pieprasījumus.</p>
    </div>

    <a href="{{ route('orders.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-white font-medium hover:bg-blue-800 transition">
        Jauns pieprasījums
    </a>
</div>

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Statuss</label>
            <select name="status" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                <option value="">Visi</option>
                @foreach($statuses as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        @if(auth()->user()->isAdmin())
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Klients</label>
                <select name="customer_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    <option value="">Visi</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected((string) request('customer_id') === (string) $customer->id)>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Pakalpojuma tips</label>
            <select name="service_type" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                <option value="">Visi</option>
                @foreach($serviceTypes as $value => $label)
                    <option value="{{ $value }}" @selected(request('service_type') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-3">
            <button class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-white font-medium hover:bg-slate-800 transition">
                Filtrēt
            </button>
            <a href="{{ route('orders.index') }}" class="inline-flex w-full items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-slate-700 hover:bg-slate-50 transition">
                Notīrīt
            </a>
        </div>
    </form>
</div>

<div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-slate-50">
                <tr class="text-left">
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Nr.</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Klients</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Pakalpojums</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Amats</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Statuss</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Vakances</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Darbības</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-slate-50 transition align-top">
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $order->request_number }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $order->customer->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ \App\Models\Order::serviceTypeOptions()[$order->service_type] ?? $order->service_type }}</td>
                        <td class="px-6 py-4 text-slate-900">{{ $order->position_title }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700">
                                {{ \App\Models\Order::statusOptions()[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $order->vacancies_count }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-3">
                                @can('update', $order)
                                    <a href="{{ route('orders.edit', $order) }}"
                                       class="rounded-xl bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100 transition">
                                        Rediģēt
                                    </a>
                                @endcan

                                @can('delete', $order)
                                    <form method="POST" action="{{ route('orders.destroy', $order) }}" onsubmit="return confirm('Tiešām dzēst pieprasījumu?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl bg-red-50 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-100 transition">
                                            Dzēst
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">Nav neviena pieprasījuma.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-slate-200 px-6 py-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection