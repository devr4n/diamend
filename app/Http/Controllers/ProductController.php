<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MaterialType;
use App\Models\OperationType;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $operationTypes = OperationType::all();
        $productTypes = ProductType::all();
        $products = Product::all();
        $this->data(); // Call the data method to get the data for the DataTables


        return view('products.index', compact('customers', 'operationTypes', 'productTypes', 'products'));
    }

    public function create()
    {
        $customers = Customer::all();
        $operationTypes = OperationType::all();
        $productTypes = ProductType::all();
        $materialTypes = MaterialType::all();

        return view('products.create', compact('customers', 'operationTypes', 'productTypes', 'materialTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'operation_type_id' => ['required', 'exists:operation_types,id'],
            'product_type_id' => ['required', 'exists:product_types,id'],
            'description' => 'required',
            'weight' => 'nullable',
            'image' => 'nullable',
            'receive_date' => 'nullable',
            'due_date' => 'nullable',
            'delivery_date' => 'nullable',
            'note' => 'nullable',
            'price' => 'nullable',
            'material_type_id' => 'nullable',
            'material_weight' => 'nullable',
            'status_id' => 'nullable',
        ]);

        try {
            $product = new Product($request->all());
            $product->status_id = 0;
            $product->save();
            Session::flash('message', 'Product created successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while saving the product: ' . $e->getMessage());
            logger()->error($e->getMessage());
        }

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $customers = Customer::all();
        $operationTypes = OperationType::all();
        $productTypes = ProductType::all();

        return view('products.edit', compact('product', 'customers', 'operationTypes', 'productTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'operation_type_id' => ['required', 'exists:operation_types,id'],
            'product_type_id' => ['required', 'exists:product_types,id'],
            'price' => 'required',
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            Session::flash('message', 'Product updated successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while updating the product');
        }

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            Session::flash('message', 'Product deleted successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while deleting the product');
        }

        return redirect()->route('products.index');
    }

    public function data()
    {
        $products = Product::with(['customer', 'operationType', 'productType'])
            ->select([
                'products.customer_id',
                'products.operation_type_id',
                'products.product_type_id',
                'products.description',
                'products.weight',
                'products.image',
                'products.receive_date',
                'products.due_date',
                'products.delivery_date',
                'products.price',
                'products.note',
                'products.material_type_id',
                'products.material_weight',
                'products.status_id',
                'products.created_at',
            ]);
        return datatables()->of($products)
            ->editColumn('customer.name', function ($product) {
                return $product->customer->name;
            })
            ->editColumn('operation_type.name', function ($product) {
                return $product->operationType->localized_name;
            })
            ->editColumn('product_type.name', function ($product) {
                return $product->productType->localized_name;
            })
            ->editColumn('created_at', function ($product) {
                return $product->created_at->format('d-m-Y');
            })
            ->addColumn('action', function ($customer) {
                return '
                <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></button>
                <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
            ';
            })
            ->make(true);
    }
}
