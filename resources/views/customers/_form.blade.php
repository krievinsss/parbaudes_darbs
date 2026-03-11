@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-700">Nosaukums</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $customer->name ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            required
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">E-pasts</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', $customer->email ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            required
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Telefons</label>
        <input
            type="text"
            name="phone"
            value="{{ old('phone', $customer->phone ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-700">Adrese</label>
        <textarea
            name="address"
            rows="4"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >{{ old('address', $customer->address ?? '') }}</textarea>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">
            @if(isset($customer))
                Jauna parole
            @else
                Parole
            @endif
        </label>
        <input
            type="password"
            name="password"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            @if(!isset($customer)) required @endif
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Apstiprināt paroli</label>
        <input
            type="password"
            name="password_confirmation"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            @if(!isset($customer)) required @endif
        >
    </div>
</div>

<div class="mt-8 flex items-center gap-3">
    <button class="inline-flex items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-white font-medium hover:bg-blue-800 transition">
        Saglabāt
    </button>

    <a href="{{ route('customers.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-slate-700 hover:bg-slate-50 transition">
        Atcelt
    </a>
</div>