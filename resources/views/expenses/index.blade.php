@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Your Expenses</h2>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if($expenses->isEmpty())
                <div class="p-4 text-muted">No expenses yet.</div>
            @else
                <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th class="text-end">Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $e)
                        <tr>
                            <td>{{ $e->date->format('Y-m-d') }}</td>
                            <td>{{ $e->title }}</td>
                            <td>{{ $e->category->name }}</td>
                            <td class="text-end">{{ number_format($e->amount,2) }}</td>
                            <td>
                                <a href="{{ route('expenses.show', $e) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('expenses.edit', $e) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('expenses.destroy', $e) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            @endif
        </div>
    </div>
@endsection
