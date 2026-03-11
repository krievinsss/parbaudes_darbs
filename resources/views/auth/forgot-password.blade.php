<x-guest-layout>
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-blue-600">
                Nodarbinātības sistēma
            </p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                Paroles atjaunošana
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                Ievadi savu e-pasta adresi, un mēs nosūtīsim saiti paroles atiestatīšanai.
            </p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <x-auth-session-status
                class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                        E-pasts
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="ievadi e-pastu"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100"
                >
                    Nosūtīt paroles atjaunošanas saiti
                </button>
            </form>
        </div>

        <div class="mt-6 text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" class="font-medium text-slate-700 hover:text-slate-900">
                ← Atpakaļ uz pieslēgšanos
            </a>
        </div>
    </div>
</x-guest-layout>