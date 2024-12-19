<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $completedProducts;
    public $monthlyIncome = [];
    public $monthlyExpense = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCompletedProducts()
    {
        // Calculate the percentage of completed products
        $totalProducts = Product::count();
        $finishedProducts = Product::where('status_id', 1)->count();
        $completedProducts = $totalProducts > 0 ? ($finishedProducts / $totalProducts) * 100 : 0;

        return response()->json(['completedProducts' => round($completedProducts)]);
    }

    private function calculateMonthlyIncomeAndExpense($year)
    {
        $year = date('Y');
        // Calculate monthly income and expense
        for ($month = 1; $month <= 12; $month++) {
            $this->monthlyIncome[] = Product::whereYear('receive_date', $year)
                ->whereMonth('receive_date', $month)
                ->where('status_id', 1)
                ->sum('price');

            $this->monthlyExpense[] = Expense::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->sum('amount');
        }
    }

    public function index()
    {
        $users = User::count();

        // Yearly product earnings
        $yearlyTotalProductEarnings = Product::whereYear('created_at', date('Y'))
            ->where('status_id', 1)
            ->sum('price');

        // Monthly product earnings
        $monthlyTotalProductEarnings = Product::whereMonth('created_at', date('m'))
            ->where('status_id', 1)
            ->sum('price');

        // Monthly products
        $monthlyTotalProducts = Product::whereMonth('created_at', date('m'))
            ->count();

        $this->calculateMonthlyIncomeAndExpense(date('Y'));

        $widget = [
            'users' => $users,
            'yearlyTotalProductEarnings' => $yearlyTotalProductEarnings,
            'monthlyTotalProductEarnings' => $monthlyTotalProductEarnings,
            'monthlyTotalProducts' => $monthlyTotalProducts,
            'monthlyIncome' => $this->monthlyIncome,
            'monthlyExpense' => $this->monthlyExpense,
        ];

        return view('home', compact('widget'));
    }
}
