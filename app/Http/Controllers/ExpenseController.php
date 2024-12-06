<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    protected function index()
    {
        $expenses = Expense::all();
        return view('expenses.index', ['expenses' => $expenses]);
    }

    public function data()
    {
        $expenses = Expense::with('expenseType')->get();
        return datatables()->of($expenses)
            ->addColumn('action', function ($expense) {
                return '<a href="' . route('expenses.edit', $expense->id) . '" class="btn btn-primary btn-sm">Edit</a>
                <a href="' . route('expenses.destroy', $expense->id) . '" class="btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
