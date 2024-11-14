<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::count();

        // Yearly product earnings
        $yearlyTotalProductEarnings = Product::whereYear('created_at', date('Y'))
            ->sum('price');

        // Monthly product earnings
        $monthlyTotalProductEarnings = Product::whereMonth('created_at', date('m'))
            ->sum('price');

        // Monthly products
        $monthlyTotalProducts = Product::whereMonth('created_at', date('m'))
            ->count();

        $widget = [
            'users' => $users,
            'yearlyTotalProductEarnings' => $yearlyTotalProductEarnings,
            'monthlyTotalProductEarnings' => $monthlyTotalProductEarnings,
            'monthlyTotalProducts' => $monthlyTotalProducts,
        ];

        return view('home', compact('widget'));
    }
}
