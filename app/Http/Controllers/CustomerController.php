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
        return view('customers.index');
    }

    public function data(Request $request)
    {
        $customers = Customer::query();
        Log::info($customers->get());

        return DataTables::eloquent($customers)
            ->addColumn('action', function ($customer) {
                return '<a href="/customers/' . $customer->id . '/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
