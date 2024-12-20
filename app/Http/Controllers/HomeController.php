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

    public function getMonthlyIncomeAndExpense(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $monthlyIncome = [];
        $monthlyExpense = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyIncome[] = Product::whereYear('receive_date', $year)
                ->whereMonth('receive_date', $month)
                ->where('status_id', 1)
                ->sum('price');

            $monthlyExpense[] = Expense::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->sum('amount');
        }

        return response()->json([
            'monthlyIncome' => $monthlyIncome,
            'monthlyExpense' => $monthlyExpense,
        ]);
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
