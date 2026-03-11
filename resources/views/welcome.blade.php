<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nodarbinātības portāls</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white/90 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Nodarbinātības portāls</p>
                <h1 class="text-xl md:text-2xl font-bold">Vakances un darba iespējas</h1>
            </div>

            <div class="flex items-center gap-3">
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
        </div>
    </header>

    <section class="bg-gradient-to-r from-slate-900 via-blue-900 to-blue-700 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 md:py-20">
            <div class="max-w-3xl">
                <p class="mb-3 text-sm uppercase tracking-[0.25em] text-blue-100">Darba meklētājiem</p>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-5">
                    Atrodi sev piemērotu vakanci Latvijā
                </h2>
                <p class="text-lg text-blue-100 leading-8">
                    Pārlūko aktuālos darba sludinājumus, meklē pēc amata vai atrašanās vietas
                    un iepazīsties ar pilnu vakances aprakstu.
                </p>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-10 md:py-12">
        <form method="GET" class="mb-8 rounded-3xl border border-slate-200 bg-white p-4 md:p-6 shadow-sm">
            <label for="q" class="mb-2 block text-sm font-medium text-slate-700">Meklēt vakanci</label>
            <div class="flex flex-col md:flex-row gap-3">
                <input
                    id="q"
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Amats, uzņēmums, pilsēta..."
                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >
                <button class="rounded-2xl bg-blue-700 px-5 py-3 text-white font-medium hover:bg-blue-800 transition">
                    Meklēt
                </button>
                <a href="{{ route('welcome') }}" class="rounded-2xl border border-slate-300 bg-white px-5 py-3 text-slate-700 hover:bg-slate-50 transition text-center">
                    Notīrīt
                </a>
            </div>
        </form>

        <div class="mb-5 flex items-center justify-between">
            <h3 class="text-2xl font-bold text-slate-900">Aktuālās vakances</h3>
            <p class="text-sm text-slate-500">Atrastas: {{ $vacancies->total() }}</p>
        </div>

        @if($vacancies->count())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($vacancies as $vacancy)
                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
                        <div class="mb-4">
                            <p class="mb-2 text-sm font-semibold text-blue-700">{{ $vacancy->customer->name }}</p>
                            <h4 class="text-xl font-bold text-slate-900 mb-3">{{ $vacancy->position_title }}</h4>

                            <div class="space-y-2 text-sm text-slate-600">
                                @if($vacancy->location)
                                    <p>📍 {{ $vacancy->location }}</p>
                                @endif

                                @if($vacancy->salary_from || $vacancy->salary_to)
                                    <p>
                                        💶
                                        {{ $vacancy->salary_from ? number_format($vacancy->salary_from, 0, ',', ' ') : '—' }}
                                        -
                                        {{ $vacancy->salary_to ? number_format($vacancy->salary_to, 0, ',', ' ') : '—' }}
                                        EUR
                                    </p>
                                @endif

                                <p>Brīvo vietu skaits: {{ $vacancy->vacancies_count }}</p>
                            </div>
                        </div>

                        <p class="mb-6 text-slate-600 leading-7">
                            {{ \Illuminate\Support\Str::limit(strip_tags($vacancy->description), 150) }}
                        </p>

                        <a href="{{ route('vacancies.show', $vacancy) }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-white font-medium hover:bg-slate-800 transition">
                            Skatīt sludinājumu
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $vacancies->links() }}
            </div>
        @else
            <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center text-slate-500 shadow-sm">
                Šobrīd nav atrasta neviena vakance.
            </div>
        @endif
    </main>
</body>
</html>