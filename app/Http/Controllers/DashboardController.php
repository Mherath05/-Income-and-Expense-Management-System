<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
       
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;
        
       
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with('category')
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();
        
        
        $monthlyData = Transaction::where('user_id', $user->id)
            ->whereYear('date', now()->year)
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expense')
            )
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy('month')
            ->get();
        
       
        $chartData = $this->getChartData($user->id);
        
        return view('dashboard', compact(
            'totalIncome',
            'totalExpense', 
            'balance',
            'recentTransactions',
            'monthlyData',
            'chartData'
        ));
    }
    
    private function getChartData($userId)
    {
        
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        
        $monthlyData = Transaction::where('user_id', $userId)
            ->whereBetween('date', [$startDate, $endDate])
            ->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expense')
            )
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        
        $chartData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $year = $date->year;
            $month = $date->month;
            
            
            $monthData = $monthlyData->where('year', $year)->where('month', $month)->first();
            
            $chartData[] = [
                'month' => $month,
                'year' => $year,
                'month_name' => $date->format('M Y'),
                'income' => $monthData ? $monthData->income : 0,
                'expense' => $monthData ? $monthData->expense : 0,
            ];
        }
        
        return collect($chartData);
    }
}