@extends('layouts.app')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-xl font-medium">Expense Details</h2>
        <a href="{{ route('expenses.edit', $expense) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
    </div>

    <div class="bg-white shadow rounded p-4">
        <p><strong>Date:</strong> {{ $expense->date->format('Y-m-d') }}</p>
        <p><strong>Title:</strong> {{ $expense->title }}</p>
        <p><strong>Category:</strong> {{ $expense->category->name }}</p>
        <p><strong>Amount:</strong> {{ number_format($expense->amount,2) }}</p>
    </div>
@endsection
