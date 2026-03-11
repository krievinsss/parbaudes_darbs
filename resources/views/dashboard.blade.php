@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-900">Pārskats</h1>
        <p class="mt-1 text-sm md:text-base text-slate-500">
            {{ auth()->user()->isAdmin()
                ? 'Administrācijas pārvaldības panelis.'
                : 'Jūsu uzņēmuma pakalpojuma pieprasījumu pārskats.' }}
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm text-slate-500 mb-2">Lietotāja tips</p>
                    <p class="text-2xl font-bold text-slate-900">
                        {{ auth()->user()->isAdmin() ? 'Admin' : 'Customer' }}
                    </p>
                    <p class="mt-2 text-sm text-emerald-600">Aktīva piekļuve sistēmai</p>
                </div>
                <div class="h-12 w-12 shrink-0 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl">
                    👤
                </div>
            </div>
        </div>
        @if(auth()->user()->isAdmin())
            <div class="rounded-3xl border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500 mb-2">Pakalpojuma pieprasījumi</p>
                        <p class="text-2xl font-bold text-slate-900">
                            {{ auth()->user()->isAdmin()
                                ? \App\Models\Order::count()
                                : \App\Models\Order::where('customer_id', auth()->user()->customer_id)->count() }}
                        </p>
                        <p class="mt-2 text-sm text-slate-500">Redzamie ieraksti</p>
                    </div>
                    <div class="h-12 w-12 shrink-0 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl">
                        📄
                    </div>
                </div>
            </div>        
            <div class="rounded-3xl border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500 mb-2">Klienti</p>
                        <p class="text-2xl font-bold text-slate-900">
                            {{ \App\Models\Customer::count() }}
                        </p>
                        <p class="mt-2 text-sm text-slate-500">Reģistrētie uzņēmumi</p>
                    </div>
                    <div class="h-12 w-12 shrink-0 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl">
                        🏢
                    </div>
                </div>
            </div>
        

        <div class="rounded-3xl border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm text-slate-500 mb-2">Publiskās vakances</p>
                    <p class="text-2xl font-bold text-slate-900">
                        {{ \App\Models\Order::where('service_type', 'vacancy_registration')->whereIn('status', ['approved', 'completed'])->count() }}
                    </p>
                    <p class="mt-2 text-sm text-blue-600">Pieejamas darba meklētājiem</p>
                </div>
                <div class="h-12 w-12 shrink-0 rounded-2xl bg-violet-50 text-violet-700 flex items-center justify-center text-xl">
                    💼
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 rounded-3xl border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <h2 class="text-xl font-bold text-slate-900">Ātrās darbības</h2>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-500">Sistēmas navigācija</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('orders.index') }}" class="rounded-2xl border border-slate-200 p-5 hover:bg-slate-50 transition">
                    <p class="text-lg font-semibold text-slate-900 mb-1">Skatīt pieprasījumus</p>
                    <p class="text-sm text-slate-500">Pārvaldīt pakalpojuma pieprasījumus un vakances.</p>
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('customers.index') }}" class="rounded-2xl border border-slate-200 p-5 hover:bg-slate-50 transition">
                        <p class="text-lg font-semibold text-slate-900 mb-1">Pārvaldīt klientus</p>
                        <p class="text-sm text-slate-500">Izveidot uzņēmumus, kontus un rediģēt klientu datus.</p>
                    </a>
                @endif

                <a href="{{ route('orders.create') }}" class="rounded-2xl border border-slate-200 p-5 hover:bg-slate-50 transition">
                    <p class="text-lg font-semibold text-slate-900 mb-1">Jauns pieprasījums</p>
                    <p class="text-sm text-slate-500">Pievienot jaunu pakalpojuma pieprasījumu vai vakanci.</p>
                </a>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900 mb-4">Loma sistēmā</h2>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="font-semibold text-slate-900 mb-2">
                    {{ auth()->user()->isAdmin() ? 'Administrators' : 'Klienta konts' }}
                </p>
                <p class="text-sm text-slate-600 leading-6">
                    @if(auth()->user()->isAdmin())
                        Jūs varat redzēt visus klientus, visus pakalpojuma pieprasījumus un koriģēt visus ierakstus.
                    @else
                        Jūs redzat tikai sava uzņēmuma pakalpojuma pieprasījumus un varat pievienot, rediģēt un dzēst tikai savus ierakstus.
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection