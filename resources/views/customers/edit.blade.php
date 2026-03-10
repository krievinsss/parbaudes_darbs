@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-4">Rediģēt klientu</h1>

    <form method="POST" action="{{ route('customers.update', $customer) }}">
        @method('PUT')
        @include('customers._form')
    </form>
</div>
@endsection