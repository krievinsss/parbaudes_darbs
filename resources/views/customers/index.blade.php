@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Klienti</h1>
        <a href="{{ route('customers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Jauns klients</a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Vārds</th>
                <th class="text-left py-2">E-pasts</th>
                <th class="text-left py-2">Telefons</th>
                <th class="text-left py-2">Darbības</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
                <tr class="border-b">
                    <td class="py-2">{{ $customer->name }}</td>
                    <td class="py-2">{{ $customer->email }}</td>
                    <td class="py-2">{{ $customer->phone }}</td>
                    <td class="py-2 flex gap-2">
                        <a href="{{ route('customers.edit', $customer) }}" class="text-blue-600">Rediģēt</a>

                        @can('delete', $customer)
                            <form method="POST" action="{{ route('customers.destroy', $customer) }}" onsubmit="return confirm('Tiešām dzēst klientu?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Dzēst</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4">Nav neviena klienta.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection