@csrf

<div class="mb-4">
    <label class="block mb-1">Vārds</label>
    <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}" class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
    <label class="block mb-1">E-pasts</label>
    <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
    <label class="block mb-1">Telefons</label>
    <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Adrese</label>
    <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address', $customer->address ?? '') }}</textarea>
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">Saglabāt</button>