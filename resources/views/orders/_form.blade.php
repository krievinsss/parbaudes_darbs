@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1">Darba devējs</label>
        <select name="customer_id" class="w-full border rounded px-3 py-2" required>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected((string) old('customer_id', $order->customer_id ?? '') === (string) $customer->id)>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Pieprasījuma numurs</label>
        <input type="text" name="request_number" value="{{ old('request_number', $order->request_number ?? '') }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Pakalpojuma tips</label>
        <select name="service_type" class="w-full border rounded px-3 py-2" required>
            @foreach($serviceTypes as $serviceType)
                <option value="{{ $serviceType }}" @selected(old('service_type', $order->service_type ?? '') === $serviceType)>{{ $serviceType }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Statuss</label>
        <select name="status" class="w-full border rounded px-3 py-2" required>
            @foreach($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $order->status ?? 'draft') === $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4 md:col-span-2">
        <label class="block mb-1">Amata nosaukums</label>
        <input type="text" name="position_title" value="{{ old('position_title', $order->position_title ?? '') }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Vakances skaits</label>
        <input type="number" min="1" name="vacancies_count" value="{{ old('vacancies_count', $order->vacancies_count ?? 1) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Nodarbinātības veids</label>
        <select name="employment_type" class="w-full border rounded px-3 py-2">
            <option value="">-- izvēlēties --</option>
            @foreach($employmentTypes as $employmentType)
                <option value="{{ $employmentType }}" @selected(old('employment_type', $order->employment_type ?? '') === $employmentType)>{{ $employmentType }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Atrašanās vieta</label>
        <input type="text" name="location" value="{{ old('location', $order->location ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Alga no</label>
        <input type="number" step="0.01" min="0" name="salary_from" value="{{ old('salary_from', $order->salary_from ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Alga līdz</label>
        <input type="number" step="0.01" min="0" name="salary_to" value="{{ old('salary_to', $order->salary_to ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4 md:col-span-2">
        <label class="block mb-1">Apraksts</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $order->description ?? '') }}</textarea>
    </div>

    <div class="mb-4 md:col-span-2">
        <label class="block mb-1">Iekšējās piezīmes</label>
        <textarea name="notes" class="w-full border rounded px-3 py-2" rows="3">{{ old('notes', $order->notes ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Iesniegts</label>
        <input type="datetime-local" name="submitted_at" value="{{ old('submitted_at', isset($order->submitted_at) ? $order->submitted_at->format('Y-m-d\TH:i') : '') }}" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Apstrādāts</label>
        <input type="datetime-local" name="processed_at" value="{{ old('processed_at', isset($order->processed_at) ? $order->processed_at->format('Y-m-d\TH:i') : '') }}" class="w-full border rounded px-3 py-2">
    </div>
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">Saglabāt</button>