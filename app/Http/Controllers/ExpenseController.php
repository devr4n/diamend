<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('expenses.index', ['expenses' => $expenses]);
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
    }

    public function data()
    {
        $expenses = Expense::with('expenseType')->get();
        return datatables()->of($expenses)
            ->editColumn('expense_type.name', function ($expense) {
                return $expense->expenseType->localized_name ?? '-';
            })
            ->editColumn('date', function ($expense) {
                return Carbon::parse($expense->date)->format('d-m-Y');
            })
            ->addColumn('action', function ($expense) {
                return '<a href="' . route('expenses.edit', $expense->id) . '" class="btn btn-outline-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                <form action="' . route('expenses.destroy', $expense->id) . '" method="POST" class="d-inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                    </form>';
            })
            ->make(true);
    }
}
