@extends('layouts.client')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Client Dashboard</h1>
    <p class="text-gray-600 mb-6">Welcome, {{ auth()->user()->name }}.</p>

    <div class="flex gap-3">
        <a href="{{ url('/invoices') }}" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">View Invoices</a>
        <form method="POST" action="{{ route('client.logout') }}">
            @csrf
            <button class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Logout</button>
        </form>
    </div>
</div>
@endsection