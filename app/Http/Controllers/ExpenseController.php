<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseController extends Controller
{

    protected $validateRules = [
        'expense_type_id' => 'required|integer',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'note' => 'nullable|string',
    ];

    public function index()
    {
        $expenses = Expense::all();
        return view('expenses.index', ['expenses' => $expenses]);
    }

    public function create()
    {
        $expenseTypes = ExpenseType::all();
        return view('expenses.create', compact('expenseTypes'));
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $expenseTypes = ExpenseType::all();
        return view('expenses.edit', compact('expense', 'expenseTypes'));
    }

    public function update(Request $request)
    {
        $request->validate($this->validateRules);

        try {
            $expense = Expense::findOrFail($request->id);
            $expense->update($request->all());

            Alert::success(__('expenses.success'), __('expenses.expense_updated'));
            return redirect()->route('expenses.index');
        } catch (\Exception $e) {
            Alert::error(__('expenses.error'), __('expenses.expense_updated_error'));
            Log::error('Expense update error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate($this->validateRules);

        try {
            $expense = Expense::create($request->all());
            $expense->save();
            Alert::success(__('expenses.success'), __('expenses.expense_created'));
            return redirect()->route('expenses.index');
        } catch (\Exception $e) {
            Alert::error(__('expenses.error'), __('expenses.expense_created_error'));
            Log::error('Expense creation error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();
            Alert::success(__('expenses.success'), __('expenses.expense_deleted'));
            return redirect()->route('expenses.index');
        } catch (\Exception $e) {
            Alert::error(__('expenses.error'), __('expenses.expense_deleted_error'));
            Log::error('Expense deletion error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function data()
    {
        $expenses = Expense::with('expenseType')->get();

        return datatables()->of($expenses)
            ->editColumn('expense_type.name', function ($expense) {
                return $expense->expenseType->localized_name ?? '-';
            })
            ->editColumn('note', function ($expense) {
                return $expense->note ?? '-';
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
