@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">Klienti</h1>
        <p class="mt-1 text-slate-500">Uzņēmumu un klientu kontu pārvaldība.</p>
    </div>

    @if(auth()->user()->isAdmin())
        <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-white font-medium hover:bg-blue-800 transition">
            Jauns klients
        </a>
    @endif
</div>

<div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-slate-50">
                <tr class="text-left">
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Nosaukums</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">E-pasts</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Telefons</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">Darbības</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($customers as $customer)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $customer->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $customer->email }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $customer->phone }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-3">
                                @can('update', $customer)
                                    <a href="{{ route('customers.edit', $customer) }}"
                                       class="rounded-xl bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100 transition">
                                        Rediģēt
                                    </a>
                                @endcan

                                @can('delete', $customer)
                                    <form method="POST" action="{{ route('customers.destroy', $customer) }}" onsubmit="return confirm('Tiešām dzēst klientu?')">
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
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">Nav neviena klienta.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-slate-200 px-6 py-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection