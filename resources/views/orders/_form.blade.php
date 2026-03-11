@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @if(auth()->user()->isAdmin())
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Klients</label>
            <select name="customer_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected((string) old('customer_id', $order->customer_id ?? '') === (string) $customer->id)>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Pieprasījuma numurs</label>
        <input
            type="text"
            name="request_number"
            value="{{ old('request_number', $order->request_number ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            required
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Pakalpojuma tips</label>
        <select name="service_type" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" required>
            @foreach($serviceTypes as $value => $label)
                <option value="{{ $value }}" @selected(old('service_type', $order->service_type ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Statuss</label>
        <select name="status" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" required>
            @foreach($statuses as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $order->status ?? 'draft') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-700">Amata nosaukums</label>
        <input
            type="text"
            name="position_title"
            value="{{ old('position_title', $order->position_title ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            required
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Vakances skaits</label>
        <input
            type="number"
            min="1"
            name="vacancies_count"
            value="{{ old('vacancies_count', $order->vacancies_count ?? 1) }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            required
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Nodarbinātības veids</label>
        <select name="employment_type" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
            <option value="">-- izvēlēties --</option>
            @foreach($employmentTypes as $value => $label)
                <option value="{{ $value }}" @selected(old('employment_type', $order->employment_type ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Atrašanās vieta</label>
        <input
            type="text"
            name="location"
            value="{{ old('location', $order->location ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Alga no</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="salary_from"
            value="{{ old('salary_from', $order->salary_from ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Alga līdz</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="salary_to"
            value="{{ old('salary_to', $order->salary_to ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-700">Apraksts</label>
        <textarea
            name="description"
            rows="5"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >{{ old('description', $order->description ?? '') }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-700">Iekšējās piezīmes</label>
        <textarea
            name="notes"
            rows="4"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >{{ old('notes', $order->notes ?? '') }}</textarea>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Iesniegts</label>
        <input
            type="datetime-local"
            name="submitted_at"
            value="{{ old('submitted_at', isset($order->submitted_at) ? $order->submitted_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Apstrādāts</label>
        <input
            type="datetime-local"
            name="processed_at"
            value="{{ old('processed_at', isset($order->processed_at) ? $order->processed_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
        >
    </div>
</div>

<div class="mt-8 flex items-center gap-3">
    <button class="inline-flex items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-white font-medium hover:bg-blue-800 transition">
        Saglabāt
    </button>

    <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-slate-700 hover:bg-slate-50 transition">
        Atcelt
    </a>
</div>