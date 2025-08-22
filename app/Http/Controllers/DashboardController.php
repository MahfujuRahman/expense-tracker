<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Current month category totals
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $categoryTotals = Expense::where('user_id', Auth::id())
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->with('category')
            ->get()
            ->groupBy(fn($e) => $e->category->name)
            ->map(fn($group) => $group->sum('amount'));

        // Last month expenses
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $lastMonthExpenses = Expense::where('user_id', Auth::id())
            ->whereBetween('date', [$lastMonthStart->toDateString(), $lastMonthEnd->toDateString()])
            ->with('category')
            ->orderByDesc('date')
            ->get();

        // Last 6 months totals per month
        $monthLabels = [];
        $monthData = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = Carbon::now()->subMonths($i);
            $startM = $m->copy()->startOfMonth()->toDateString();
            $endM = $m->copy()->endOfMonth()->toDateString();
            $label = $m->format('M Y');
            $sum = Expense::where('user_id', Auth::id())
                ->whereBetween('date', [$startM, $endM])
                ->sum('amount');
            $monthLabels[] = $label;
            $monthData[] = (float) $sum;
        }

        // Handle date range search
        $searchResults = collect();
        $searchTotal = 0;
        if ($request->has('start_date') && $request->has('end_date') && $request->start_date && $request->end_date) {
            $searchResults = Expense::where('user_id', Auth::id())
                ->whereBetween('date', [$request->start_date, $request->end_date])
                ->with('category')
                ->orderByDesc('date')
                ->get();
            $searchTotal = $searchResults->sum('amount');
        }

        return view('dashboard.index', [
            'catLabels' => $categoryTotals->keys(),
            'catData' => $categoryTotals->values(),
            'monthLabels' => $monthLabels,
            'monthData' => $monthData,
            'lastMonthExpenses' => $lastMonthExpenses,
            'searchResults' => $searchResults,
            'searchTotal' => $searchTotal,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
        ]);
    }
}
