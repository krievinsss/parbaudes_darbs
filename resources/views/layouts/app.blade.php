<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'NVA Portāls') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 antialiased">
    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen">
        <!-- Desktop sidebar -->
        <aside class="hidden lg:flex lg:fixed lg:inset-y-0 lg:w-72 lg:flex-col bg-white border-r border-slate-200">
            <div class="h-16 flex items-center px-6 border-b border-slate-200">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Portāls</p>
                    <h1 class="text-lg font-bold text-slate-900">Nodarbinātības sistēma</h1>
                </div>
            </div>

            <div class="px-4 py-6 flex-1">
                <nav class="space-y-2">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <span>📊</span>
                            <span>Pārskats</span>
                        </a>    

                        <a href="{{ route('customers.index') }}"
                           class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('customers.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <span>🏢</span>
                            <span>Klienti</span>
                        </a>
                    @endif

                    <a href="{{ route('orders.index') }}"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('orders.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        <span>📄</span>
                        <span>Pakalpojuma pieprasījumi</span>
                    </a>
                </nav>
            </div>

            <div class="border-t border-slate-200 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-600 font-medium hover:bg-red-100 transition">
                        Izrakstīties
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile overlay -->
        <div x-show="mobileMenuOpen"
             x-transition.opacity
             class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"
             @click="mobileMenuOpen = false"></div>

        <!-- Mobile sidebar -->
        <aside x-show="mobileMenuOpen"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed inset-y-0 left-0 z-50 w-80 max-w-[85vw] bg-white border-r border-slate-200 lg:hidden"
               style="display: none;">
            <div class="h-16 flex items-center justify-between px-5 border-b border-slate-200">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Portāls</p>
                    <h1 class="text-base font-bold text-slate-900">Nodarbinātības sistēma</h1>
                </div>

                <button @click="mobileMenuOpen = false"
                        class="rounded-xl border border-slate-300 px-3 py-2 text-slate-600">
                    ✕
                </button>
            </div>

            <div class="px-4 py-6 flex-1 overflow-y-auto">
                <nav class="space-y-2">

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                        @click="mobileMenuOpen = false"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <span>📊</span>
                            <span>Pārskats</span>
                        </a>

                        <a href="{{ route('customers.index') }}"
                           @click="mobileMenuOpen = false"
                           class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('customers.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <span>🏢</span>
                            <span>Klienti</span>
                        </a>
                    @endif

                    <a href="{{ route('orders.index') }}"
                       @click="mobileMenuOpen = false"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('orders.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        <span>📄</span>
                        <span>Pakalpojuma pieprasījumi</span>
                    </a>
                </nav>
            </div>

            <div class="border-t border-slate-200 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-600 font-medium hover:bg-red-100 transition">
                        Izrakstīties
                    </button>
                </form>
            </div>
        </aside>

        <div class="lg:pl-72">
            <header class="h-16 bg-slate-900 text-white flex items-center justify-between px-4 md:px-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <button @click="mobileMenuOpen = true"
                            class="lg:hidden rounded-xl border border-slate-700 px-3 py-2 text-white hover:bg-slate-800 transition">
                        ☰
                    </button>

                    <div>
                        <p class="text-sm text-slate-300">Labdien, {{ auth()->user()->name }}!</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('welcome') }}"
                       class="rounded-xl border border-slate-700 px-4 py-2 text-sm hover:bg-slate-800 transition">
                        Publiskā lapa
                    </a>
                </div>
            </header>

            <main class="p-4 md:p-6 xl:p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm">
                        <ul class="list-disc ml-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>