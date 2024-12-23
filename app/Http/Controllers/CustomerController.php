<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    protected $validateRules = [
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'phone_1' => 'required|string|max:20',
        'phone_2' => 'nullable|string|max:20',
        'address' => 'required|string|max:255',
    ];

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
        $request->validate($this->validateRules);

        try {
            $customer = Customer::create($request->all());
            $customer->save();
            Alert::success(__('customer.success'), __('customer.customer_created'));
            return redirect()->route('customers.index');
        } catch (\Exception $e) {
            Alert::error(__('customer.error'), __('customer.customer_created_error'));
            Log::error($e->getMessage());
        }
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validateRules);

        try {
            $customer = Customer::findOrFail($id);
            $customer->update($request->all());
            Alert::success(__('customer.success'), __('customer.customer_updated'));
            return redirect()->route('customers.index');
        } catch (\Exception $e) {
            Alert::error(__('customer.error'), __('customer.customer_updated_error'));
            Log::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            Alert::success(__('customer.success'), __('customer.customer_deleted'));
            return redirect()->route('customers.index');
        } catch (\Exception $e) {
            Alert::error(__('customer.error'), __('customer.customer_deleted_error'));
            Log::error($e->getMessage());
        }
    }

    public function data()
    {
        $customers = Customer::select(['id', 'name', 'surname', 'phone_1', 'phone_2', 'address', 'created_at'])
            ->orderBy('created_at', 'desc');

        return DataTables::of($customers)
            ->editColumn('created_at', function ($customer) {
                return $customer->created_at->format('d-m-Y');
            })
            ->editColumn('phone_1', function ($customer) {
                return $customer->phone_1;
            })
            ->editColumn('phone_2', function ($customer) {
                return $customer->phone_2;
            })
            ->addColumn('action', function ($customer) {
                return '
                <a href="' . route('customers.edit', $customer->id) . '" class="btn btn-outline-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                <form action="' . route('customers.destroy', $customer->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="delete-button btn btn-outline-danger btn-sm " title="Delete"><i class="fas fa-trash"></i></button>
                </form>';
            })
            ->make(true);
    }
}
