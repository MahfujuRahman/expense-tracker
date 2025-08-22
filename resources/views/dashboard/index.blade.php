@extends('layouts.app')

@section('content')
    <h2 class="h4 mb-4">Dashboard</h2>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">This Month by Category</h5>
                    <div style="min-height:250px">
                        <canvas id="catChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Last 6 Months</h5>
                    <div style="min-height:250px">
                        <canvas id="monthsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Range Search -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Search Expenses by Date Range</h5>
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Search</button>
                                @if($startDate || $endDate)
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">Clear</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    @if($searchResults->isNotEmpty())
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Search Results ({{ $searchResults->count() }} expenses)</h5>
                    <p class="text-muted">Total: <strong>${{ number_format($searchTotal, 2) }}</strong></p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($searchResults as $expense)
                                <tr>
                                    <td>{{ $expense->date->format('Y-m-d') }}</td>
                                    <td>{{ $expense->title }}</td>
                                    <td>{{ $expense->category->name }}</td>
                                    <td class="text-end">${{ number_format($expense->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Last Month Expenses -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Last Month Expenses ({{ $lastMonthExpenses->count() }} expenses)</h5>
                    <p class="text-muted">Total: <strong>${{ number_format($lastMonthExpenses->sum('amount'), 2) }}</strong></p>
                    @if($lastMonthExpenses->isEmpty())
                        <p class="text-muted">No expenses recorded for last month.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lastMonthExpenses as $expense)
                                    <tr>
                                        <td>{{ $expense->date->format('Y-m-d') }}</td>
                                        <td>{{ $expense->title }}</td>
                                        <td>{{ $expense->category->name }}</td>
                                        <td class="text-end">${{ number_format($expense->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const catCtx = document.getElementById('catChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: @json(array_values($catLabels->toArray())),
                datasets: [{ data: @json(array_values($catData->toArray())), backgroundColor: ['#2563eb','#10b981','#f59e0b','#f97316','#ef4444'] }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        const monthsCtx = document.getElementById('monthsChart').getContext('2d');
        new Chart(monthsCtx, {
            type: 'line',
            data: {
                labels: @json($monthLabels),
                datasets: [{
                    label: 'Expenses',
                    data: @json($monthData),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,0.1)',
                    fill: true,
                    tension: 0.25,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
@endsection
