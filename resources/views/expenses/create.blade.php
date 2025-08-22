@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Add Expense</h2>

    <div class="bg-white shadow rounded p-4 max-w-lg">
        <form method="POST" action="{{ route('expenses.store') }}">
            @csrf

            @include('expenses._form')

            <div class="mt-4">
                <button class="btn btn-success">Save</button>
                <a href="{{ route('expenses.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
