<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MaterialType;
use App\Models\OperationType;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    protected $validateRules = [
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
    ];

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
        $request->validate($this->validateRules);

        try {
            $product = new Product($request->all());
            $product->status_id = 0;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }

            $product->save();
            Alert::success(__('products.success'), __('products.product_created'));

            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Alert::error(__('products.error'), __('products.product_created_error'));
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $customers = Customer::all();
        $operationTypes = OperationType::all();
        $productTypes = ProductType::all();
        $materialTypes = MaterialType::all();

        return view('products.edit', compact('product', 'customers', 'operationTypes', 'productTypes', 'materialTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validateRules);

        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            Alert::success(__('products.success'), __('products.product_updated'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Alert::error(__('products.error'), __('products.product_updated_error'));
            Log::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            Alert::success(__('products.success'), __('products.product_deleted'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Alert::error(__('products.error'), __('products.product_deleted_error'));
            Log::error($e->getMessage());
        }
    }

    public function data()
    {
        $products = Product::with(['customer', 'operationType', 'productType'])
            ->select([
                'products.id',
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
            ])
            ->orderBy('created_at', 'desc');
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
            ->editColumn('due_date', function ($product) {
                return $product->due_date ?? '-';
            })
            ->editColumn('created_at', function ($product) {
                return $product->created_at->format('d-m-Y');
            })
            ->addColumn('action', function ($product) {
                return '
        <button type="button" class="btn btn-outline-success btn-sm" title="View"><i class="fas fa-eye"></i></button>
    <a href="' . route('products.edit', $product->id) . '" class="btn btn-outline-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
    <form action="' . route('products.destroy', $product->id) . '" method="POST" style="display:inline;">
        ' . csrf_field() . '
        ' . method_field('DELETE') . '
        <button type="submit" class="delete-button btn btn-outline-danger btn-sm " title="Delete"><i class="fas fa-trash"></i></button>
    </form>';
            })
            ->make(true);
    }
}
