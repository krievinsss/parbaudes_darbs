<x-guest-layout>
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-blue-600">
                Nodarbinātības sistēma
            </p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                Pieslēgties kontam
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                Ievadiet savu e-pastu un paroli, lai piekļūtu sistēmai.
            </p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <x-auth-session-status class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
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
                        autocomplete="username"
                        class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="ievadi e-pastu"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <div class="mb-2 flex items-center justify-between gap-3">
                        <label for="password" class="block text-sm font-medium text-slate-700">
                            Parole
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm font-medium text-blue-700 hover:text-blue-800"
                            >
                                Aizmirsi paroli?
                            </a>
                        @endif
                    </div>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="ievadi paroli"
                    >
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center gap-3">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                    >
                    <label for="remember_me" class="text-sm text-slate-600">
                        Atcerēties mani
                    </label>
                </div>

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100"
                >
                    Pieslēgties
                </button>
            </form>
        </div>

        <div class="mt-6 text-center text-sm text-slate-500">
            <a href="{{ route('welcome') }}" class="font-medium text-slate-700 hover:text-slate-900">
                ← Atpakaļ uz publisko sākumlapu
            </a>
        </div>
    </div>
</x-guest-layout>