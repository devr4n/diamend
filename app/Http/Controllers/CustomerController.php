<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        $mode = 'list';
        return view('customers.index', compact('mode'));
    }

    public function data(Request $request)
    {
        try {
            $customers = Customer::select(['id', 'name', 'surname', 'phone_1', 'phone_2', 'address', 'created_at']);

            return DataTables::of($customers)
                ->editColumn('created_at', function ($customer) {
                    return $customer->created_at->format('d-m-Y');
                })
                ->addColumn('action', function ($customer) {
                    return '
                        <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>

                        ';
                })
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
