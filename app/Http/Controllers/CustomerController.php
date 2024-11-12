<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $this->data(); // Call the data method to get the data for the DataTables
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone_1' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        try {
            $customer = Customer::create($request->all());
            $customer->save();
            Session::flash('message', 'Customer created successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while saving the customer');
            Log::error($e->getMessage());
        }
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone_1' => 'required|string|max:15',
            'phone_2' => 'nullable|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        try {
            $customer = Customer::findOrFail($id);
            $customer->update($request->all());
            Session::flash('message', 'Customer updated successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while updating the customer');
            Log::error($e->getMessage());
        }

        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            Session::flash('message', 'Customer deleted successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while deleting the customer');
            Log::error($e->getMessage());
        }

        return redirect()->route('customers.index');
    }

    public function data()
    {
        $customers = Customer::select(['id', 'name', 'surname', 'phone_1', 'phone_2', 'address', 'created_at']);

        return DataTables::of($customers)
            ->editColumn('created_at', function ($customer) {
                return $customer->created_at->format('d-m-Y');
            })
            ->addColumn('action', function ($customer) {
                return '
                <a href="' . route('customers.edit', $customer->id) . '" class="btn btn-outline-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
            ';
            })
            ->make(true);
    }
}
