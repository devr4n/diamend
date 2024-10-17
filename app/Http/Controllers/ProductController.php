<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $mode = 'list';
        return view('products.index',[
            'mode' => $mode,
            'pageTitle' => __('general.title.product_list')
        ]);
    }

    public function create()
    {
        $mode = 'create';
        return view('products.index',[
            'mode' => $mode,
            'pageTitle' => __('general.title.product_create')
        ]);
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
