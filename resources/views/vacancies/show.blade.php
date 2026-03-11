<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $order->position_title }} — {{ $order->customer->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white/90 backdrop-blur">
        <div class="mx-auto max-w-5xl px-4 py-4 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="text-blue-700 font-medium hover:text-blue-800 transition">
                ← Atpakaļ uz vakancēm
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="rounded-2xl bg-slate-900 px-4 py-2.5 text-white font-medium hover:bg-slate-800 transition">
                    Uz sistēmu
                </a>
            @else
                <a href="{{ route('login') }}" class="rounded-2xl border border-slate-300 bg-white px-4 py-2.5 text-slate-700 hover:bg-slate-50 transition">
                    Pieslēgties
                </a>
            @endauth
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-10">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
            <div class="mb-8">
                <p class="mb-2 text-sm font-semibold text-blue-700">{{ $order->customer->name }}</p>
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">{{ $order->position_title }}</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-slate-600">
                    @if($order->location)
                        <p><span class="font-semibold text-slate-900">Atrašanās vieta:</span> {{ $order->location }}</p>
                    @endif

                    <p><span class="font-semibold text-slate-900">Vakances skaits:</span> {{ $order->vacancies_count }}</p>

                    @if($order->employment_type)
                        <p>
                            <span class="font-semibold text-slate-900">Nodarbinātības veids:</span>
                            {{ \App\Models\Order::employmentTypeOptions()[$order->employment_type] ?? $order->employment_type }}
                        </p>
                    @endif

                    @if($order->salary_from || $order->salary_to)
                        <p>
                            <span class="font-semibold text-slate-900">Atalgojums:</span>
                            {{ $order->salary_from ? number_format($order->salary_from, 0, ',', ' ') : '—' }}
                            -
                            {{ $order->salary_to ? number_format($order->salary_to, 0, ',', ' ') : '—' }}
                            EUR
                        </p>
                    @endif
                </div>
            </div>

            <div class="border-t border-slate-200 pt-6">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Sludinājuma apraksts</h2>
                <div class="whitespace-pre-line leading-8 text-slate-700">
                    {{ $order->description ?: 'Apraksts nav norādīts.' }}
                </div>
            </div>

            @if($order->notes)
                <div class="border-t border-slate-200 pt-6 mt-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Papildu informācija</h2>
                    <div class="whitespace-pre-line leading-8 text-slate-700">
                        {{ $order->notes }}
                    </div>
                </div>
            @endif
        </div>
    </main>
</body>
</html>