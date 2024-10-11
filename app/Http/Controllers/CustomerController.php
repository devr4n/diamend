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
        return view('customers.index', [
            'mode' => $mode,
            'pageTitle' => 'Customer List',
        ]);
    }

    public function create()
    {
        return view('customers.index', [
            'mode' => 'create',
            'pageTitle' => 'Add New Customer',
        ]);
    }

    public function edit(int $id)
    {
        return view('customers.index', [
            'mode' => 'edit',
            'page_title' => 'Edit Customer ID : ' . $id,
        ]);
    }

    public function data(Request $request)
    {
        try {
            $customers = Customer::select(['id', 'name', 'surname', 'phone_1', 'phone_2', 'address', 'created_at'])->get();

            return response()->json($customers);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
