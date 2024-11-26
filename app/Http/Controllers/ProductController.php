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
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    protected $validateRules = [
        'customer_id' => ['required', 'exists:customers,id'],
        'operation_type_id' => ['required', 'exists:operation_types,id'],
        'product_type_id' => ['required', 'exists:product_types,id'],
        'description' => 'required',
        'weight' => 'nullable',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:15048',
        'receive_date' => 'required',
        'due_date' => 'required',
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

    // app/Http/Controllers/ProductController.php
    public function show($id)
    {
        try {
            $product = Product::with(['customer', 'operationType', 'productType'])->findOrFail($id);
            return response()->json([
                'customer' => $product->customer,
                'operation_type' => $product->operationType,
                'product_type' => $product->productType,
                'receive_date' => $product->receive_date,
                'due_date' => $product->due_date,
                'description' => $product->description,
                'weight' => $product->weight,
                'price' => $product->price,
                'note' => $product->note,
                'image_url' => $product->image ? asset('storage/' . $product->image) : asset('images/default.png'),
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Product not found'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validateRules);

        try {
            $product = Product::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }

            $product->update($request->except('image'));

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
                return $product->customer->name ?? '-';
            })
            ->editColumn('operation_type.name', function ($product) {
                return $product->operationType->localized_name ?? '-';
            })
            ->editColumn('product_type.name', function ($product) {
                return $product->productType->localized_name ?? '-';
            })
            ->addColumn('image_url', function ($product) {
                return $product->image_url ?? 'products/default-product.png'; // Modeldeki accessor kullanılır
            })
            ->editColumn('due_date', function ($product) {
                return $product->due_date ?? '-';
            })
            ->editColumn('created_at', function ($product) {
                return $product->created_at->format('d-m-Y');
            })
            ->addColumn('action', function ($product) {
                return '
    <a class="btn btn-outline-info btn-sm" title="Show" onClick="showModal(' . $product->id . ')"><i class="fas fa-eye"></i></a>
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
