@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-medium mb-4">Edit Expense</h2>

    <div class="bg-white shadow rounded p-4">
        <form method="POST" action="{{ route('expenses.update', $expense) }}">
            @csrf
            @method('PUT')

            @include('expenses._form', ['expense' => $expense])

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-success">Update</button>
                <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
