@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-4xl">
    <h1 class="text-2xl font-bold mb-4">Rediģēt pakalpojuma pieprasījumu</h1>

    <form method="POST" action="{{ route('orders.update', $order) }}">
        @method('PUT')
        @include('orders._form')
    </form>
</div>
@endsection