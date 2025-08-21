@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-medium mb-4">Edit Expense</h2>

    <div class="bg-white shadow rounded p-4">
        <form method="POST" action="{{ route('expenses.update', $expense) }}">
            @csrf
            @method('PUT')

            @include('expenses._form', ['expense' => $expense])

            <div class="mt-4 flex space-x-2">
                <button class="bg-green-600 text-white px-3 py-1 rounded">Update</button>
                <a href="{{ route('expenses.index') }}" class="px-3 py-1 border rounded">Cancel</a>
            </div>
        </form>

        <form method="POST" action="{{ route('expenses.destroy', $expense) }}" class="mt-3">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Delete</button>
        </form>
    </div>
@endsection
